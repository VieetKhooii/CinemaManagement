<?php
namespace App\Service;

use App\Models\Areas;
use App\Repositories\Interface\AreaRepositoryInterface;
use Illuminate\Http\Request;

class AreaService{
    protected $areaRepository;

    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAllAreas()
    {
        $areas = $this->areaRepository->getAllAreas();
        return $areas;
    }

    public function getAnArea(string $id){
        return $this->areaRepository->getAnArea($id);
    }

    public function addArea(array $area)
    {
        return $this->areaRepository->addArea($area);
    }

    public function updateArea(array $area, string $id){
        return $this->areaRepository->updateArea($area, $id);
    }

    public function searchArea(array $area)
    {
        return $this->areaRepository->searchArea($area);
    }
}
