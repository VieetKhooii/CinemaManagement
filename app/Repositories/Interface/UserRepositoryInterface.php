<?php

namespace App\Repositories\Interface;

use App\Models\Users;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function addUser(array $user);
}
