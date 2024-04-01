<?php
namespace App\Service;

use App\Repositories\Interface\ComboRepositoryInterface;
use App\Repositories\Interface\ComboTransactionRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;

class ComboTransactionService {
    protected $comboTransactionRepository;
    protected $transactionRepository;
    protected $comboRepository;
    public function __construct(ComboTransactionRepositoryInterface $comboTransactionRepository
    ){
        $this->comboTransactionRepository = $comboTransactionRepository;
        //$this->transactionRepository = $transactionRepository;
        //$this->comboRepository = $comboRepository;
    }

    public function getAllComboTransactions(){
        return $this->comboTransactionRepository->getAllComboTransactions();
    }
    public function addComboTransaction(array $data){
        // $totalPrice = $this->transactionRepository->getATransaction($data['transaction_id'])->total_cost;
        // $totalPrice += $this->comboRepository->getACombo($data['combo_id'])->total_cost * $data['price_on_amount'];
        // $this->transactionRepository->updateTransaction(
        //     ['total_cost'=> $totalPrice], $data['transaction_id']
        // );
        return $this->comboTransactionRepository->addComboTransaction($data);
    }
    public function removeComboTransaction(string $idCombo, string $idTran){
        // $totalPrice = $this->transactionRepository->getATransaction($idTran)->total_cost;
        // $totalPrice -= $this->comboRepository->getACombo($idCombo)->total_cost;
        // $this->transactionRepository->updateTransaction(
        //     ['total_cost'=> $totalPrice], $idTran
        // );
        return $this->comboTransactionRepository->removeComboTransaction($idCombo, $idTran);
    }
}