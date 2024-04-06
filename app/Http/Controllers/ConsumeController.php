<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ConsumeService;
class ConsumeController extends Controller
{
    protected $consumeService;
    public function __construct(ConsumeService $consumeService){
        $this->consumeService = $consumeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $consume = $this->consumeService->getAllConsumes();
        if ($consume){
            return response()->json(['status' => 'success', 'message' => 'consume got successfully', 'consume' => $consume], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllConsumesForCustomer(){
        $consume = $this->consumeService->getAllConsumesForCustomer();
        if ($consume){
            return response()->json(['status' => 'success', 'message' => 'consume 4 cus got successfully', 'consume' => $consume], 201);
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
            'name'=> $request->input('name'),
            'amount'=> $request->input('amount'),
            'price'=> $request->input('price'),
            'image'=> $request->input('image'),
            // 'display'=> true,
        ];
        $consume = $this->consumeService->addConsume($array);
        if ($consume){
            return response()->json(['status' => 'success', 'message' => 'consume added successfully', 'consume' => $consume], 201);
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
        $consume = $this->consumeService->getAConsume($id);
        if ($consume){
            return response()->json(['status' => 'success', 'message' => 'consume showed successfully', 'consume' => $consume], 201);
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
            'name'=> $request->input('name'),
            'amount'=> $request->input('amount'),
            'price'=> $request->input('price'),
            'image'=> $request->input('image'),
        ];
        $consume = $this->consumeService->updateConsume($array, $id);
        if ($consume){
            return response()->json(['status' => 'success', 'message' => 'consume udpated successfully', 'consume' => $consume], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request){//thiếu tìm kiếm trong khoảng giá
        $array = [
            'name'=> $request->input('name'),
            'amount'=> $request->input('amount'),
            //'price'=> $request->input('price'),
        ];
        $consume = $this->consumeService->searchConsume($array);
        if ($consume){
            return response()->json(['status' => 'success', 'message' => 'consume searched successfully', 'consume' => $consume], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide(string $id){
        $array = [
            'display'=> false,
        ];
        $consume = $this->consumeService->updateConsume($array, $id);
        if ($consume){
            return response()->json(['status' => 'success', 'message' => 'consume hid successfully', 'consume' => $consume], 201);
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
