<?php

namespace App\Http\Controllers;

use App\Models\FrontedUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful!',
                    'redirect' => route('home'), // Redirect to a desired route
                ]);


            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials. Please try again.',
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function FrontedUserRegister(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:fronted_users,email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Create new user
            $new_user = new FrontedUser();
            $new_user->email = $request->email;
            $new_user->password = Hash::make($request->password);
            $new_user->last_login = Carbon::now();
            $new_user->save();

            return response()->json([
                'success' => true,
                'message' => 'Registration successful!',
                'redirect' => route('home'), // Redirect to desired route
            ]);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function ForgotPassword(Request $request)
    {
        dd($request->all());
    }

    public function FrontedUserLogout(Request $request)
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
        $request->session()->forget('admin_name');
        $request->session()->forget('admin_id');
        $request->session()->forget('login_id');
        $request->session()->forget('admin_email');
        $request->session()->forget('a_type');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('logout', true);
    }
}
