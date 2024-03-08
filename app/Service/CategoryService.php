<?php
namespace App\Service;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryService{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(){
        return $this->categoryRepository->getAllCategories();
    } 

    public function getAllCategoriesForCustomer(){
        return $this->categoryRepository->getAllCategoriesForCustomer();
    }

    public function getACategory($id){
        return $this->categoryRepository->getACategory($id);
    }

    public function addCategory(array $data){
        return $this->categoryRepository->addCategory($data);
    }

    public function updateCategory(array $data, $id){
        return $this->categoryRepository->updateCategory($data, $id);
    }

    public function searchCategory(array $data){
        return $this->categoryRepository->searchCategory($data);
    }
}

