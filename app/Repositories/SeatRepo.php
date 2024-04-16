<?php

namespace App\Repositories;

use App\Models\Rooms;
use App\Models\Seats;
use App\Repositories\Interface\SeatRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatRepo implements SeatRepositoryInterface
{
    public function getAllSeats()
    {      
        try {
            return Seats::paginate(10);
        }
        catch (\Exception $exception){
            echo("Error SeatRepo (get): " . $exception->getMessage());
            return null;    
        }
    }

    public function getAllSeatsForCustomer(){
        try {
            return Seats::where('display', 1)->get();
        }
        catch (\Exception $exception){
            echo("Error SeatRepo (get by customer): " . $exception->getMessage());
            return null;    
        }
    }

    public function getASeat(string $id){
        try {
            return Seats::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error SeatRepo (get a Seat): " . $exception->getMessage());
            return null;    
        }
    }

    public function addSeat(array $data){      
        try {           
            return Seats::create($data);
        }
        catch (\Exception $exception){
            echo("Error SeatRepo (add): " . $exception->getMessage());
            return null;    
        }
    }

    public function updateSeat(array $data, string $id){       
        try {          
            return Seats::findOrFail($id)->update($data);
        }
        catch (\Exception $exception){
            echo("Error SeatRepo (update): " . $exception->getMessage());
            return null;    
        }
    }

    public function searchSeat($row, $number, $reserve, $seatType, $room){
        try {
            return Seats::search($row, $number, $reserve, $seatType, $room)->paginate(10);
        }
        catch (\Exception $exception){
            echo("Error SeatRepo (search): " . $exception->getMessage());
            return null;    
        }
    }
    
}
