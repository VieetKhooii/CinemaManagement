<?php

namespace App\Service;

use App\Repositories\Interface\RoleRepositoryInterface;

class RoleService{
    protected $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository) {
        $this->roleRepository = $roleRepository;
    }
    public function getAllRole(){
        return $this->roleRepository->getAllRole();
    }

    // public function addRole(array $info){
    //     return $this->roleRepository->addRole($info);
    // }

    public function updateRole(array $info, string $id){
        return $this->roleRepository->updateRole($info, $id);
    }
}