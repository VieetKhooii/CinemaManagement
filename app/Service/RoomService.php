<?php

namespace App\Service;
use App\Repositories\Interface\RoomRepositoryInterface;

class RoomService{
    protected $roomRepository;
    public function __construct(RoomRepositoryInterface $roomRepository){
        $this->roomRepository = $roomRepository;
    }

    public function getAllRooms(){
        return $this->roomRepository->getAllRooms();
    }
    public function getAllRoomsForCustomer(){
        return $this->roomRepository->getAllRoomsForCustomer();
    }
    public function getARoom(string $id){
        return $this->roomRepository->getARoom($id);
    }
    public function addRoom(array $data){
       return $this->roomRepository->addRoom($data);
    }
    public function updateRoom(array $data, string $id){
        return $this->roomRepository->updateRoom($data, $id);
    }
    public function searchRoom(array $data){
        return $this->roomRepository->searchRoom($data);
    }
}
