<?php

namespace App\Http\Controllers;

use App\Models\FrontedUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontedUserController extends Controller
{
    public function FrontedUserLogin(Request $request)
    {
        try {
            $new_user = FrontedUser::where('email', $request->email)->first();
            if($new_user) {
                $new_user->last_login = Carbon::now();
                $new_user->save();

                session()->put('admin_name', $new_user->name);
                session()->put('admin_id', $new_user->id);
                session()->put('login_id', $new_user->id);
                session()->put('admin_email', $new_user->email);
                session()->put('a_type', 1);

                return redirect()->back()->with('success', 'Login Successfully!');
            } else {
                return redirect()->back()->with('error', 'This Email not Found!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function FrontedUserRegister(Request $request)
    {
        try {
            $new_user = FrontedUser::where('email', $request->email)->first();
            if(!$new_user) {
                // Create new user
                $new_user = new FrontedUser();
                $new_user->email = $request->email;
                $new_user->password = Hash::make($request->password);
                $new_user->last_login = Carbon::now();
                $new_user->save();

                return redirect()->back()->with('success', 'Registered Successfully!');
            } else {
                return redirect()->back()->with('error', 'This Email Already Registered!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function ForgotPassword(Request $request)
    {
        dd($request->all());
    }

    public function FrontedUserLogout()
    {
        dd('logout user');
    }
}
