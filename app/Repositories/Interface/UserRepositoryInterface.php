<?php

namespace App\Repositories\Interface;

use App\Models\Users;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getAUser(string $id);
    public function addUser(array $user);
    public function updateUser(array $user);
}
