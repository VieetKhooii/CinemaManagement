<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Service\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $credentials = [
            'email' => $email,
            'password' => $password,
            'status' => 1,
        ];
        
        $token = Auth::attempt($credentials);
        if ($token) {
            // $request->session()->regenerate();
            // return response()->json(['message' => 'Login Successfully'], 201);
            $user = Auth::user();
            // $token = $request->user()->createToken($email, ['*'], now()->addMinutes(5));
            return response()->json([
                'message' => 'Login Successfully',
                'status' => 'success',
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
                ]);
            //  return redirect()->intended('/');
        }
        else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',    
            ], 401);
        }
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();
        // DB::table('personal_access_tokens')->where('tokenable_id', auth()->id())->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('auth:api', ['except' => ['login','register','logout']]);
    }
    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
