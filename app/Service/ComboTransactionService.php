<?php
namespace App\Service;

use App\Repositories\Interface\ComboRepositoryInterface;
use App\Repositories\Interface\ComboTransactionRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;

class ComboTransactionService {
    protected $comboTransactionRepository;
    protected $transactionRepository;
    protected $comboRepository;
    public function __construct(ComboTransactionRepositoryInterface $comboTransactionRepository,
        TransactionRepositoryInterface $transactionRepository,
        ComboRepositoryInterface $comboRepository
    ){
        $this->comboTransactionRepository = $comboTransactionRepository;
        $this->transactionRepository = $transactionRepository;
        $this->comboRepository = $comboRepository;
    }

    public function getAllComboTransactions(){
        return $this->comboTransactionRepository->getAllComboTransactions();
    }
    public function addComboTransaction(array $data){
        $tranTotalPrice = $this->transactionRepository->getATransaction($data['transaction_id'])->total_cost;
        $data['unit_price'] = $this->comboRepository->getACombo($data['combo_id'])->price * $data['unit_quantity'];
        $tranTotalPrice += $data['unit_price'];

        $this->transactionRepository->updateTransaction(
            ['total_cost'=> $tranTotalPrice], $data['transaction_id']
        );
        return $this->comboTransactionRepository->addComboTransaction($data);
    }

    public function updateComboTransaction(array $data, string $idCombo, string $idTran){
        $tranTotalPrice = $this->transactionRepository->getATransaction($idTran)->total_cost;
        $tranTotalPrice -= $this->comboTransactionRepository->getAComboTransaction($idCombo, $idTran)->unit_price;
        
        $data['unit_price'] = $this->comboRepository->getACombo($idCombo)->price * $data['unit_quantity'];
        $tranTotalPrice += $data['unit_price'];

        $this->transactionRepository->updateTransaction(
            ['total_cost'=> $tranTotalPrice], $this->comboTransactionRepository->getAComboTransaction($idCombo, $idTran)->transaction_id
        );

        return $this->comboTransactionRepository->updateComboTransaction($data, $idCombo, $idTran);
    }

    public function removeComboTransaction(string $idCombo, string $idTran){
        $tranTotalPrice = $this->transactionRepository->getATransaction($idTran)->total_cost;
        $tranTotalPrice -= $this->comboTransactionRepository->getAComboTransaction($idCombo, $idTran)->unit_price;

        $this->transactionRepository->updateTransaction(
            ['total_cost'=> $tranTotalPrice], $idTran
        );
        return $this->comboTransactionRepository->removeComboTransaction($idCombo, $idTran);
    }
}