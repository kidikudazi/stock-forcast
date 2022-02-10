<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Stock;
use App\Traits\Helper;

class UserController extends Controller
{
    use Helper;

    /**
     * User home
     */
    public function home(Request $request)
    {
        try {
            $user = Auth::user();

            // Get all statistics
            $totalCrops = Stock::count();

            $freshCrops = Stock::whereNull('previous_price')->count();

            $updatedCrops = Stock::whereNotNull('previous_price')->count();

            return view('user.home', [
                'user'          => $user,
                'total_crops'   => $totalCrops,
                'fresh_crops'   => $freshCrops,
                'updated_crops' => $updatedCrops
            ]);
        } catch (\Exception $e) {
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
            $user = Auth::user();

            return view('user.profile', [
                'user' => $user,
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
            return redirect()->to('user/profile')->with($success);
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
            User::find($user->id)->update(['password' => Hash::make($request->new_password)]);

            $success = Session::flash('success', 'Password updated!');
            return redirect()->to('user/profile')->with($success);
        } catch (\Exception $ex) {
            $error = Session::flash('error', 'Password update failed. Try again');
            return redirect()->back();
        }
    }

    /**
     * User farm stocks page
     */
    public function stocks(Request $request)
    {
        try {
            $user = Auth::user();

            // Get farm stocks that were updated last 7 days
            $farmStocks = Stock::whereNotNull('previous_price')->whereDate('updated_at', '>=', now()->subDays(7))->paginate(15);

            return view('user.stocks', [
                'user'          => $user,
                'farm_stocks'   => $farmStocks,
            ]);
        } catch (\Exception $e) {
            $error = Session::flash('error', 'Password update failed. Try again');
            return redirect()->back();
        }
    }

    public function filterFarmStocks(Request $request)
    {
        try {
            $user = Auth::user();

            // Request form input
            $search = $request->search;

            if ($search == 'oldest') {
                // Get farm stocks that were updated last 7 days
                $farmStocks = Stock::whereNotNull('previous_price')->whereDate('updated_at', '>=', now()->subDays(7))->latest()->paginate(15)->appends(['search' => $search]);
            } else {
                // Get farm stocks that were updated last 7 days
                $farmStocks = Stock::whereNull('previous_price')->whereDate('updated_at', '>=', now()->subDays(7))->latest()->paginate(15)->appends(['search' => $search]);
            }

            return view('user.stocks', [
                'user'          => $user,
                'farm_stocks'   => $farmStocks,
            ]);
        } catch (\Exception $e) {
            $error = Session::flash('error', 'Password update failed. Try again');
            return redirect()->back();
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
            $admin = $request->session()->get('admin');
            if ($admin) $admin->forget();

            return redirect()->to('/');
        } catch (\Exception $ex) {
            return redirect()->to('/');
        }
    }
}
