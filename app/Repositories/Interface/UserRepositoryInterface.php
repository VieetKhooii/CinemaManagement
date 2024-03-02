<?php

namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getAUser(string $id);
    public function addUser(array $user);
    public function updateUser(array $user, string $id);
    public function login(string $nameOrEmail, string $password);
}
