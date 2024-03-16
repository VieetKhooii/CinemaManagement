<?php

namespace App\Repositories\Interface;

interface TransactionRepositoryInterface 
{
    public function getAllTransactions();
    public function getAllTransactionsForCustomer();
    public function getATransaction(string $id);
    public function addTransaction(array $data);
    public function updateTransaction(array $data, string $id);
    public function searchTransaction(array $data);
}