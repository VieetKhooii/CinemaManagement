<?php

namespace App\Http\Controllers;

use App\Models\Combos;
use App\Service\ComboService;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    protected $comboService;
    public function __construct(ComboService $comboService){
        $this->comboService = $comboService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->comboService->getAllCombos();
    }

    public function getAllCombosForCustomer(){
        return $this->comboService->getAllCombosForCustomer();
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
            'combo_id' => $request->input('combo_id'),
            'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),
            'display'=> true,
        ];
        return $this->comboService->addCombo($array);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return $this->comboService->getACombo($id);
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
            'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),
        ];

        return $this->comboService->updateCombo($array, $id);
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
            'combo_id' => $request->input('combo_id'),
            'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),      
        ];
        return $this->comboService->searchCombo($array);
    }

    public function hide(string $id)
    {
        $array = [
            'display' => 0,  
        ];
        return $this->comboService->updateCombo($array, $id);
    }
}
