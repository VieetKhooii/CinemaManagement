<?php
namespace App\Service;
use App\Repositories\Interface\ComboRepositoryInterface;

class ComboService{
    protected $comboRepository;
    public function __construct(ComboRepositoryInterface $comboRepository){
        $this->comboRepository = $comboRepository;
    }

    public function getAllCombos(){
        return $this->comboRepository->getAllCombos();
    } 

    public function getAllCombosForCustomer(){
        return $this->comboRepository->getAllCombosForCustomer();
    }

    public function getACombo($id){
        return $this->comboRepository->getACombo($id);
    }

    public function addCombo(array $data){
        return $this->comboRepository->addCombo( $data );
    }

    public function updateCombo(array $data, $id){
        return $this->comboRepository->updateCombo( $data, $id);
    }

    public function searchCombo(array $data){
        return $this->comboRepository->searchCombo($data);
    }
}

