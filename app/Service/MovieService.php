<?php

namespace App\Service;
use App\Repositories\Interface\MovieRepositoryInterface;

class MovieService{
    protected $movieRepository;
    public function __construct(MovieRepositoryInterface $movieRepository){
        $this->movieRepository = $movieRepository;
    }

    public function getAllMovies(){
        return $this->movieRepository->getAllMovies();
    }
    public function getAllMoviesForCustomer(){
        return $this->movieRepository->getAllMoviesForCustomer();
    }
    public function getAMovie(string $id){
        return $this->movieRepository->getAMovie($id);
    }
    public function addMovie(array $data){
       return $this->movieRepository->addMovie($data);
    }
    public function updateMovie(array $data, string $id){
        return $this->movieRepository->updateMovie($data, $id);
    }
    public function searchMovie(array $data){
        return $this->movieRepository->searchMovie($data);
    }
}
