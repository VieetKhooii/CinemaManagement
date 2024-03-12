<?php
namespace App\Service;
use App\Repositories\Interface\ConsumeRepositoryInterface;

class ConsumeService{
    protected $consumeRepository;
    public function __construct(ConsumeRepositoryInterface $consumeRepository){
        $this->consumeRepository = $consumeRepository;
    }

    public function getAllConsumes(){
        return $this->consumeRepository->getAllConsumes();
    }
    public function getAllConsumesForCustomer(){
        return $this->consumeRepository->getAllConsumesForCustomer();
    }
    public function getAConsume(string $id){
        return $this->consumeRepository->getAConsume($id);
    }
    public function addConsume(array $data){
        $this->consumeRepository->addConsume($data);
    }
    public function updateConsume(array $data, string $id){
        $this->consumeRepository->updateConsume($data,$id);
    }
    public function searchConsume(array $data){
        $this->consumeRepository->searchConsume($data);
    }
}