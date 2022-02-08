<?php

namespace App\Http\Controllers;

use App\Models\{
    Stock,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    View,
    Session,
    Validator,
};
use Illuminate\Support\Str;
use App\Traits\Helper;

class WebController extends Controller
{
    use Helper;

    /**
     * Index Page
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $stocks = Stock::orderBy('updated_at', 'DESC')->get();
            return view::make('index')->with([
                'stocks' => $stocks,
            ]);
        } catch (\Exception $ex) {
            abort(404);
        }
    }

    public function subscribe(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'phone' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            # check phone in user log
            $checkPhoneNumber = User::whereNotNull('phone')->where('phone', $request->phone)->first();
            if ($checkPhoneNumber) {
                $error = Session::flash('error', 'Phone number alredy exist');
                return redirect()->back()->withInput()->with($error);
            }

            # create user account
            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'is_admin' => false,
                'remember_token' => Str::uuid(),
                'password' => Hash::make($request->phone),
            ]);

           
            # send notification sms
            $notify = $this->sendNotification($request->phone, 'Hey '.$request->name.', welcome on board.');

            $success = Session::flash('success', 'Registration successful. Welcome on board');
            return redirect()->back()->with($success);
        } catch (\Exception $ex) {
            $error = Session::flash('error', 'Sorry, your registration could not be completed.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Login
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->with($validator)->withInput()->withErrors($validator);
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                # authorize user
                Auth::user();

                return redirect()->to('administrator/home');
            } else {
                $error = Session::flash('error', 'Invalid login credentials');
                return redirect()->back()->with($error)->withInput();
            }
        } catch (\Exception $ex) {
            $error = Session::flash('error', 'Login error, please try again');
            return redirect()->back()->with($error); 
        }
    }
}