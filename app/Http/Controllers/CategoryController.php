<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->categoryService->getAllCategories();
    }

    public function getAllCategoriesForCustomer()
    {
        //
        return $this->categoryService->getAllCategoriesForCustomer();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $array = [
            'category_id'=> $request->input('category_id'),
            'category_name'=> $request->input('category_name'),
            'display'=> true,
        ];
        return $this->categoryService->addCategory($array);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return $this->categoryService->getACategory($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $array = [
            'category_name'=> $request->input('category_name'),
        ];
        return $this->categoryService->updateCategory($array, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search (Request $request){
        $array = [
            'category_id'=> $request->input('category_id'), 
            'category_name'=> $request->input('category_name'),
        ];
        return $this->categoryService->searchCategory($array);
    }

    public function hide (string $id){
        $array = [
            'display' => false,
        ];
        return $this->categoryService->updateCategory($array, $id);
    }
}
