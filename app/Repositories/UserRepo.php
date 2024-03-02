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
            $result = Users::all();
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

    public function login(string $nameOrEmail, string $password){
        try {
            $credentials = [
                'email' => $nameOrEmail,
                'password' => $password,
            ];
            
            if (Auth::attempt($credentials)) {
                // $request->session()->regenerate();
                return "true";
                //  return redirect()->intended('/');
            }
        
            // Authentication failed, return an error response
            echo("Error UserRepo (login): Wrong information");
            return null;
        }
        catch (\Exception $exception){
            echo("Error UserRepo (login): " . $exception->getMessage());
            return null;
        }
    }
}
