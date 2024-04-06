<?php

namespace App\Repositories;

use App\Models\Transactions;
use App\Repositories\Interface\TransactionRepositoryInterface;

class TransactionRepo implements TransactionRepositoryInterface{
    public function getAllTransactions(){
        try {
            return Transactions::paginate(10);
        }
        catch (\Exception $exception){
            echo("Error TransactonRepo (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAllTransactionsForCustomer(){
        try {
            return Transactions::where('display', 1)->paginate(10);
        }
        catch (\Exception $exception){
            echo("Error TransactonRepo (get 4 cus): " . $exception->getMessage());
            return null;    
        }
    }
    public function getATransaction(string $id){
        try {
            return Transactions::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error TransactonRepo (get by id): " . $exception->getMessage());
            return null;    
        }
    }
    public function addTransaction(array $data){
        try {
            return Transactions::create($data);
        }
        catch (\Exception $exception){
            echo("Error TransactionRepo (add): " . $exception->getMessage());
            return null;    
        }
    }
    public function updateTransaction(array $data, string $id){
        try {
            return Transactions::findOrFail($id)->update($data);
        }
        catch (\Exception $exception){
            echo("Error TransactonRepo (update): " . $exception->getMessage());
            return null;    
        }
    }
    public function searchTransaction(array $data){
        try {
            return Transactions::search($data);
        }
        catch (\Exception $exception){
            echo("Error TransactonRepo (search): " . $exception->getMessage());
            return null;    
        }
    }
}