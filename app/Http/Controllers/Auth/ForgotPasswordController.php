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
            return response()->json(['status' => 'error', 'error' => $validator->errors()->first()], 422);
        }
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT){
            return response()->json(['status' => 'success', 'message' => 'Reset password link sent!', 'content' => $status], 201);
        }
        else {
            return response()->json(['status' => 'error', 'error' => 'Reset password link already sent or email not existed!'], 403);
            // return back()->withErrors(['email' => trans($status)]);
        }
        // return $status === Password::RESET_LINK_SENT 
        //             ? back()->with(['status' => __($status)])
        //             : back()->withErrors(['email' => __($status)]);
    }

    public function resetRequest(string $token) {
        // return view('resetpass', ['token' => $token]);
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|between:1,100|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)/',
        ]);

        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()->first()], 422);
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
            return response()->json(['status' => 'success', 'message' => 'Password has been reset'], 201);
        }
        else {
            return response()->json(['status' => 'error', 'error' => 'You cannot do this, please resent a new request to reset your password'], 400);
        }
    }
    use SendsPasswordResetEmails;
}
