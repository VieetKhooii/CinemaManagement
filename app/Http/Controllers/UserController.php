<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    use AuthenticatesUsers;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        if ($users){
            return response()->json([
                'status' => 'success',
                'message' => 'Get user successfully',
                'data' => $users,
                'last_page' => $users->lastPage()]);
        }
        else {
            return response()->json([
                'error' => '$validator->errors()', 
                'status' => 'error'], 
                422);
        }
    }

    public function show(string $id){
        return $this->userService->getAUser($id);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required|string|size:6',
            'full_name' => 'required|string|between:1,50',
            'email' => 'required|string|between:1,100|email|ends_with:@gmail.com',
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

        $userArray = [
            // 'user_id' => $request->input('user_id'),
            'full_name' => $request->input('full_name'),
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
            return response()->json([
                'message' => 'User created successfully',
                'status' => 'success',
                'users' => $user], 
                201);
        }
        // auth()->login($user);
        else {
            return response()->json(['error' => '$validator->errors()', 'status' => 'error'], 422);
        }
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|between:1,50',
            'email' => 'required|string|between:1,100|email|ends_with:@gmail.com',
            'phone' => 'required|string|size:10',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|between:1,20',
            'address' => 'required|string|between:1,100',
            'score' => 'required|int',
            'role_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => 'error'], 
                422);
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
            return response()->json([
                'message' => 'update successfully',
                'status' => 'success'],
                200);
        }
        else if ($result == 0){
            return response()->json([
                'message' => 'Data stays the same',
                'status' => 'error'], 
                200);
        }
        else {
            return response()->json([
                'error' => 'update failed',
                'status' => 'error'], 
                422);
        }
    }
} 