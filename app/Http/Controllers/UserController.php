<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use App\Service\UserService;
use Illuminate\Http\Request;

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
        // $array = $request->all();
        $userArray = [
            'User_Id' => $request->input('User_Id'),
            'User_Name' => $request->input('User_Name'),
            'Email' => 'john.doe@example.com',
            'Phone' => '1234567890',
            'Date_Of_Birth' => '1990-01-01',
            'Gender' => 'M',
            'Address' => '123 Main St',
            'Score' => 0,
            'Status' => true,
            'Role_Id' => 1,
        ];
        $user1 = $this->userService->addUser($userArray);
        return $user1;
    }

    public function update(Request $request){
        $id = $request->input('User_Id');
        $name = $request->input('User_Name');
        $email = $request->input('Email');
        $user = [
            'User_Id' => $id,
            'User_Name' => $name,
            'Email' => $email,
        ];
        $result = $this->userService->updateUser($user);
        return redirect('/users')->with('success', 'User updated successfully');
    }
}
