<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AttachJwtToken;
use App\Models\Users;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Service\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('auth:api', ['except' => ['login','register','logout']]);
    }
    
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
            $user = Auth::user();
            $responseJson = [
                'status' => 'success',
                'message' => 'Login Successfully',
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ];
            // $cookie = cookie('jwt', $token, 1, null, null, false, false);
            $response = new Response($responseJson);
            // Cookie::queue('jwt', $token, 1);
            // $response->header('Set-Cookie', "jwt={$token}; Expires=" . gmdate('D, d M Y H:i:s T', time() + 1) . '; Path=/; Secure; ');
            $response->withCookie(cookie('jwt', $token, 1, null, null, false, false));

            // $token = $request->user()->createToken($email, ['*'], now()->addMinutes(5));
            return $response;
            //  return redirect()->intended('/');
        }
        else {
             $responseJson = [
                'status' => 'error',
                'message' => 'Email or password incorrect!',    
            ];
            $response = new Response($responseJson);
            return $response;
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
        // Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
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
