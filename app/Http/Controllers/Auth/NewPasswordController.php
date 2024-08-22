<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create($id): View
    {
        $id = decrypt($id);

        $user = User::where('id', $id)->first();
        if ($user) {
            $reset_url = $user->reset_url ?? null;
            if($reset_url){
                $user->reset_url = null;
                $user->save();
                $encrypt_id = encrypt($user->id);
                $email_id = $user->email;
                return view('auth.reset-password', compact('email_id', 'encrypt_id'));
            } else{
                abort(404);
            }
        }
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        $id = decrypt($request->id);
        $email_id = $request->email;
        $find_entry = User::where('id', $id)->where('email', $email_id)->first();

        if ($find_entry != null) {
            $find_entry->password = Hash::make($request->password);
            $find_entry->save();
            return redirect()->route('login')->with('success', 'Password has been changed successfully');
        } else {
            return redirect()->back()->with('error', 'URL Not Valid');
        }
    }
}
