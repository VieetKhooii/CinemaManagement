<?php

namespace App\Repositories\Interface;

interface SeatTypeRepositoryInterface 
{
    public function getAllSeatTypes();
    public function getAllSeatTypesForCustomer();
    public function getASeatType(string $id);
    public function addSeatType(array $data);
    public function updateSeatType(array $data, string $id);
    public function searchSeatType($type, $minPrice, $maxPrice);
}