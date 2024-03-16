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
            return response()->json(['message' => 'seatType got successfully', 'seatTypes' => $seatType], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllSeatTypesForCustomer(){
        $seatType = $this->seatTypeService->getAllSeatTypesForCustomer();
        if ($seatType){
            return response()->json(['message' => 'seatType for cus got successfully', 'seatTypes' => $seatType], 201);
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
            return response()->json(['message' => 'seatType created successfully', 'seatTypes' => $seatType], 201);
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
            return response()->json(['message' => 'seatType showed successfully', 'seatTypes' => $seatType], 201);
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
            return response()->json(['message' => 'seatType updated successfully', 'seatTypes' => $seatType], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request){
        $array = [
            'seat_type_id'=> $request->input('seat_type_id'),
            'type'=>$request->input('type'),
            'bonus_price'=>$request->input('bonus_price'),
        ];
        $seatType = $this->seatTypeService->searchSeatType($array);
        if ($seatType){
            return response()->json(['message' => 'seatType searched successfully', 'seatTypes' => $seatType], 201);
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
            return response()->json(['message' => 'seatType hid successfully', 'seatTypes' => $seatType], 201);
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
