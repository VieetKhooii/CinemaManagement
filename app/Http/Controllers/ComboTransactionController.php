<?php

namespace App\Http\Controllers;

use App\Models\ComboTransaction;
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
        $comboId = $request->input('combo_id');
        $transactionId = $request->input('transaction_id');
        $unit_quantity = $request->input('unit_quantity');
        $unitPrice = $request->input('unit_price');

        $array = [
                    'combo_id'=>  $comboId,
                    'transaction_id'=> $transactionId,
                    'unit_quantity'=> $unit_quantity,
                    'unit_price'=> $unitPrice,
                    'display'=> true,
                ];
        // Use the firstOrNew method to either fetch an existing record or create a new instance
        $comboTransaction = ComboTransaction::firstOrNew(
            ['combo_id' => $comboId, 'transaction_id' => $transactionId]
        );

        if ($comboTransaction->exists) {
            $array['unit_quantity'] = $comboTransaction->unit_quantity + 1;
            $array['unit_price'] = $comboTransaction->unit_price + $unitPrice;
            ComboTransaction::where('combo_id', $comboId)->where('transaction_id', $transactionId)->update($array);
        } else {
            $comboTransaction->unit_quantity = 1; // Assuming new quantity starts at 1
            $comboTransaction->unit_price = $unitPrice;
            $comboTransaction->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'combo_transaction added or updated successfully',
            'data' => $comboTransaction
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comboTransact = ComboTransaction::select()->where('user_id', $id);
        if ($comboTransact){
            return $comboTransact;
        }
        else {
            return null;
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
