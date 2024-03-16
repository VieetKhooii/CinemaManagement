<?php
namespace App\Repositories;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Models\Reservation;

class ReservationRepo implements ReservationRepositoryInterface{
    public function getAllReservations(){
        try {
           return Reservation::all();
        }
        catch (\Exception $exception){
            echo("Error ReservationRepo (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAllReservationsForCustomer(){
        try {
           return Reservation::where('display', 1)->get();
        }
        catch (\Exception $exception){
            echo("Error ReservationRepo (get for cus): " . $exception->getMessage());
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
    public function updateReservation(array $data, string $id){
        try {
           return Reservation::findOrFail($id)->update($data);
        }
        catch (\Exception $exception){
            echo("Error ReservationRepo (update): " . $exception->getMessage());
            return null;    
        }
    }
    public function searchReservation(array $data){
        try {
           return Reservation::search($data);
        }
        catch (\Exception $exception){
            echo("Error ReservationRepo (searcg): " . $exception->getMessage());
            return null;    
        }
    }
}