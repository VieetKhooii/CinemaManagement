<?php

namespace App\Http\Controllers;

use App\Service\VoucherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    protected $voucherService;
    public function __construct(VoucherService $voucherService) {
        $this->voucherService = $voucherService;
    }

    public function index(){
        $vouchers = $this->voucherService->getAllVoucher();
        if ($vouchers){
            return response()->json([
                'message' => 'Get all vouchers successfully',
                'status' => 'success',
                'data' => $vouchers], 
                201);
        }
        else {
            return response()->json([
                'error' => '$validator->errors()', 
                'status' => 'error'], 
                422);
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'voucher_discount' => 'required|int',
            'voucher_condition' => 'required|date',
            'description' => 'string|between:1,100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'status' => 'error'], 
                422);
        }
        $date = $request->input('voucher_condition');
        $formatted_date = substr($date, 8, 2) . substr($date, 5, 2) . substr($date, 2, 2) . '000';
        $info = [
            'voucher_id' => $formatted_date,
            'voucher_discount' => $request->input('voucher_discount'),
            'voucher_condition' => $request->input('voucher_condition'),
            'description' => $request->input('description'),
        ];

        $result = $this->voucherService->addVoucher($info);
        if ($result){
            return response()->json([
                'message' => 'create voucher successfully',
                'status' => 'success',
                'data' => $result
            ],201);
        }
        else{
            return response()->json([
                'error' => '$validator->errors()', 
                'status' => 'error'], 
                422);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'voucher_id' => 'required|string|between:1:9',
            'voucher_discount' => 'required|int',
            'voucher_condition' => 'required|date',
            'description' => 'string|between:1,100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'status' => 'error'], 
                422);
        }

        $id = $request->input('voucher_id');
        $info = [
            'voucher_discount' => $request->input('voucher_discount'),
            'voucher_condition' => $request->input('voucher_condition'),
            'description' => $request->input('description'),
        ];

        $result = $this->voucherService->updateVoucher($info, $id);
        if ($result){
            return response()->json([
                'message' => 'create voucher successfully',
                'status' => 'success',
                'data' => $result
            ], 201);
        }
        else{
            return response()->json([
                'error' => '$validator->errors()', 
                'status' => 'error'], 
                422);
        }
    }

    public function searchByDate(Request $request){
        $date = $request->input('voucher_condition');
        $result = $this->voucherService->searchByDate($date);
        if ($result){
            return response()->json([
                'message' => 'get voucher by date successfully',
                'status' => 'success',
                'data' => $result
            ]);
        }
        else{
            return response()->json([
                'error' => 'cannot get voucher by date', 
                'status' => 'error'], 
                422);
        }
    }
}
