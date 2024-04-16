<?php

namespace App\Repositories\Interface;

interface ComboTransactionRepositoryInterface 
{
    public function getAllComboTransactions();
    public function addComboTransaction(array $data);
    public function getAComboTransaction(string $idCombo, string $idTran);
    public function updateComboTransaction(array $data, string $idCombo, string $idTran);
    public function removeComboTransaction(string $idCombo, string $idTran);
}