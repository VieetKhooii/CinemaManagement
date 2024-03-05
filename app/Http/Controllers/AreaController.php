<?php

namespace App\Http\Controllers;

use App\Service\AreaService;
use Illuminate\Http\Request;
use App\Models\Areas;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $areaService;

    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }

    public function index()
    {
        //
        $areas = $this->areaService->getAllAreas();
        return $areas;
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
        $areaArray = [
            'name' => $request->input('name'),
            'number_of_branch' => 0,
            'display'=> true,
        ];
        return $this->areaService->addArea($areaArray);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return $this->areaService->getAnArea($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $areaArray = [
            'name'=> $request->input('name'),
        ];
        return $this->areaService->updateArea($areaArray, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request){
        $areaArray = [
            'area_id' => $request->input('area_id'),
            'name'=> $request->input('name'),
        ];
        return $this->areaService->searchArea($areaArray);
    }

    public function hide(string $id){
        $areaArray = [
            'display'=> false,
        ];
        return $this->areaService->updateArea($areaArray, $id);
    }
}
