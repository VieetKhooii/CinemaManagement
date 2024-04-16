<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Users
     */
    protected function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required|string|size:6',
            'full_name' => 'required|string|between:1,50',
            'email' => 'required|string|between:1,100|email|ends_with:@gmail.com|unique:users,email',
            'password' => 'required|string|between:1,100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)/', 
            'phone' => 'required|string|size:10',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|between:1,20',
            'address' => 'required|string|between:1,100',
            'role_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'status' => 'error'], 
                422);
        }

        $existingPhone = Users::where('phone', $request->input('phone'))->first();
        if ($existingPhone){
            return response()->json([
                'error' => "Phone has already existed",
                'status' => 'error'], 
                422);
        }
        $existingAddress = Users::where('address', $request->input('address'))->first();
        if ($existingAddress){
            return response()->json([
                'error' => "Address has already existed",
                'status' => 'error'], 
                422);
        }

        try {
            $user = Users::create([
                // 'user_id' => $request->input('user_id'),
                // 'user_id' => "123120",
                'full_name' => $request->input('full_name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'phone' => $request->input('phone'),
                'date_of_birth' => $request->input('date_of_birth'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'score' => 0,
                'status' => true,
                'role_id' => 3,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                // 'authorization' => [
                // 'token' => Auth::login($user),
                // 'type' => 'bearer',
                // ]
            ]);
        }
        catch (Exception $exception){
            if (strpos($exception->getMessage(),"Duplicate entry") == true){
                return response()->json([
                    'status' => 'error',
                    'error' => "Email already existed!",
                ]);
            }
            return response()->json([
                'status' => 'error',
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
