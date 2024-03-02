<?php

namespace App\Http\Controllers;

use App\Service\AreaService;
use Illuminate\Http\Request;

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
            'Name' => $request->input('Name'),
            'Number_Of_Branch' => $request->input('Number_Of_Branch'),
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
            'Area_Id' => $id,
            'Name' => $request->input('Name'),
            'Number_Of_Branch' => $request->input('Number_Of_Branch'),
        ];
        return $this->areaService->updateArea($areaArray);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
