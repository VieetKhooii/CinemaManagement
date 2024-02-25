<?php

namespace App\Repositories;

use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRepo implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        $users = Users::all();
        return $users;
    }

    public function getAUser(string $id){
        return Users::findOrFail($id);
    }

    public function addUser(array $users){
        return Users::create($users);
    }

    public function updateUser(array $user){
        return Users::update($user);
    }
}
