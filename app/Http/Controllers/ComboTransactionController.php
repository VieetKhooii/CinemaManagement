<?php

namespace App\Http\Controllers;
use App\Service\ComboTransactionService;
use Illuminate\Http\Request;

class ComboTransactionController extends Controller
{
    protected $comboTransactionService;
    public function __construct(ComboTransactionService $comboTransactionService){
        $this->comboTransactionService = $comboTransactionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comboTran = $this->comboTransactionService->getAllComboTransactions();
        if ($comboTran){
            return response()->json(['last_page' => $comboTran->lastPage(),'status' => 'success', 'message' => 'combo_transaction got successfully', 'data' => $comboTran], 201);
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
            'combo_id'=> $request->input('combo_id'),
            'transaction_id'=> $request->input('transaction_id'),
            'unit_quantity'=> $request->input('unit_quantity'),
            'unit_price'=> 0,
            'display'=> true,
        ];
        $comboTran = $this->comboTransactionService->addComboTransaction($array);
        if ($comboTran){
            return response()->json(['status' => 'success', 'message' => 'combo_transaction add successfully', 'data' => $comboTran], 201);
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
    public function update(Request $request, string $id1, string $id2)
    {
        //
        $array = [
            'unit_quantity'=> $request->input('unit_quantity'),
            'unit_price'=> 0,
        ];
        $comboTran = $this->comboTransactionService->updateComboTransaction($array, $id1, $id2);
        if ($comboTran){
            return response()->json(['status' => 'success', 'message' => 'combo_transaction add successfully', 'data' => $comboTran], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id1, string $id2)
    {
        //
        $comboTran = $this->comboTransactionService->removeComboTransaction($id1, $id2);
        if ($comboTran){
            return response()->json(['status' => 'success', 'message' => 'combo_transaction delete successfully']);
        }else {
            return response()->json(['error' => 'Failed to delete combo transaction'], 500);
        }
    }
}
