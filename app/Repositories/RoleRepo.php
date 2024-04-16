<?php

namespace App\Repositories;

use App\Models\Roles;
use App\Repositories\Interface\RoleRepositoryInterface;

class RoleRepo implements RoleRepositoryInterface{
    public function getAllRole(){
        try {
            $result = Roles::paginate(20);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error RoleRepo (get): " . $exception->getMessage());
            return null;
        }
    }

    // public function addRole(array $info){
    //     try {
    //         $result = Roles::create($info);
    //         return $result;
    //     }
    //     catch (\Exception $exception){
    //         echo("Error RoleRepo (create): " . $exception->getMessage());
    //         return null;
    //     }
    // }

    public function updateRole(array $info, string $id){
        try {
            $result = Roles::where('role_id', $id)->update($info);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error RoleRepo (update): " . $exception->getMessage());
            return null;
        }
    }

    public function searchRole(array $data){
        try {
            return Roles::search($data);
        }
        catch (\Exception $exception){
            echo("Error RoleRepo (search): " . $exception->getMessage());
            return null;    
        }
    }

    public function existByName($name){
        $count = Roles::where('role_name', $name)->count();

        // Trả về true nếu tên đã tồn tại, ngược lại trả về false
        return $count > 0;
    }
}