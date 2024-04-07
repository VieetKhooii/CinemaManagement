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
}