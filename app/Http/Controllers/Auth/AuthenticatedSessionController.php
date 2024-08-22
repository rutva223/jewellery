<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // $request->authenticate();

        $request->session()->regenerate();

        $otp_val = (int)$request->input('otp_val');
        $admin = User::where('email', $request->email)->where('is_deleted', 0)->first();

        // Check if user exists and password is correct
        if ($admin) {
            $login_user_otp = $admin->email_otp;

            $currentUtcTime = Carbon::now('UTC');
            $otpExpiredUtcTime = Carbon::parse($admin->otp_expired, 'UTC');
            $is_valid = $currentUtcTime->lessThanOrEqualTo($otpExpiredUtcTime);

            if (!$is_valid) {
                $admin->email_otp = null;
                $admin->otp_expired = null;
                $admin->save();
                return response()->json(['success' => false, 'message' => 'OTP has expired!']);
            }

            if ($otp_val == $login_user_otp) {
                $request->session()->forget('decrypt_otp');

                session()->put('admin_name', $admin->name);
                session()->put('admin_id', $admin->id);
                session()->put('login_id', $admin->id);
                session()->put('admin_email', $admin->email);
                session()->put('a_type', 1);

                return response()->json(['success' => true, 'otp_sent' => true, 'redirect_url' => route('dashboard')]);
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid OTP entered.']);
            }

            // return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return redirect()->back()->with('error_msg', 'Invalid email or password');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
