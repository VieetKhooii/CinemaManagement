<?php

namespace App\Repositories\Interface;

interface ShowtimeRoomRepositoryInterface
{
    public function getAllShowtimeRooms();
    public function addShowtimeRoom(array $data);
    public function getAShowtimeRoom(string $showtimeId, string $roomId);
    public function removeShowtimeRoom(string $showtimeId, string $roomId);
    public function checkTimeRoomExists($date, $time, $room);
}