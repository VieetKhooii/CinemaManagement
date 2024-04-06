<?php

namespace App\Repositories;

use App\Models\Voucher;
use App\Repositories\Interface\VoucherRepositoryInterface;

class VoucherRepo implements VoucherRepositoryInterface{
    public function getAllVoucher(){
        try {
            $result = Voucher::paginate(20);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error VoucherRepo (get): " . $exception->getMessage());
            return null;
        }
    }

    public function addVoucher(array $info){
        try {
            $result = Voucher::create($info);
            // $info['voucher_id'] = $info['voucher_id'] + $result->voucher_id;
            // echo $info['voucher_id'];
            // $result = Voucher::where('voucher_id', $info['voucher_id'])->update($info);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error VoucherRepo (create): " . $exception->getMessage());
            return null;
        }
    }

    public function updateVoucher(array $info, string $id){
        try {
            $result = Voucher::where('user_id', $id)->update($info);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error VoucherRepo (update): " . $exception->getMessage());
            return null;
        }
    }

    public function searchByDate(string $date){
        try {
            $result = Voucher::findOrFail($date);
            return $result;
        }
        catch (\Exception $exception){
            echo("Error VoucherRepo (find vouchers): " . $exception->getMessage());
            return null;
        }
    }
}