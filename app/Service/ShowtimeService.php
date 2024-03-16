<?php
namespace App\Service;

use App\Repositories\Interface\ShowtimeRepositoryInterface ;

class ShowtimeService {
    protected $showtimeRepository;
    public function __construct(ShowtimeRepositoryInterface $showtimeRepository){
        $this->showtimeRepository = $showtimeRepository;
    }

    public function getAllShowtimes(){
        return $this->showtimeRepository->getAllShowtimes();
    }
    public function getAllShowtimesForCustomer(){
        return $this->showtimeRepository->getAllShowtimesForCustomer();
    }
    public function getAShowtime(string $id){
        return $this->showtimeRepository->getAShowtime($id);
    }
    public function addShowtime(array $data){
        return $this->showtimeRepository->addShowtime($data);
    }
    public function updateShowtime(array $data, string $id){
        return $this->showtimeRepository->updateShowtime($data, $id);
    }
    public function searchShowtime(array $data){
        return $this->showtimeRepository->searchShowtime($data);
    }
}
