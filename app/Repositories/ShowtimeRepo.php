<?php

namespace App\Repositories;

use App\Models\Movies;
use App\Models\Showtimes;
use App\Repositories\Interface\ShowtimeRepositoryInterface;

class ShowtimeRepo implements ShowtimeRepositoryInterface{
    public function getAllShowtimes(){
        try {
            return Showtimes::paginate(10);
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRepo  (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAllShowtimesForCustomer(){
        try {
            return Showtimes::where('display', 1)->get();
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRepo  (get for customer): " . $exception->getMessage());
            return null;    
        }
    }

    public function findOverlappingShowtime($roomId, \DateTime $newStartDateTime, \DateTime $newEndDateTime) {
        $newStartTimeStr = $newStartDateTime->format('Y-m-d H:i:s');
        $newEndTimeStr = $newEndDateTime->format('Y-m-d H:i:s');
    
        return Showtimes::where('room_id', $roomId)
            ->where(function($query) use ($newStartTimeStr, $newEndTimeStr) {
                $query->where(function($query) use ($newStartTimeStr, $newEndTimeStr) {
                    $query->where('start_time', '<', $newEndTimeStr);
                        //   ->whereRaw("DATE_ADD(start_time, INTERVAL duration MINUTE) > ?", [$newStartTimeStr]);
                });
            })
            ->first();
    }
    
    
    

    public function getAShowtime(string $id){
        try {
            return Showtimes::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRepo  (get by id): " . $exception->getMessage());
            return null;    
        }
    }
    public function addShowtime(array $data){
        try {
            $display = [
                'display' => 1
            ];
            Movies::findOrFail($data['movie_id'])->update($display);
            return Showtimes::create($data);
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRepo (add): " . $exception->getMessage());
            return null;    
        }
    }
    public function updateShowtime(array $data, string $id){
        try {
            return Showtimes::findOrFail($id)->update($data);
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRepo (update): " . $exception->getMessage());
            return null;    
        }
    }
    public function searchShowtime(array $data){
        try {
            return Showtimes::search($data);
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRepo (search): " . $exception->getMessage());
            return null;    
        }
    }
}