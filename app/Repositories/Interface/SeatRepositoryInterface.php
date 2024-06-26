<?php

namespace App\Repositories\Interface;

interface SeatRepositoryInterface {

    public function getAllSeats();
    public function getAllSeatsForCustomer();
    public function getASeat(string $id);
    public function getASeatForController(string $id, string $showtime_id);
    public function addSeat(array $data);
    public function updateSeat(array $data, string $id);
    public function searchSeat($array);
}