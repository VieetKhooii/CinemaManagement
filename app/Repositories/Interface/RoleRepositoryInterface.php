<?php

namespace App\Repositories\Interface;

interface RoleRepositoryInterface{
    public function getAllRole();
    // public function addRole(array $info);
    public function updateRole(array $info, string $id);
 
    public function searchRole(array $info);

    public function existByName($name);
}