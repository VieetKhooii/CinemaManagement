<?php

namespace App\Repositories;

use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepo implements UserRepositoryInterface
{
    public function getAllUsers(string $User_Id)
    {
        $users = Users::findOrFail($User_Id);
        return $users;
    }

    public function addUser(array $users){
        return Users::create($users);
    }
}
