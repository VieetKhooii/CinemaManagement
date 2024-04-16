<?php

namespace App\Repositories;

use App\Models\ShowtimeRoom;
use App\Models\Showtimes;
use App\Repositories\Interface\ShowtimeRoomRepositoryInterface;
use DateTime;

class ShowtimeRoomRepo implements ShowtimeRoomRepositoryInterface{
    public function getAllShowtimeRooms(){
        try {
            return ShowtimeRoom::all();
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRoomRepo  (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function addShowtimeRoom(array $data){
        try {
            return ShowtimeRoom::create($data);
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRoomRepo  (add): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAShowtimeRoom(string $showtimeId, string $roomId){
        try {
            return ShowtimeRoom::where('showtime_id', $showtimeId)
                ->where('room_id', $roomId)->first();
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRoomRepo  (get a): " . $exception->getMessage());
            return null;    
        }
    }
    public function removeShowtimeRoom(string $showtimeId, string $roomId){
        try {
            return ShowtimeRoom::where('showtime_id', $showtimeId)
                ->where('room_id', $roomId)->delete();
        }
        catch (\Exception $exception){
            echo("Error ShowtimeRoomRepo  (delete): " . $exception->getMessage());
            return null;    
        }
    }

    public function checkTimeRoomExists($date, $time, $room){
        $isExisted = false;
        $showtimeRoom = ShowtimeRoom::where('room_id', $room)->get();
        foreach ($showtimeRoom as $sr) {
            $showtime = Showtimes::find($sr->showtime_id);
            $date1 = new DateTime($showtime->date);
            $date2 = new DateTime($date);
            if($date1 == $date2 && $showtime->start_time == $time){
                $isExisted = true;
            }
        }
        return $isExisted;
    }
}