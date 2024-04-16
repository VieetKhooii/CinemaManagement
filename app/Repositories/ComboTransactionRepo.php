<?php
namespace App\Repositories;
use App\Models\ComboTransaction;
use App\Repositories\Interface\ComboTransactionRepositoryInterface;

class ComboTransactionRepo implements ComboTransactionRepositoryInterface{
    public function getAllComboTransactions(){
        try {
           return ComboTransaction::all();
        }
        catch (\Exception $exception){
            echo("Error ComboTranRepo (get): " . $exception->getMessage());
            return null;    
        } 
    }
    public function getAComboTransaction(string $idCombo, string $idTran){
        try {
            return ComboTransaction::where('combo_id', $idCombo)
            ->where('transaction_id', $idTran)->first();
         }
         catch (\Exception $exception){
             echo("Error ComboTranRepo (get a): " . $exception->getMessage());
             return null;    
         } 
    }
    public function addComboTransaction(array $data){
        try {
           return ComboTransaction::create($data);
        }
        catch (\Exception $exception){
            echo("Error ComboTranRepo (add): " . $exception->getMessage());
            return null;    
        } 
    }
    public function updateComboTransaction(array $data, string $idCombo, string $idTran){
        try {
           return ComboTransaction::where('combo_id', $idCombo)
           ->where('transaction_id', $idTran)->update($data);
        }
        catch (\Exception $exception){
            echo("Error ComboTranRepo (update): " . $exception->getMessage());
            return null;    
        } 
    }
    public function removeComboTransaction(string $idCombo, string $idTran){
        try {
            return ComboTransaction::where('combo_id', $idCombo)
            ->where('transaction_id', $idTran)
            ->delete();    
        }
        catch (\Exception $exception){
            echo("Error ComboTranRepo (delete): " . $exception->getMessage());
            return null;    
        } 
    }
}