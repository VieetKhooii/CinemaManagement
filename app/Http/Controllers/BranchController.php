<?php

namespace App\Http\Controllers;

use App\Service\BranchService;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    public function index()
    {
        //
        return $this->branchService->getAllBranches();
    }

    public function getAllBranchesForCustomer(){
        return $this->branchService->getAllBranchesForCustomer();
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
            'branch_id' => $request->input('branch_id'),
            'address' => $request->input('address'),
            'name' => $request->input('name'),
            'number_of_room' => 0,
            'area_id' => $request->input('area_id'),
            'display' => true,
        ];
        return $this->branchService->addBranch($array);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return $this->branchService->getABranch($id);
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
            'address' => $request->input('address'),
            'name' => $request->input('name'),
            'area_id' => $request->input('area_id'),
        ];
        return $this->branchService->updateBranch($array, $id);
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
            'branch_id' => $request->input('branch_id'),
            'address' => $request->input('address'),
            'name' => $request->input('name'),
            'area_id' => $request->input('area_id'),
        ];
        return $this->branchService->searchBranch($array);
    }

    public function hide(string $id){
        $area = [
            'display'=> false,
        ];
        return $this->branchService->updateBranch($area, $id);
    }
}
