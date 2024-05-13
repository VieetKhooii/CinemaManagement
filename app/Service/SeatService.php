<?php
namespace App\Service;

use App\Repositories\Interface\SeatRepositoryInterface;
use App\Repositories\Interface\RoomRepositoryInterface;
use Illuminate\Http\Request;

class SeatService{
    protected $seatRepository;
    protected $roomRepository;

    public function __construct(SeatRepositoryInterface $seatRepository, RoomRepositoryInterface $roomRepository)
    {
        $this->seatRepository = $seatRepository;
        $this->roomRepository = $roomRepository;
    }

    public function getAllSeats()
    {
        return $this->seatRepository->getAllSeats();
    }

    public function getAllSeatsForCustomer()
    {
        return $this->seatRepository->getAllSeatsForCustomer();
    }

    public function getASeat(string $id){
        return $this->seatRepository->getASeat($id);
    }

    public function getASeatForController(string $id, string $showtime_id){
        return $this->seatRepository->getASeatForController($id, $showtime_id);
    }

    public function addSeat(array $data)
    {
        foreach ($data as $key => $value) {
            if($key == 'room_id'){//tang so ghe trong phong
                $seatCount = $this->roomRepository->getARoom($value)->number_of_seat;
                $seatCount +=1;
                $this->roomRepository->updateRoom([
                    'number_of_seat'=> $seatCount
                ], $value);
                break;
            }
        }
        return $this->seatRepository->addSeat($data);
    }

    public function updateSeat(array $data, string $id){
        foreach ($data as $key => $value) {
            if($key == 'display' && $value == false){ // an^? ghe^' di thi` giam? so^' ghe^' trong phong`
                $room = $this->seatRepository->getASeat($id)->room_id;
                $seatCount = $this->roomRepository->getARoom($room)->number_of_seat;
                $seatCount -=1;
                $this->roomRepository->updateRoom([
                    'number_of_seat'=> $seatCount
                ], $room);
            }         
            if($key == 'room_id'){ //thay doi^? phong` cua? ghe^' giam? so^' ghe^' phong` cu~, tang so^' ghe^' phong` moi'
                $room = $this->seatRepository->getASeat($id)->room_id;
                if($value != $room){
                    //giam so ghe phong cu
                    $seatCount = $this->roomRepository->getARoom($room)->number_of_seat;
                    $seatCount -=1;
                    $this->roomRepository->updateRoom([
                        'number_of_seat'=> $seatCount
                    ], $room);
                    //tang so ghe phong moi
                    $seatCount = $this->roomRepository->getARoom($value)->number_of_seat;
                    $seatCount +=1;
                    $this->roomRepository->updateRoom([
                        'number_of_seat'=> $seatCount
                    ], $value);
                }       
            }
        }
        return $this->seatRepository->updateSeat($data, $id);
    }

    public function searchSeat($array)
    {
        return $this->seatRepository->searchSeat($array);
    }
}
