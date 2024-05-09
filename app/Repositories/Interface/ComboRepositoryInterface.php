<?php

namespace App\Repositories\Interface;

interface ComboRepositoryInterface 
{
    public function getAllCombos();
    public function getAllCombosForCustomer();
    public function getACombo(string $id);
    public function addCombo(array $combo);
    public function updateCombo(array $combo, string $id);
    public function searchCombo(array $datae);
}