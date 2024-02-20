<?php

namespace App\Repositories\Interface;

use App\Models\Users;

interface UserRepositoryInterface
{
    public function getAllUsers(string $User_Id);
    public function addUser(array $user);
}
