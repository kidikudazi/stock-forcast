<?php

namespace App\Http\Controllers;

use App\Models\{
    Admin,
    Stock,
    Subscriber
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    View,
    Validator,
    Session,
    Hash,
};

use App\Traits\Helper;

class AdminController extends Controller
{
    use Helper;

    protected $redirectTo = '/administrator';

    /**
     * Login admin
     */
    public function login(Request $request)
    {
        try {
            // Set validation rules
            $rules = [
                'email'     => 'required',
                'password'  => 'required',
            ];

            // Validate rules
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                // Return validation message
                return redirect()->back()->withInput()->withErrors($validation);
            }

            // Request form inputs
            $email = $request->email;
            $password = $request->password;

            // Check auth
            $checkAuth = Admin::where('email', $email)->first();
            if ($checkAuth) {
                if (Hash::check($password, $checkAuth->password)) {
                    // Set session for admin
                    $session = Session::put('admin', $email);

                    return redirect()->intended('/administrator/home')->with($session);
                }
            }

            $message = Session::flash('error', 'Invalid email/password provided!');
            return redirect()->back()->withInput()->with($message);
        } catch (\Exception $e) {
            $error = Session::flash('error', 'Sorry, your request could not be completed.');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Home page
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        try {
            // Check authentication
            $session = $request->session()->get('admin');
            if (!$session) return redirect()->to($this->redirectTo);

            $admin = Admin::where('email', $session)->first();

            return view('administrator.dashboard', [
                'admin' => $admin,
            ]);
        } catch (\Exception $ex) {
            return redirect()->to('/');
        }
    }

    /**
     * Profile page
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        try {
            // Check authentication
            $session = $request->session()->get('admin');
            if (!$session) return redirect()->to($this->redirectTo);

            $admin = Admin::where('email', $session)->first();

            return view('administrator.profile', [
                'admin' => $admin,
            ]);
        } catch (\Exception $ex) {
            return redirect()->back();
        }
    }

    /**
     * Update Profile
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        try {
            // Check authentication
            $session = $request->session()->get('admin');
            if (!$session) return redirect()->to($this->redirectTo);

            $admin = Admin::where('email', $session)->first();

            # validation rules
            $rules = [
                'name' => 'required',
                'phone' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            # validate phone number
            $validatePhone = Admin::whereNotNull('phone')->where('phone', $request->phone)->first();
            if ($validatePhone && $validatePhone->id != $admin->id) {
                $error = Session::flash('error', 'Phone number already exist.');
                return redirect()->back()->with($error)->withInput();
            }

            # update admin info
            Admin::find($admin->id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);

            $success = Session::flash('success', 'Profile updated!');
            return redirect()->to('administrator/profile')->with($success);
        } catch (\Exception $ex) {
            $error = Session::flash('error', 'Profile update failed!');
            return redirect()->back();
        }
    }

    /**
     * Update Password
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        try {
            // Check authentication
            $session = $request->session()->get('admin');
            if (!$session) return redirect()->to($this->redirectTo);

            $admin = Admin::where('email', $session)->first();

            # validation rules
            $rules = [
                'old_password' => 'required',
                'new_password' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            # update user password
            Admin::find($admin->id)->update(['password' => Hash::make($request->new_password)]);

            $success = Session::flash('success', 'Password updated!');
            return redirect()->to('administrator/profile')->with($success);
        } catch (\Exception $ex) {
            $error = Session::flash('error', 'Password update failed. Try again');
            return redirect()->back();
        }
    }

    /**
     * Stock Page
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function stock(Request $request)
    {
        try {
            // Check authentication
            $session = $request->session()->get('admin');
            if (!$session) return redirect()->to($this->redirectTo);

            $admin = Admin::where('email', $session)->first();

            # stocks
            $stocks = Stock::orderBy('created_at', 'DESC')->get();

            return view('administrator.stock', [
                'admin' => $admin,
                'stocks' => $stocks,
            ]);
        } catch (\Exception $ex) {
            return redirect()->back();
        }
    }

    /**
     * Create Stock
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createStock(Request $request)
    {
        try {
            # validation rules
            $rules = [
                'name' => 'required',
                'price' => 'required',
                'unit' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            # check if stock exist
            $checkStock = Stock::where('name', $request->name)
                ->where('unit', $request->unit)
                ->first();

            if ($checkStock) {
                $error = Session::flash('error', 'Stock already exist');
                return redirect()->back()->with($error)->withInput();
            }

            # create stock
            Stock::create([
                'name' => $request->name,
                'current_price' => $request->price,
                'unit' => $request->unit,
            ]);

            // fetch all users
            $subscribers = Subscriber::all();
            foreach ($subscribers as $list) {
                $this->sendNotification($list->phone, 'Hey ' . $list->name . ', A new stock has been created, kindly visit our site to check.');
            }

            $success = Session::flash('success', 'Stock created!');
            return redirect()->to('administrator/stock')->with($success);
        } catch (\Exception $ex) {
            $error = Session::flash('error', 'Error creating stock');
            return redirect()->to('administrator/stock')->with($error)->withInput();
        }
    }

    /**
     * Edit Stock
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function editStock(Request $request, $stock)
    {
        try {
            // Check authentication
            $session = $request->session()->get('admin');
            if (!$session) return redirect()->to($this->redirectTo);

            $admin = Admin::where('email', $session)->first();

            # stocks
            $stocks = Stock::orderBy('created_at', 'DESC')->get();

            # edit category
            $edit = Stock::findOrFail($stock);

            return view::make('administrator.stock')->with([
                'admin' => $admin,
                'stocks' => $stocks,
                'edit' => $edit,
            ]);
        } catch (\Exception $ex) {
            return redirect()->back();
        }
    }

    /**
     * Update Stock
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStock(Request $request, $stock)
    {
        try {
            # validation rules
            $rules = [
                'name' => 'required',
                'price' => 'required',
                'unit' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            # check if stock exist
            $checkStock = Stock::where('name', $request->name)
                ->where('unit', $request->unit)
                ->first();

            if ($checkStock && $checkStock->id != $stock) {
                $error = Session::flash('error', 'Stock already exist');
                return redirect()->back()->with($error);
            }

            # stock data
            $stockData = Stock::findOrFail($stock);

            # create saving category
            Stock::find($stock)->update([
                'name' => $request->name,
                'current_price' => $request->price,
                'previous_price' => $stockData->current_price,
                'unit' => $request->unit,
            ]);

            $subscribers = Subscriber::all();
            foreach ($subscribers as $list) {
                $this->sendNotification($list->phone, 'Hey ' . $list->name . ', stock price have been updated for (' . $request->name . ').');
            }

            $success = Session::flash('success', 'Stock updated!');
            return redirect()->to('administrator/stock')->with($success);
        } catch (\Exception $ex) {
            $error = Session::flash('error', 'Error updating stock');
            return redirect()->to('administrator/stock')->with($error)->withInput();
        }
    }

    /**
     * Delete Stock
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteStock(Request $request)
    {
        try {
            $stock = Stock::find($request->id);
            $stock->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Stock deleted!',
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 203,
                'message' => 'Unable to delete stock'
            ], 203);
        }
    }

    /**
     * Logout
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            Session::flush(); 
            Session::forget('admin');
            Auth::logout();

            return redirect()->to($this->redirectTo);
        } catch (\Exception $ex) {
            return redirect()->to($this->redirectTo);
        }
    }
}
