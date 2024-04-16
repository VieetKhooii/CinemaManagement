<?php

namespace App\Repositories\Interface;

interface ReservationRepositoryInterface 
{
    public function getAllReservations();
    public function getAReservation(string $id);
    public function addReservation(array $data);
    public function deleteReservation(string $id);
}