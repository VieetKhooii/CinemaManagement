<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Cookie;

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
            'full_name' => 'required|string|between:1,50',
            'email' => 'required|string|between:1,100|email|ends_with:@gmail.com|',
            'phone' => 'required|string|size:10',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|between:1,20',
            'address' => 'required|string|between:1,100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'status' => 'error'], 
                422);
        }
        $user = [
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
        ];
        if ($request->has('score')) {
            $user['score'] = $request->input('score');
        }
        if ($request->has('coin')) {
            $user['coin'] = $request->input('coin');
        }
        if ($request->has('status')) {
            $user['status'] = $request->input('status');
        }
        if ($request->has('role_id')) {
            $user['role_id'] = $request->input('role_id');
        }
        $result = $this->userService->updateUser($user, $id);
        if ($result){
            return response()->json([
                'message' => 'User updated successfully',
                'status' => 'success',
                'data' => $result
            ], 201);
        }
        else {
            return response()->json([
                'error' => 'update failed',
                'status' => 'error'], 
                500);
        }
    }

    public function search(Request $request){
        $array = [
            'user_id' => $request->input('user_id'),
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
        $user = $this->userService->searchUser($array);
        if ($user){
            return response()->json(['status' => 'success', 'message' => 'user searched successfully', 'data' => $user], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide (string $id){
        $array = [
            'status' => false,
        ];
        $user = $this->userService->updateUser($array, $id);
        if ($user){
            return response()->json(['status' => 'success', 'message' => 'user hid successfully', 'data' => $user], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hideFromClient (Request $request, string $id){
        $curr_password = $request->input('password_now');
        $user = Users::where('user_id', $id)->firstOrFail();
        if (!Hash::check($curr_password, $user->password)){
            return response()->json(['status' => 'error', 'message' => 'Mật khẩu hiện tại không đúng'], 422);
        }
        $array = [
            'status' => false,
        ];
        $user = $this->userService->updateUser($array, $id);
        if ($user){
            return response()->json(['status' => 'success', 'message' => 'user hid successfully', 'data' => $user], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
} 