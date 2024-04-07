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
        return $this->voucherRepository->updateVoucher($info, $id);
    }

    public function searchByDate(string $date){
        return $this->voucherRepository->searchByDate($date);
    }
}