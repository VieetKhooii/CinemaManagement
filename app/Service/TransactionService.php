<?php
namespace App\Service;
use App\Repositories\Interface\TransactionRepositoryInterface;

class TransactionService {
    protected $transactionRepository;
    public function __construct(TransactionRepositoryInterface $transactionRepository){
        $this->transactionRepository = $transactionRepository;
    }

    public function getAllTransactions(){
        return $this->transactionRepository->getAllTransactions();
    }
    public function getAllTransactionsForCustomer(){
        return $this->transactionRepository->getAllTransactionsForCustomer();
    }
    public function getATransaction(string $id){
        return $this->transactionRepository->getATransaction($id);
    }
    public function addTransaction(array $data){
        return $this->transactionRepository->addTransaction( $data );
    }
    public function updateTransaction(array $data, string $id){
        return $this->transactionRepository->updateTransaction( $data, $id);
    }
    public function searchTransaction(array $data){
        return $this->transactionRepository->searchTransaction($data);
    }
}