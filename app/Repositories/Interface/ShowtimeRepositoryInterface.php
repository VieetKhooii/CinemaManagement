<?php

namespace App\Repositories\Interface;

interface ShowtimeRepositoryInterface 
{
    public function getAllShowtimes();
    public function getAllShowtimesForCustomer();
    public function getAShowtime(string $id);
    public function addShowtime(array $data);
    public function updateShowtime(array $data, string $id);
    public function searchShowtime(array $data);
}