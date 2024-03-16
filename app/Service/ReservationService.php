<?php 
namespace App\Service;
use App\Repositories\Interface\ReservationRepositoryInterface;

class ReservationService {
    protected $reservationRepository;
    public function __construct(ReservationRepositoryInterface $reservationRepository){
        $this->reservationRepository = $reservationRepository;
    }

    public function getAllReservations(){
        return $this->reservationRepository->getAllReservations();
    }
    public function getAllReservationsForCustomer(){
        return $this->reservationRepository->getAllReservationsForCustomer();
    }
    public function getAReservation(string $id){
        return $this->reservationRepository->getAReservation($id);
    }
    public function addReservation(array $data){
        return $this->reservationRepository->addReservation($data);
    }
    public function updateReservation(array $data, string $id){
        return $this->reservationRepository->updateReservation($data, $id);
    }
    public function searchReservation(array $data){
        return $this->reservationRepository->searchReservation($data);
    }
}