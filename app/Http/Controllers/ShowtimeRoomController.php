<?php

namespace App\Http\Controllers;

use App\Service\ShowtimeRoomService;
use Illuminate\Http\Request;

class ShowtimeRoomController extends Controller
{
    protected $showtimeRoomService;
    public function __construct(ShowtimeRoomService $showtimeRoomService){
        $this->showtimeRoomService = $showtimeRoomService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $shrm = $this->showtimeRoomService->getAllShowtimeRooms();
        if ($shrm){
            return response()->json(['status' => 'success', 'message' => 'shrm got successfully', 'data' => $shrm], 201);
        }
        else {
            return response()->json(['error' => 'combo get fail'], 422);
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
            'showtime_id' => $request->input('showtime_id'),
            'room_id' => $request->input('room_id'),
            'display' => 1
        ];
        $shrm = $this->showtimeRoomService->addShowtimeRoom($array);
        if ($shrm){
            return response()->json(['status' => 'success', 'message' => 'shrm added successfully', 'data' => $shrm], 201);
        }
        else {
            return response()->json(['error' => 'combo added fail'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id1, string $id2)
    {
        //
        $shrm = $this->showtimeRoomService->removeShowtimeRoom($id1, $id2);
        if ($shrm){
            return response()->json(['status' => 'success', 'message' => 'shrm removed successfully'], 201);
        }
        else {
            return response()->json(['error' => 'combo removed fail'], 422);
        }
    }
}
