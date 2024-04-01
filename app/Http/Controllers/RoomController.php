<?php

namespace App\Http\Controllers;
use App\Service\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;
    public function __construct(RoomService $roomService){
        $this->roomService = $roomService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $room = $this->roomService->getAllRooms();
        if ($room){
            return response()->json(['message' => 'room got successfully', 'data' => $room], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllRoomsForCustomer()
    {
        //
        $room = $this->roomService->getAllRoomsForCustomer();
        if ($room){
            return response()->json(['message' => 'room 4 cus got successfully', 'data' => $room], 201);
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
        $array= [
            'room_name'=> $request->input('room_name'),
            'status'=> true,
            'number_of_seat'=> 0,
            'display'=> true,
        ];
        $room = $this->roomService->addRoom($array);
        if ($room){
            return response()->json(['message' => 'room added successfully', 'data' => $room], 201);
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
        $room = $this->roomService->getARoom($id);
        if ($room){
            return response()->json(['message' => 'room showed successfully', 'data' => $room], 201);
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
        $array= [          
            'room_name'=> $request->input('room_name'),
            'status'=> $request->input('status'),
        ];
        $room = $this->roomService->updateRoom($array, $id);
        if ($room){
            return response()->json(['message' => 'room updated successfully', 'data' => $room], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request){
        $array = [
            'room_id'=> $request->input('room_id'),
            'room_name'=> $request->input('room_name'),
            'status'=> $request->input('status'),
        ];
        $room = $this->roomService->searchRoom($array);
        if ($room){
            return response()->json(['message' => 'room searched successfully', 'data' => $room], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide(string $id){
        $array = [
            'display'=> false,
        ];
        $room = $this->roomService->updateRoom($array, $id);
        if ($room){
            return response()->json(['message' => 'room hid successfully', 'data' => $room], 201);
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
