<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return $users;
        // return view('home', compact('users'));
    }

    public function show(string $id){
        return $this->userService->getAUser($id);
    }
    
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|size:6',
            'user_name' => 'required|string|between:1,50',
            'email' => 'required|string|between:1,100|email|ends_with:@gmail.com',
// email: must be a valid email address format.
            'password' => 'required|string|between:1,100|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)/', 
// confirmed: password_confirmation.
// regex:pattern: Password must contain one uppercase letter, one lowercase letter, one digit, and one special character.
            'phone' => 'required|string|size:10',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|between:1,20',
            'address' => 'required|string|between:1,100',
            'role_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userArray = [
            'user_id' => $request->input('user_id'),
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phone' => $request->input('phone'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'score' => 0,
            'status' => true,
            'role_id' => $request->input('role_id'),
        ];
        $user = $this->userService->addUser($userArray);
        if ($user){
            return response()->json(['message' => 'User created successfully', 'users' => $user], 201);
        }
        // auth()->login($user);
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|size:6',
            'user_name' => 'required|string|between:1,50',
            'email' => 'required|string|between:1,100|email|ends_with:@gmail.com',
            'password' => 'required|string|between:1,100|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)/', 
            'phone' => 'required|string|size:10',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|between:1,20',
            'address' => 'required|string|between:1,100',
            'role_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = [
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'score' => $request->input('score'),
            'status' => $request->input('status'),
            'role_id' => $request->input('role_id'),
        ];
        $result = $this->userService->updateUser($user, $id);
        if ($result){
            return response()->json(['message' => 'update successfully'], 200);
        }
        else {
            return response()->json(['error' => 'update failed'], 422);
        }
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $result = $this->userService->login($email, $password);
        if ($result){
            return response()->json(['message' => 'Login Successfully'], 201);
        }
        else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
} 