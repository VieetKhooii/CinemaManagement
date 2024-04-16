<?php
namespace App\Repositories;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Models\Reservation;

class ReservationRepo implements ReservationRepositoryInterface{
    public function getAllReservations(){
        try {
           return Reservation::paginate(5);
        }
        catch (\Exception $exception){
            echo("Error ReservationRepo (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAReservation(string $id){
        try {
           return Reservation::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error ReservationRepo (get by id): " . $exception->getMessage());
            return null;    
        }
    }
    public function addReservation(array $data){
        try {
           return Reservation::create($data);
        }
        catch (\Exception $exception){
            echo("Error ReservationRepo (add): " . $exception->getMessage());
            return null;    
        }
    }
    public function deleteReservation(string $id){
        try {
            return Reservation::destroy($id);
         }
         catch (\Exception $exception){
             echo("Error ReservationRepo (delete): " . $exception->getMessage());
             return null;    
         }
    }
}