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
            return Seats::select('*')
            ->join('seattypes', 'seats.seat_type_id', '=', 'seattypes.seat_type_id')
            ->where('seats.seat_id', 'like', '%' . $id . '%')
            ->where('seats.display', 1)
            ->get();
        }
        catch (\Exception $exception){
            echo("Error SeatRepo (get a Seat): " . $exception->getMessage());
            return null;    
        }
    }
    
    public function getASeatForController(string $id, string $showtime_id){
        try {
            return Seats::select('seats.*', 'seattypes.*')
            ->leftJoin('seattypes', 'seats.seat_type_id', '=', 'seattypes.seat_type_id')
            ->leftJoin('reservations', function ($join) use ($showtime_id) {
                $join->on('seats.seat_id', '=', 'reservations.seat_id')
                    ->where('reservations.showtime_id', '=', $showtime_id);
            })
            ->selectRaw('CASE WHEN reservations.seat_id IS NOT NULL THEN TRUE ELSE FALSE END AS final_is_reserved')
            ->where('seats.seat_id', 'like', '%' . $id . '%')
            ->where('seats.display', '=', 1)
            ->get();
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

    public function searchSeat($array){
        try {
            return Seats::search($array);
        }
        catch (\Exception $exception){
            echo("Error SeatRepo (search): " . $exception->getMessage());
            return null;    
        }
    }
    
}
