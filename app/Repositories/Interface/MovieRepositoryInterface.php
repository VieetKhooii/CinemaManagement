<?php

namespace App\Repositories\Interface;

interface MovieRepositoryInterface {

    public function getAllMovies();
    public function getAllMoviesForCustomer();
    public function getAMovie(string $id);
    public function addMovie(array $data);
    public function updateMovie(array $data, string $id);
    public function searchMovie($name, $minPrice, $maxPrice, $category);
}