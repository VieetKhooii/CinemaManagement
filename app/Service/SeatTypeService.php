<?php
namespace App\Service;

use App\Repositories\Interface\SeatTypeRepositoryInterface;
use Illuminate\Http\Request;

class SeatTypeService{
    protected $seatTypeRepository;

    public function __construct(SeatTypeRepositoryInterface $seatTypeRepository)
    {
        $this->seatTypeRepository = $seatTypeRepository;
    }

    public function getAllSeatTypes()
    {
        return $this->seatTypeRepository->getAllSeatTypes();
    }

    public function getAllSeatTypesForCustomer(){
        return $this->seatTypeRepository->getAllSeatTypesForCustomer() ;
    }

    public function getASeatType(string $id){
        return $this->seatTypeRepository->getASeatType( $id );
    }
    public function addSeatType(array $data){
        return $this->seatTypeRepository->addSeatType( $data );
    }

    public function updateSeatType(array $data, string $id){
        return $this->seatTypeRepository->updateSeatType( $data, $id );
    }

    public function searchSeatType($type, $minPrice, $maxPrice)
    {
        return $this->seatTypeRepository->searchSeatType($type, $minPrice, $maxPrice);
    }
}
