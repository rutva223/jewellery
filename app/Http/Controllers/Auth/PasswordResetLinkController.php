<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $email = $request->email;

        $admin = User::where('email', $email)->first();

        $website_url = config('global.website_url');
        $button_url  = $website_url . "reset-password/" . encrypt($admin->id);
        $admin->reset_url = $button_url;
        $admin->save();

        $details = [
            'button_url'=> $button_url,
        ];


        $mailData = getMailData();
        $from_email = $mailData['from_email'];
        $fromName = $mailData['from_name'];
        $to_client_email = $email;

        try {
            Mail::send("email.forgot-password", $details, function ($message) use ($from_email, $to_client_email, $fromName) {
                $message->to($to_client_email);
                $message->from($from_email, $fromName)
                    ->subject('Request for forgot password');
            });
            Log::info("------------SendMailPassword------------------");
            return response()->json(['success' => 'A confirmation email has been sent. Please check your email inbox for further instructions.']);

        } catch (\Exception $e) {
            Log::error("send mail.{$e->getMessage()}");
            return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
        }
        Log::info("TRY Resend OTP mail Success");
    }
}
