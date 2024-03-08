<?php

namespace App\Repositories\Interface;

interface BranchRepositoryInterface {

    public function getAllBranches();
    public function getAllBranchesForCustomer();
    public function getABranch(string $id);
    public function addBranch(array $branch);
    public function updateBranch(array $branch, string $id);
    public function searchBranch(array $branch);
}