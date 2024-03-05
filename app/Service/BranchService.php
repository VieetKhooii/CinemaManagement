<?php
namespace App\Service;

use App\Repositories\Interface\BranchRepositoryInterface;
use Illuminate\Http\Request;

class BranchService{
    protected $branchRepository;

    public function __construct(BranchRepositoryInterface $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function getAllBranches()
    {
        $branches = $this->branchRepository->getAllBranches();
        return $branches;
    }

    public function getABranch(string $id){
        return $this->branchRepository->getABranch($id);
    }

    public function addBranch(array $branch)
    {
        return $this->branchRepository->addBranch($branch);
    }

    public function updateBranch(array $branch, string $id){
        return $this->branchRepository->updateBranch($branch, $id);
    }

    public function searchBranch(array $branch)
    {
        return $this->branchRepository->searchBranch($branch);
    }
}
