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
        return $this->consumeService->getAllConsumes();
    }

    public function getAllConsumesForCustomer(){
        return $this->consumeService->getAllConsumesForCustomer();
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
        return $this->consumeService->addConsume($array);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return $this->consumeService->getAConsume($id);
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
        return $this->consumeService->updateConsume($array, $id);
    }

    public function search(Request $request){
        $array = [
            'name'=> $request->input('name'),
            'amount'=> $request->input('amount'),
            'price'=> $request->input('price'),
        ];
        return $this->consumeService->searchConsume($array);
    }

    public function hide(string $id){
        $array = [
            'display'=> false,
        ];
        return $this->consumeService->updateConsume($array, $id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
