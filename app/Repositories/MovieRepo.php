<?php

namespace App\Repositories;

use App\Models\Movies;
use App\Repositories\Interface\MovieRepositoryInterface;

class MovieRepo implements MovieRepositoryInterface{
    public function getAllMovies(){
        try {
            return Movies::paginate(10);
        }
        catch (\Exception $exception){
            echo("Error MovieRepo (get): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAllMoviesForCustomer(){
        try {
            return Movies::where('display',1)->get();
        }
        catch (\Exception $exception){
            echo("Error MovieRepo (get for customer): " . $exception->getMessage());
            return null;    
        }
    }
    public function getAMovie(string $id){
        try {
            return Movies::findOrFail($id);
        }
        catch (\Exception $exception){
            echo("Error MovieRepo (get by id): " . $exception->getMessage());
            return null;    
        }
    }
    public function addMovie(array $data){
        try {
            return Movies::create($data);
        }
        catch (\Exception $exception){
            echo("Error MovieRepo (add): " . $exception->getMessage());
            return null;    
        }
    }
    public function updateMovie(array $data, string $id){
        try {
            return Movies::findOrFail($id)->update($data);
        }
        catch (\Exception $exception){
            echo("Error MovieRepo (update): " . $exception->getMessage());
            return null;    
        }
    }
    public function searchMovie(array $data){
        try {
            return Movies::search($data);
        }
        catch (\Exception $exception){
            echo("Error MovieRepo (search): " . $exception->getMessage());
            return null;    
        }
    }
}