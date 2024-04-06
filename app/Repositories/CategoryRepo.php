<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryRepo implements CategoryRepositoryInterface{
    public function getAllCategories(){       
        try {
            return Categories::paginate(5);   
        }
        catch (\Exception $exception){
            echo("Error CategoryRepo (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAllCategoriesForCustomer() {
        try {
            return Categories::where('display', 1)->get();
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (get for customer): " . $exception->getMessage());
            return null;    
        }
    }

    public function getACategory(string $id){
        try {
            return Categories::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error CategoryRepo (get by id): " . $exception->getMessage());
            return null;    
        }
    }
    public function addCategory(array $cate){
        try {
            return Categories::create($cate);
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (add): " . $exception->getMessage());
            return null;    
        }
    }
    public function updateCategory(array $cate, string $id){
        try {
            return Categories::findOrFail($id)->update($cate);
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (update): " . $exception->getMessage());
            return null;    
        }
    }
    public function searchCategory(array $cate){
        try {
            return Categories::search($cate);
        }
        catch (\Exception $exception){
            echo("Error BranchRepo (search): " . $exception->getMessage());
            return null;    
        }
    }

    public function existByName($name){
        $count = Categories::where('category_name', $name)->count();

        // Trả về true nếu tên đã tồn tại, ngược lại trả về false
        return $count > 0; 
    }

}