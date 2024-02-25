<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use UserService;

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

    public function addUser(){
        $userArray = [
            'User_Id' => '123333',
            'User_Name' => 'John Doe',
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
}
