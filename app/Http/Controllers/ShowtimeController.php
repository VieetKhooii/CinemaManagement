<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ShowtimeService;
use Illuminate\Support\Facades\Validator;

class ShowtimeController extends Controller
{
    protected $showtimeService;
    public function __construct(ShowtimeService $showtimeService){
        $this->showtimeService = $showtimeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $showTime = $this->showtimeService->getAllShowtimes();
        if ($showTime){
            return response()->json(['last_page' => $showTime->lastPage(), 'status' => 'success', 'message' => 'showtime got successfully', 'data' => $showTime], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllShowtimesForCustomer(){
        $showTime = $this->showtimeService->getAllShowtimesForCustomer();
        if ($showTime){
            return response()->json(['status' => 'success', 'message' => 'showtime for customer got successfully', 'data' => $showTime], 201);
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
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|string|between:1,6',
            'date' => 'required|date',
            // 'start_time' => 'required|date_format:H:i:s', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'status' => 'error'], 
                422);
        }
        $array = [
            // 'showtime_id'=> $request->input('showtime_id'),
            'movie_id'=> $request->input('movie_id'),
            'date'=> $request->input('date'),
            'start_time'=> $request->input('start_time'),
            'display'=> 1,
        ];
        $showTime = $this->showtimeService->addShowtime($array);
        if ($showTime){
            return response()->json(['status' => 'success', 'message' => 'showtime added successfully', 'data' => $showTime], 201);
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
        $showTime = $this->showtimeService->getAShowtime( $id );
        if ($showTime){
            return response()->json(['status' => 'success', 'message' => 'showtime showed successfully', 'data' => $showTime], 201);
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
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|string|between:1,6',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'status' => 'error'], 
                422);
        }
        $array = [
            'movie_id'=> $request->input('movie_id'),
            'date'=> $request->input('date'),
            'start_time'=> $request->input('start_time'),
        ];
        $showTime = $this->showtimeService->updateShowtime( $array, $id );
        if ($showTime){
            return response()->json(['status' => 'success', 'message' => 'showtime updated successfully', 'data' => $showTime], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request)
    {
        //
        $array = [
            'showtime_id'=> $request->input('showtime_id'),
            'movie_id'=> $request->input('movie_id'),
            'date'=> $request->input('date'),
            'start_time'=> $request->input('start_time'),
        ];
        $showTime = $this->showtimeService->searchShowtime($array);
        if ($showTime){
            return response()->json(['status' => 'success', 'message' => 'showtime searched successfully', 'data' => $showTime], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide( string $id){
        $array = [
            'display' => false,
        ];
        $showTime = $this->showtimeService->updateShowtime( $array, $id );
        if ($showTime){
            return response()->json(['status' => 'success', 'message' => 'showtime hid successfully', 'data' => $showTime], 201);
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
