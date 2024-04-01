<?php

namespace App\Repositories\Interface;

interface CategoryRepositoryInterface {
    public function getAllCategories();
    public function getAllCategoriesForCustomer();
    public function getACategory(string $id);
    public function addCategory(array $cate);
    public function updateCategory(array $cate, string $id);
    public function searchCategory(array $cate);
    public function existByName($name);
}