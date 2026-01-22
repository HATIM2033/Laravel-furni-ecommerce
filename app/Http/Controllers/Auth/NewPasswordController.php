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
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        
        $resetUser = null;
        $requestData = $request->only('email', 'password', 'password_confirmation', 'token');
        $status = Password::reset(
            $requestData,
            function ($user, $token) use (&$resetUser, $requestData) {
                $user->forceFill([
                    'password' => Hash::make($requestData['password']),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
                
                
                $resetUser = $user;
            }
        );

       
        if ($status == Password::PASSWORD_RESET) {
            if ($resetUser && $resetUser->isAdmin()) {
                
                return redirect()->route('login')->with('status', __('Your password has been reset! Please login with your new password.'));
            } else {
                
                Auth::login($resetUser);
                
                return redirect()->route('home')->with('status', __('Your password has been reset!'));
            }
        }

        
        return back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
    }
}
