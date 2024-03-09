<?php

namespace App\Repositories\Interface;

interface AreaRepositoryInterface 
{
    public function getAllAreas();
    public function getAllAreasForCustomer();
    public function getAnArea(string $id);
    public function addArea(array $area);
    public function updateArea(array $area, string $id);
    public function searchArea(array $area);
}