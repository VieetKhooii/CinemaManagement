<?php

namespace App\Repositories;

use App\Models\Branches;
use App\Repositories\Interface\BranchRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchRepo implements BranchRepositoryInterface
{
    public function getAllBranches()
    {      
        try {
            $branches = Branches::all();
            return $branches;
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (get): " . $exception->getMessage());
            return null;    
        }
    }

    public function getABranch(string $id){
        try {
            return Branches::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (get a Branch): " . $exception->getMessage());
            return null;    
        }
    }

    public function addBranch(array $branch){      
        try {
            return Branches::create($branch);
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (addBranch): " . $exception->getMessage());
            return null;    
        }
    }

    public function updateBranch(array $branch, string $id){       
        try {
            $branchModel = Branches::findOrFail($id);
            return $branchModel->update($branch);
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (updateBranch): " . $exception->getMessage());
            return null;    
        }
    }

    public function searchBranch(array $branch){
        try {
            return Branches::search($branch);
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (searchBranch): " . $exception->getMessage());
            return null;    
        }
    }
    
}
