<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    public function resetPass(Request $request){
        $curr_password = $request->input('password_now');
        $new_password = $request->input('password_new');
        $email = $request->input('email');
        $user = Users::where('email', $email)->firstOrFail();
        if (!Hash::check($curr_password, $user->password)){
            return response()->json(['status' => 'error', 'message' => 'Mật khẩu hiện tại không đúng'], 422);
        }
        else {
            $user->password = $new_password;
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'Mật khẩu đã được thay đổi thành công']);
        }
    }
}
