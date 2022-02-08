<?php

namespace App\Http\Controllers;

use App\Models\{
    User,
    Stock
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

    /**
     * Home page
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        try {
            $user = Auth::user();

            return view::make('administrator.dashboard')->with([
                'admin' => $user,
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
            $user = Auth::user();

            return view::make('administrator.profile')->with([
                'admin' => $user,
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
            $user = Auth::user();

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
            $validatePhone = User::whereNotNull('phone')->where('phone', $request->phone)->first();
            if ($validatePhone && $validatePhone->id != $user->id) {
                $error = Session::flash('error', 'Phone number already exist.');
                return redirect()->back()->with($error)->withInput();
            }

            # update user info
            User::find($user->id)->update([
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
            $user = Auth::user();

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
            User::find($user->id)->update([ 'password' => Hash::make($request->new_password) ]);

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
            $user = Auth::user();

            # stocks
            $stocks = Stock::orderBy('created_at', 'DESC')->get();

            return view::make('administrator.stock')->with([
                'admin' => $user,
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
            $fetchAllUsers = User::where('is_admin', false)->get();

            foreach($fetchAllUsers as $list){

                $notify = $this->sendNotification($list->phone, 'Hey '.$list->name.', A new stock has been created, kindly visit our site to check.');
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
            $user = Auth::user();

            # stocks
            $stocks = Stock::orderBy('created_at', 'DESC')->get();

            # edit category
            $edit = Stock::findOrFail($stock);

            return view::make('administrator.stock')->with([
                'admin' => $user,
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

            $fetchAllUsers = User::where('is_admin', false)->get();

            foreach($fetchAllUsers as $list){

                $notify = $this->sendNotification($list->phone, 'Hey '.$list->name.', stock price have been updated for ('.$request->name.').');
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
            Auth::logout();

            return redirect()->to('/');
        } catch (\Exception $ex) {
            return redirect()->to('/'); 
        }
    }
}