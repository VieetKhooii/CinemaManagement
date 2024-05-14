<?php

namespace App\Service;

use App\Repositories\Interface\VoucherRepositoryInterface;

class VoucherService{
    protected $voucherRepository;
    public function __construct(VoucherRepositoryInterface $voucherRepository) {
        $this->voucherRepository = $voucherRepository;
    }
    public function getAllVoucher(){
        return $this->voucherRepository->getAllVoucher();
    }

    public function addVoucher(array $info){
        return $this->voucherRepository->addVoucher($info);
    }

    public function updateVoucher(array $info, string $id){
        if(array_key_exists('voucher_name', $info)){
            if($this->voucherRepository->existByName($info['voucher_name'])){
                throw new \Exception("Tên đã tồn tại trong cơ sở dữ liệu.");
            }
        }      
        return $this->voucherRepository->updateVoucher($info, $id);
    }

    public function searchById(string $id){
        return $this->voucherRepository->searchByid($id);
    }

    public function searchVoucher(array $data){
        return $this->voucherRepository->searchVoucher($data);
    }
}