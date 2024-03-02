<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
        $user = [
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
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