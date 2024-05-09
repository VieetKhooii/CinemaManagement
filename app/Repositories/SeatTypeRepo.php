<?php

namespace App\Repositories;

use App\Models\SeatTypes;
use App\Repositories\Interface\SeatTypeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatTypeRepo implements SeatTypeRepositoryInterface
{
    public function getAllSeatTypes()
    {      
        try {
            return SeatTypes::paginate(6);
        }
        catch (\Exception $exception){
            echo("Error SeatTypeRepo (get): " . $exception->getMessage());
            return null;    
        }
    }

    public function getAllSeatTypesForCustomer(){
        try {
            return SeatTypes::where('display', 1)->get();   
        }
        catch (\Exception $exception){
            echo("Error SeatTypeRepo (get by display): " . $exception->getMessage());
            return null;    
        }
    }

    public function getASeatType(string $id){
        try {
            return SeatTypes::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error SeatTypeRepo (get SeatType by id): " . $exception->getMessage());
            return null;    
        }
    }

    public function addSeatType(array $data){      
        try {
            return SeatTypes::create($data);
        }
        catch (\Exception $exception){
            echo("Error SeatTypeRepo (add): " . $exception->getMessage());
            return null;    
        }
    }

    public function updateSeatType(array $data, string $id){       
        try {
            $dataModel = SeatTypes::findOrFail($id);
            return $dataModel->update($data);
        }
        catch (\Exception $exception){
            echo("Error SeatTypeRepo (update): " . $exception->getMessage());
            return null;    
        }
    }

    public function searchSeatType($array){
        try {
            return SeatTypes::search($array);
        }
        catch (\Exception $exception){
            echo("Error SeatTypeRepo (search): " . $exception->getMessage());
            return null;    
        }
    }
    
}
