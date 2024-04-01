<?php

namespace App\Repositories\Interface;

interface ComboTransactionRepositoryInterface 
{
    public function getAllComboTransactions();
    public function addComboTransaction(array $data);
    public function removeComboTransaction(string $idCombo, string $idTran);
}