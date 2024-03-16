<?php

namespace App\Repositories;

use App\Models\Rooms;
use App\Repositories\Interface\RoomRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomRepo implements RoomRepositoryInterface
{
    public function getAllRooms()
    {      
        try {
            $Rooms = Rooms::paginate(6);
            return $Rooms;
        }
        catch (\Exception $exception){
            echo("Error RoomRepo (get): " . $exception->getMessage());
            return null;    
        }
    }

    public function getAllRoomsForCustomer(){
        try {
            return Rooms::where('display', 1)->get();   
        }
        catch (\Exception $exception){
            echo("Error RoomRepo (get for customer): " . $exception->getMessage());
            return null;    
        }
    }

    public function getARoom(string $id){
        try {
            return Rooms::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error RoomRepo (getaARoom): " . $exception->getMessage());
            return null;    
        }
    }

    public function addRoom(array $data){      
        try {
            return Rooms::create($data);
        }
        catch (\Exception $exception){
            echo("Error RoomRepo (addRoom): " . $exception->getMessage());
            return null;    
        }
    }

    public function updateRoom(array $data, string $id){       
        try {
            $roomModel = Rooms::findOrFail($id);
            return $roomModel->update($data);
        }
        catch (\Exception $exception){
            echo("Error RoomRepo (updateRoom): " . $exception->getMessage());
            return null;    
        }
    }

    public function searchRoom(array $data){
        try {
            return Rooms::search($data);
        }
        catch (\Exception $exception){
            echo("Error RoomRepo (searchRoom): " . $exception->getMessage());
            return null;    
        }
    }
    
}
