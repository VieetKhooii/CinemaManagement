<?php 
namespace App\Service;

use App\Repositories\Interface\MovieRepositoryInterface;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\SeatRepositoryInterface;
use App\Repositories\Interface\SeatTypeRepositoryInterface;
use App\Repositories\Interface\ShowtimeRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;
use App\Repositories\SeatRepo;

class ReservationService {
    protected $reservationRepository;
    protected $showTimeRepo;
    protected $movieRepo;
    protected $seatRepo;
    protected $seatTypeRepo;
    protected $transactionRepo;
    public function __construct(
        ReservationRepositoryInterface $reservationRepository,
        ShowtimeRepositoryInterface $showtimeRepo,
        MovieRepositoryInterface $movieRepo,
        SeatRepositoryInterface $seatRepo,
        SeatTypeRepositoryInterface $seatTypeRepo,
        TransactionRepositoryInterface $transactionRepo
    ){
        $this->reservationRepository = $reservationRepository;
        $this->showTimeRepo = $showtimeRepo;
        $this->movieRepo = $movieRepo;
        $this->seatRepo = $seatRepo;
        $this->seatTypeRepo = $seatTypeRepo;
        $this->transactionRepo = $transactionRepo;
    }

    public function getAllReservations(){
        return $this->reservationRepository->getAllReservations();
    }
    public function getAReservation(string $id){
        return $this->reservationRepository->getAReservation($id);
    }
    public function addReservation(array $data){  
        $tranTotalPrice = $this->transactionRepo->getATransaction($data['transaction_id'])->total_cost;
        $movieId = $this->showTimeRepo->getAShowtime($data['showtime_id'])->movie_id;
        $moviePrice = $this->movieRepo->getAMovie($movieId)->bonus_price;
        $seatTypeId = $this->seatRepo->getASeat($data['seat_id'])[0]['seat_type_id'];
        $seatTypePrice = $this->seatTypeRepo->getASeatType($seatTypeId)->bonus_price;

        $data['price'] = $moviePrice + $seatTypePrice;
        $tranTotalPrice += $data['price'];
        $this->transactionRepo->updateTransaction(
            ['total_cost' => $tranTotalPrice] , $data['transaction_id']
        );
        return $this->reservationRepository->addReservation($data);
    }
    
    public function deleteReservation(string $id){
        $data = [           
            'transaction_id' => $this->reservationRepository->getAReservation($id)->transaction_id,
            'price' => $this->reservationRepository->getAReservation($id)->price
        ];

        $tranTotalPrice = $this->transactionRepo->getATransaction($data['transaction_id'])->total_cost;

        $tranTotalPrice -= $data['price']; 
        $this->transactionRepo->updateTransaction(
            ['total_cost' => $tranTotalPrice] , $data['transaction_id']
        );

        return $this->reservationRepository->deleteReservation($id);
    }
}