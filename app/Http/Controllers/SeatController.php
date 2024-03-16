<?php

namespace App\Http\Controllers;

use App\Service\SeatService;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $seatService;

    public function __construct(SeatService $seatService)
    {
        $this->seatService = $seatService;
    }

    public function index()
    {
        //
        $seat = $this->seatService->getAllSeats();
        if ($seat){
            return response()->json(['message' => 'seats got successfully', 'seats' => $seat], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllSeatsForCustomer(){
        $seat = $this->seatService->getAllSeatsForCustomer();
        if ($seat){
            return response()->json(['message' => 'seats 4 cus got successfully', 'seats' => $seat], 201);
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
            'seat_id' => $request->input('seat_id'),
            'seat_row' => $request->input('seat_row'),
            'seat_number' => $request->input('seat_number'),
            'is_reserved' => false,
            'seat_type_id' => $request->input('seat_type_id'),
            'room_id'=> $request->input('room_id'),
            'display' => true,
        ];
        $seat = $this->seatService->addSeat($array);
        if ($seat){
            return response()->json(['message' => 'seat created successfully', 'seats' => $seat], 201);
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
        $seat = $this->seatService->getASeat($id);
        if ($seat){
            return response()->json(['message' => 'seat showed successfully', 'seats' => $seat], 201);
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
            'seat_row' => $request->input('seat_row'),
            'seat_number' => $request->input('seat_number'),
            'is_reserved' => false,
            'seat_type_id' => $request->input('seat_type_id'),
            'room_id'=> $request->input('room_id'),
        ];
        $seat = $this->seatService->updateSeat($array, $id);
        if ($seat){
            return response()->json(['message' => 'seat updated successfully', 'seats' => $seat], 201);
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

    public function search(Request $request)
    {
        $array = [
            'seat_id' => $request->input('seat_id'),
            'seat_row' => $request->input('seat_row'),
            'seat_number' => $request->input('seat_number'),
            'is_reserved' => $request->input('is_reserved'),
            'seat_type_id' => $request->input('seat_type_id'),
            'room_id'=> $request->input('room_id'),
        ];
        $seat = $this->seatService->searchSeat($array);
        if ($seat){
            return response()->json(['message' => 'seat searched successfully', 'seats' => $seat], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide(string $id){
        $array = [
            'display'=> false,
        ];
        $seat = $this->seatService->updateSeat($array, $id);
        if ($seat){
            return response()->json(['message' => 'seat hid successfully', 'seats' => $seat], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
}
