<?php

namespace App\Repositories;
use App\Models\Consumes;
use App\Repositories\Interface\ConsumeRepositoryInterface;

class ConsumeRepo implements ConsumeRepositoryInterface{

    public function getAllConsumes(){
        try {
            return Consumes::paginate(6);
        }
        catch (\Exception $exception){
            echo("Error ConsumeRepo (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAllConsumesForCustomer(){
        try {
            return Consumes::where('display',1)->paginate(6);
        }
        catch (\Exception $exception){
            echo("Error ConsumeRepo (get for customer): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAConsume(string $id){
        try {
            return Consumes::findOrFail($id);   
        }
        catch (\Exception $exception){
            echo("Error ConsumeRepo (get by id): " . $exception->getMessage());
            return null;    
        }
    }
    public function addConsume(array $data){
        try {
            return Consumes::create($data);    
        }
        catch (\Exception $exception){
            echo("Error ConsumeRepo (add): " . $exception->getMessage());
            return null;    
        }
    }
    public function updateConsume(array $data, string $id){
        try {
            return Consumes::findOrFail($id)->update($data);
        }
        catch (\Exception $exception){
            echo("Error ConsumeRepo (update): " . $exception->getMessage());
            return null;    
        }
    }
    public function searchConsume(array $data){
        try {
            return Consumes::search($data);
        }
        catch (\Exception $exception){
            echo("Error ConsumeRepo (search): " . $exception->getMessage());
            return null;    
        }
    }
}