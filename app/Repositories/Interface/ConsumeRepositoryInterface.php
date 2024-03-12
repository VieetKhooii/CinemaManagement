<?php

namespace App\Repositories\Interface;

interface ConsumeRepositoryInterface 
{
    public function getAllConsumes();
    public function getAllConsumesForCustomer();
    public function getAConsume(string $id);
    public function addConsume(array $data);
    public function updateConsume(array $data, string $id);
    public function searchConsume(array $data);
}