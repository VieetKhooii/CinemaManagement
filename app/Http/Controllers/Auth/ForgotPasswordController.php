<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['email' => 'required|string|between:1,100|email|ends_with:@gmail.com']
        );
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT){
            return response()->json(['message' => 'Reset password link sent!'], 201);
        }
        else {
            return response()->json(['error' => 'Reset password link already sent or email not existed!'], 403);
            // return back()->withErrors(['email' => trans($status)]);
        }
        // return $status === Password::RESET_LINK_SENT 
        //             ? back()->with(['status' => __($status)])
        //             : back()->withErrors(['email' => __($status)]);
    }

    public function resetRequest(string $token) {
        return view('auth.verify', ['token' => $token]);
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Users $user, string $password){
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET){
            return response()->json(['message' => 'Password has been reset'], 201);
        }
        else {
            return response()->json(['error' => 'Error']);
        }
    }
    use SendsPasswordResetEmails;
}