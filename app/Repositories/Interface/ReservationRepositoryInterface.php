<?php

namespace App\Repositories\Interface;

interface ReservationRepositoryInterface 
{
    public function getAllReservations();
    public function getAllReservationsForCustomer();
    public function getAReservation(string $id);
    public function addReservation(array $data);
    public function updateReservation(array $data, string $id);
    public function searchReservation(array $data);
}