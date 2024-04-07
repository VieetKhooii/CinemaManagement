<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ReservationService;
use Illuminate\Support\Facades\Validator;

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
                'data' => $reserve,
                'last_page' => $reserve->lastPage()], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()', 'status' => 'error'], 422);
        }
    }

    public function getAllReservationsForCustomer(){
        $reservation = $this->reservationService->getAllReservationsForCustomer();
        if ($reservation){
            return response()->json([
                'status' => 'success', 
                'message' => 'reservation 4 cus got successfully', 
                'data' => $reservation], 201);
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
        $validator = Validator::make($request->all(), [
            'price' => 'required|int|min:0.01',
            'showtime_id' => 'required|string|between:1,10',
            'seat_id' => 'required|string|between:1,4', 
            'transaction_id' => 'required|string|between:1,10',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }   
        $array = [
            'price'=> 0, // auto-calculate here or service class!      
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
        $array = [    
            'showtime_id'=> $request->input('showtime_id'),
            'seat_id'=> $request->input('seat_id'),
            'transaction_id'=> $request->input('transaction_id'),
        ];
        $reservation = $this->reservationService->updateReservation( $array, $id );
        if ($reservation){
            return response()->json(['status' => 'success', 'message' => 'reservation updated successfully', 'data' => $reservation], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request)
    {
        //
        $array = [    
            'id'=> $request->input('id'),
            'showtime_id'=> $request->input('showtime_id'),
            'seat_id'=> $request->input('seat_id'),
            'transaction_id'=> $request->input('transaction_id'),
        ];
        $reservation = $this->reservationService->searchReservation($array);
        if ($reservation){
            return response()->json(['status' => 'success', 'message' => 'reservation searched successfully', 'data' => $reservation], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide(string $id){
        $array = [
            'display'=> 0,
        ];
        $reservation = $this->reservationService->updateReservation($array, $id);
        if ($reservation){
            return response()->json(['status' => 'success', 'message' => 'reservation hid successfully', 'data' => $reservation], 201);
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
