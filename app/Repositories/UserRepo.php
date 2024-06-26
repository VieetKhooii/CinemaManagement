<?php

namespace App\Repositories;

use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserRepo implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        try {
            $result = Users::paginate(5);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error UserRepo (get): " . $exception->getMessage());
            return null;
        }
    }

    public function getAUser(string $id){
        try {
            $result = Users::findOrFail($id);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error UserRepo (get a user): " . $exception->getMessage());
            return null;
        }
    }

    public function addUser(array $users){
        try {
            $result = Users::create($users);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error UserRepo (create): " . $exception->getMessage());
            return null;
        }
    }

    public function updateUser(array $user, string $id){
        try {
            $result = Users::where('user_id', $id)->update($user);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error UserRepo (update): " . $exception->getMessage());
            return null;
        }
    }

    public function searchUser(array $info){
        try {
            return Users::search($info);
        }
        catch (\Exception $exception){
            echo("Error UserRepo (search): " . $exception->getMessage());
            return null;    
        }
    }

    public function existByName($name){
        $count = Users::where('full_name', $name)->count();

        // Trả về true nếu tên đã tồn tại, ngược lại trả về false
        return $count > 0;
    }
}
