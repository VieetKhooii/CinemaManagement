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
        try {
            $areas = Areas::all();
            return $areas;
        }
        catch (\Exception $exception){
            echo("Error AreaRepo (get): " . $exception->getMessage());
            return null;    
        }
    }

    public function getAnArea(string $id){
        try {
            return Areas::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error AreaRepo (getaAnArea): " . $exception->getMessage());
            return null;    
        }
    }

    public function addArea(array $area){      
        try {
            return Areas::create($area);
        }
        catch (\Exception $exception){
            echo("Error AreaRepo (addArea): " . $exception->getMessage());
            return null;    
        }
    }

    public function updateArea(array $area, string $id){       
        try {
            $areaModel = Areas::findOrFail($id);
            return $areaModel->update($area);
        }
        catch (\Exception $exception){
            echo("Error AreaRepo (updateArea): " . $exception->getMessage());
            return null;    
        }
    }

    public function searchArea(array $area){
        try {
            return Areas::search($area);
        }
        catch (\Exception $exception){
            echo("Error AreaRepo (searchArea): " . $exception->getMessage());
            return null;    
        }
    }
    
}
