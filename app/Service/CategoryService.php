<?php
namespace App\Service;

use App\Models\Categories;
use App\Repositories\Interface\CategoryRepositoryInterface;

use function PHPUnit\Framework\throwException;

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
        if($this->categoryRepository->existByName($data['category_name'])){
            throw new \Exception("Tên đã tồn tại trong cơ sở dữ liệu.");
        }
        return $this->categoryRepository->addCategory($data);
    }

    public function updateCategory(array $data, $id){
        if(array_key_exists('category_name', $data)){
            if($this->categoryRepository->existByName($data['category_name'])){
                throw new \Exception("Tên đã tồn tại trong cơ sở dữ liệu.");
            }
        }      
        return $this->categoryRepository->updateCategory($data, $id);
    }

    public function searchCategory(array $data){
        return $this->categoryRepository->searchCategory($data);
    }
}

