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

    public function updateRole(array $data, $id){
        if(array_key_exists('role_name', $data)){
            if($this->roleRepository->existByName($data['role_name'])){
                throw new \Exception("Tên đã tồn tại trong cơ sở dữ liệu.");
            }
        }      
        return $this->roleRepository->updateRole($data, $id);
    }

    public function searchRole(array $data){
        return $this->roleRepository->searchRole($data);
    }
}