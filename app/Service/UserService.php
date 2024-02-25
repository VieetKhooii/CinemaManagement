<?php

use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;

class UserService{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        $users = $this->userRepository->getAllUsers();
        return $users;
    }

    public function addUser(array $user)
    {
        $user = $this->userRepository->addUser($user);
        return $user;
    }
}
