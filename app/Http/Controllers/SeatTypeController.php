<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SeatTypeService;
class SeatTypeController extends Controller
{
    protected $seatTypeService;

    public function __construct(SeatTypeService $seatTypeService){
        $this->seatTypeService = $seatTypeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $seatType = $this->seatTypeService->getAllSeatTypes();
        if ($seatType){
            return response()->json(['last_page' => $seatType->lastPage(), 'status' => 'success', 'message' => 'seatType got successfully', 'data' => $seatType], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllSeatTypesForCustomer(){
        $seatType = $this->seatTypeService->getAllSeatTypesForCustomer();
        if ($seatType){
            return response()->json(['status' => 'success', 'message' => 'seatType for cus got successfully', 'data' => $seatType], 201);
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $array = [
            'type'=>$request->input('type'),
            'bonus_price'=>$request->input('bonus_price'),
            'display'=>true,
        ];
        $seatType = $this->seatTypeService->addSeatType($array);
        if ($seatType){
            return response()->json(['status' => 'success', 'message' => 'seatType created successfully', 'data' => $seatType], 201);
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
        $seatType = $this->seatTypeService->getASeatType( $id );
        if ($seatType){
            return response()->json(['status' => 'success', 'message' => 'seatType showed successfully', 'data' => $seatType], 201);
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
            'type'=>$request->input('type'),
            'bonus_price'=>$request->input('bonus_price'),
        ];

        $seatType = $this->seatTypeService->updateSeatType($array, $id);
        if ($seatType){
            return response()->json(['status' => 'success', 'message' => 'seatType updated successfully', 'data' => $seatType], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request){
        $type = $request->input('type');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $seatType = $this->seatTypeService->searchSeatType($type, $minPrice, $maxPrice);
        if ($seatType){
            return response()->json(['status' => 'success', 'message' => 'seatType searched successfully', 'data' => $seatType], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
    
    public function hide(string $id){
        $array = [
            'display'=>false,
        ];
        $seatType = $this->seatTypeService->updateSeatType($array, $id);
        if ($seatType){
            return response()->json(['status' => 'success', 'message' => 'seatType hid successfully', 'data' => $seatType], 201);
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
}
