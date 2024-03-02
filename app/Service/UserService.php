<?php
namespace App\Service;

use App\Models\Users;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

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

    public function getAUser(string $id){
        return $this->userRepository->getAUser($id);
    }

    public function addUser(array $user)
    {
        $user = $this->userRepository->addUser($user);
        return $user;
    }

    public function updateUser(array $user, string $id){
        return $this->userRepository->updateUser($user, $id);
    }

    public function login(string $nameOrEmail, string $password){
        return $this->userRepository->login($nameOrEmail, $password);
    } 
}
