<?php

namespace App\Repositories\Interface;

interface RoomRepositoryInterface 
{
    public function getAllRooms();
    public function getAllRoomsForCustomer();
    public function getARoom(string $id);
    public function addRoom(array $data);
    public function updateRoom(array $data, string $id);
    public function searchRoom($name, $minSeat, $maxSeat);
}