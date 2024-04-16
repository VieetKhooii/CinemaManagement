<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ReservationService;

class ReservationController extends Controller
{
    protected $reservationService;
    public function __construct(ReservationService $reservationService){
        $this->reservationService = $reservationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reserve = $this->reservationService->getAllReservations();
        if ($reserve){
            return response()->json([
                'status' => 'success', 
                'message' => 'reservation got successfully', 
                'data' => $reserve], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()', 'status' => 'error'], 422);
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
            'price'=> 0, 
            'showtime_id'=> $request->input('showtime_id'),
            'seat_id'=> $request->input('seat_id'),
            'transaction_id'=> $request->input('transaction_id'),
            'display'=> 1,
        ];
        $reservation = $this->reservationService->addReservation($array);
        if ($reservation){
            return response()->json(['status' => 'success', 'message' => 'reservation added successfully', 'data' => $reservation], 201);
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
        $reservation = $this->reservationService->getAReservation( $id );
        if ($reservation){
            return response()->json(['status' => 'success', 'message' => 'reservation showed successfully', 'data' => $reservation], 201);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $reservation = $this->reservationService->deleteReservation( $id );
        if ($reservation){
            return response()->json(['status' => 'success', 'message' => 'reservation deleted successfully'], 201);
        }
        else {
            return response()->json(['error' => 'deleted fail'], 422);
        }
    }
}
