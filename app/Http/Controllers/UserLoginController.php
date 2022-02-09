<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserLoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        try {
            // Set validation rules
            $rules = [
                'email' => 'required',
                'password' => 'required',
            ];

            // Validate rules
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                // Return validation message
                return redirect()->back()->withInput()->withErrors($validation);
            }

            // Check auth
            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->intended($this->redirectTo);
            }

            $message = Session::flash('error', 'Invalid email/password provided!');
            return redirect()->back()->withInput()->with($message);
        } catch (\Exception $e) {
            $error = Session::flash('error', 'Sorry, your request could not be completed.');
            return redirect()->back()->withInput();
        }
    }

    public function register(Request $request)
    {
        try {
            // Set validation rules
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|unique:users',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ];

            // Validate rules
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                // Return validation message
                return redirect()->back()->withInput()->withErrors($validation);
            }

            // Register new user
            User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'password'          => Hash::make($request->password),
            ]);
           
            # send notification sms
            $this->sendNotification($request->phone, 'Hey '.$request->name.', welcome on board.');

            $success = Session::flash('success', 'Registration was successful. Welcome on board');
            return redirect()->back()->with($success);

        } catch (\Exception $e) {
            $error = Session::flash('error', 'Sorry, your registration could not be completed.');
            return redirect()->back()->withInput()->with($error);
        }
    }
}
