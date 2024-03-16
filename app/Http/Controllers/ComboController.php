<?php

namespace App\Http\Controllers;

use App\Models\Combos;
use App\Service\ComboService;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    protected $comboService;
    public function __construct(ComboService $comboService){
        $this->comboService = $comboService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $combo = $this->comboService->getAllCombos();
        if ($combo){
            return response()->json(['message' => 'combo got successfully', 'combo' => $combo], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllCombosForCustomer(){
        $combo = $this->comboService->getAllCombosForCustomer();
        if ($combo){
            return response()->json(['message' => 'combo 4 cus got successfully', 'combo' => $combo], 201);
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
        $array = [
            'combo_id' => $request->input('combo_id'),
            'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),
            'image' => $request->input('image'),
            'display'=> true,
        ];
        $combo = $this->comboService->addCombo($array);
        if ($combo){
            return response()->json(['message' => 'combo added successfully', 'combo' => $combo], 201);
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
        $combo = $this->comboService->getACombo($id);
        if ($combo){
            return response()->json(['message' => 'combo showed successfully', 'combo' => $combo], 201);
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
        $array = [
            'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),
            'image'=> $request->input('image'),
        ];

        $combo = $this->comboService->updateCombo($array, $id);
        if ($combo){
            return response()->json(['message' => 'combo updated successfully', 'combo' => $combo], 201);
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

    public function search(Request $request) //thiếu tìm kiếm trong khoảng giá
    {
        $array = [
            'combo_id' => $request->input('combo_id'),
            //'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),      
        ];
        $combo = $this->comboService->searchCombo($array);
        if ($combo){
            return response()->json(['message' => 'combo searched successfully', 'combo' => $combo], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide(string $id)
    {
        $array = [
            'display' => 0,  
        ];
        $combo = $this->comboService->updateCombo($array, $id);
        if ($combo){
            return response()->json(['message' => 'combo hid successfully', 'combo' => $combo], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
}
