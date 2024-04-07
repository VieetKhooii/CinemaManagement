<?php

namespace App\Repositories\Interface;

interface RoleRepositoryInterface{
    public function getAllRole();
    // public function addRole(array $info);
    public function updateRole(array $info, string $id);
 
}