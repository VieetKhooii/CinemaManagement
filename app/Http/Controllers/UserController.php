<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(string $User_Id)
    {
        $users = $this->userRepository->getAllUsers($User_Id);
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
        $user1 = $this->userRepository->addUser($userArray);
        return $user1;
    }
}
