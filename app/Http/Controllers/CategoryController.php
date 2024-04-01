<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CategoryService;
use Illuminate\Support\Facades\Validator;

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
        $category = $this->categoryService->getAllCategories();
        if ($category){
            return response()->json(['message' => 'category got successfully', 'data' => $category], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllCategoriesForCustomer()
    {
        //
        $category = $this->categoryService->getAllCategoriesForCustomer();
        if ($category){
            return response()->json(['message' => 'category 4 cus got successfully', 'data' => $category], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
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
        $validator = Validator::make($request->all(), [
            'category_name'=> 'required|string|between:1,50'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $array = [
            'category_name'=> $request->input('category_name'),
            'display'=> true,
        ];
        $category = $this->categoryService->addCategory($array);
        if ($category){
            return response()->json(['message' => 'category added successfully', 'data' => $category], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = $this->categoryService->getACategory($id);
        if ($category){
            return response()->json(['message' => 'category showed successfully', 'data' => $category], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
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
        $validator = Validator::make($request->all(), [
            'category_name'=> 'required|string|between:1,50'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $array = [
            'category_name'=> $request->input('category_name'),
        ];
        $category = $this->categoryService->updateCategory($array, $id);
        if ($category){
            return response()->json(['message' => 'category updated successfully', 'data' => $category], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
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
        $category = $this->categoryService->searchCategory($array);
        if ($category){
            return response()->json(['message' => 'category searched successfully', 'data' => $category], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide (string $id){
        $array = [
            'display' => false,
        ];
        $category = $this->categoryService->updateCategory($array, $id);
        if ($category){
            return response()->json(['message' => 'category hid successfully', 'data' => $category], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
}
