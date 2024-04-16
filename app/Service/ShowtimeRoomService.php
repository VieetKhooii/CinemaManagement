<?php

namespace App\Service;

use App\Repositories\Interface\ShowtimeRepositoryInterface;
use App\Repositories\Interface\ShowtimeRoomRepositoryInterface;
use Exception;

class ShowtimeRoomService {
    protected $showtimeRoomRepository;
    protected $showtimeRepository;
    public function __construct(
        ShowtimeRoomRepositoryInterface $showtimeRoomRepositoryInterface,
        ShowtimeRepositoryInterface $showtimeRepositoryInterface
    ){
        $this->showtimeRoomRepository = $showtimeRoomRepositoryInterface;
        $this->showtimeRepository= $showtimeRepositoryInterface;
    }

    public function getAllShowtimeRooms(){
        return $this->showtimeRoomRepository->getAllShowtimeRooms();
    }
    public function addShowtimeRoom(array $data){       
        try {
            $date = $this->showtimeRepository->getAShowtime($data['showtime_id'])->date;
            $time = $this->showtimeRepository->getAShowtime($data['showtime_id'])->start_time;
            if($this->showtimeRoomRepository->checkTimeRoomExists($date, $time, $data['room_id'])){
                throw new Exception("Dữ liệu đã tồn tại"); 
            }
            return $this->showtimeRoomRepository->addShowtimeRoom($data);
        } catch (Exception $e) {
            error_log('Caught exception: ' . $e->getMessage());
            // Đặt lại ngoại lệ để cho phép các phần tiếp theo xử lý (nếu cần)
            throw $e;
        }
    }
    public function removeShowtimeRoom(string $showtimeId, string $roomId){
        return $this->showtimeRoomRepository->removeShowtimeRoom($showtimeId, $roomId);
    }
}