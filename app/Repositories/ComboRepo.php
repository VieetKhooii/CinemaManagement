<?php

namespace App\Repositories;

use App\Models\Combos;
use App\Repositories\Interface\ComboRepositoryInterface;

class ComboRepo implements ComboRepositoryInterface{

    public function getAllCombos(){       
        try {
            return Combos::paginate(6);
        }
        catch (\Exception $exception){
            echo("Error ComboRepo (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAllCombosForCustomer(){       
        try {
            return Combos::where('display', 1)->paginate(6);
        }
        catch (\Exception $exception){
            echo("Error ComboRepo (get by customer): " . $exception->getMessage());
            return null;    
        }
    }
    public function getACombo(string $id){       
        try {
            return Combos::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error ComboRepo (get by id): " . $exception->getMessage());
            return null;    
        }
    }
    public function addCombo(array $combo){     
        try {
            return Combos::create($combo);
        }
        catch (\Exception $exception){
            echo("Error ComboRepo (add): " . $exception->getMessage());
            return null;    
        }
    }
    public function updateCombo(array $combo, string $id){       
        try {
            return Combos::findOrFail($id)->update($combo);
        }
        catch (\Exception $exception){
            echo("Error ComboRepo (update): " . $exception->getMessage());
            return null;    
        }
    }
    public function searchCombo(array $combo){    
        try {
            return Combos::search($combo);
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (search): " . $exception->getMessage());
            return null;    
        }
    }


}