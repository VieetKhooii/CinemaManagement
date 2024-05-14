<?php

namespace App\Repositories\Interface;

interface VoucherRepositoryInterface{
    public function getAllVoucher();
    public function addVoucher(array $info);
    public function updateVoucher(array $info, string $id);
    public function searchById(string $id);
    public function searchVoucher(array $info);
    public function existByName($name);

}