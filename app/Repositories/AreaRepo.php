<?php

namespace App\Repositories;

use App\Models\Areas;
use App\Repositories\Interface\AreaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaRepo implements AreaRepositoryInterface
{
    public function getAllAreas()
    {
        $areas = Areas::all();
        return $areas;
    }

    public function getAnArea(string $id){
        return Areas::findOrFail($id);
    }

    public function addArea(array $area){
        return Areas::create($area);
    }

    public function updateArea(array $area){
        return Areas::update($area);   
    }
}
