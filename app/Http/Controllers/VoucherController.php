<?php

namespace App\Http\Controllers;

use App\Service\VoucherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Voucher;
use App\Models\VoucherOfUser;

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
                'data' => $vouchers,
                'last_page' => $vouchers->lastPage()], 
                201);
            // return view("/voucher",['data' => $vouchers]);
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

    public function update(Request $request, string $id){
        $validator = Validator::make($request->all(), [
            // 'voucher_id' => 'required|string|between:1:9',
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

        $info = [
            'voucher_discount' => $request->input('voucher_discount'),
            'voucher_condition' => $request->input('voucher_condition'),
            'description' => $request->input('description'),
            'display'=> $request->input('display'),
        ];

        $result = $this->voucherService->updateVoucher($info, $id);
        if ($result){
            return response()->json([
                'message' => 'update voucher successfully',
                'status' => 'success',
                'data' => $result
            ], 201);
        }
        else{
            return response()->json([
                'error' => 'update voucher failed',
                'status' => 'error'], 
                422);
        }
    }

    public function searchById(string $user_id){
        // $result = $this->voucherService->searchById($id);
        $result = array();
        $voucherOfUser = VoucherOfUser::where('user_id', $user_id)->get();
        foreach ($voucherOfUser as $sr) {
            $voucher = Voucher::find($sr->voucher_id);
            $result[] = $voucher;
        }
        if ($result){
            return $result;
        }
        else{
            return response()->json([
                'error' => 'cannot get voucher by id', 
                'status' => 'error'], 
                422);
        }
    }

    public function search(Request $request){
        $array = [
            'voucher_id' => $request->input('voucher_id'),
            'voucher_discount' => $request->input('voucher_discount'),
            'voucher_condition' => $request->input('voucher_condition'),
            'description' => $request->input('description'),
        ];
        $role = $this->voucherService->searchVoucher($array);
        if ($role){
            return response()->json(['status' => 'success', 'message' => 'voucher searched successfully', 'data' => $role], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide (string $id){
        $array = [
            'display' => false,
        ];
        $voucher = $this->voucherService->updateVoucher($array, $id);
        if ($voucher){
            return response()->json(['status' => 'success', 'message' => 'voucher hid successfully', 'data' => $voucher], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
}
