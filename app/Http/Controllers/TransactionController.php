<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\TransactionService;
use App\Models\Transactions;
use App\Models\Reservation;
use App\Models\Showtimes;
use App\Models\Movies;

class TransactionController extends Controller
{
    protected $transactionService;
    public function __construct(TransactionService $transactionService){
        $this->transactionService = $transactionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transaction = $this->transactionService->getAllTransactions();
        if ($transaction){
            return response()->json(['last_page' => $transaction->lastPage(), 'status' => 'success', 'message' => 'transaction got successfully', 'data' => $transaction], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllTransactionsForCustomer(string $userId)
    {
        $transaction = Transactions::select(
            'transactions.purchase_date',
            'reservations.showtime_id',
            'reservations.seat_id',
            'showtimes.room_id',
            'movies.movie_name'
        )
        ->join('reservations', 'transactions.transaction_id', '=', 'reservations.transaction_id')
        ->join('showtimes', 'showtimes.showtime_id', '=', 'reservations.showtime_id')
        ->join('movies', 'movies.movie_id', '=', 'showtimes.movie_id')
        ->where('transactions.user_id', $userId)
        ->get();
        if ($transaction){
            return response()->json(['status' => 'success', 'message' => 'transaction for customer got successfully', 'data' => $transaction], 201);
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
    public function store(Request $request)//thiếu tự trừ tiền voucher vào total cost
    {
        //
        $array = [
            // 'transaction_id'=> $request->input('transaction_id'),
            'user_id'=> $request->input('user_id'),
            'total_cost'=> $request->input('total_cost'),
            // 'voucher_id'=> $request->input('voucher_id'),
            'payment_method'=> $request->input('payment_method'),
            'purchase_date'=> date("Y-m-d H:i:s"),
            'display'=> $request->input('display'),
        ];
        $transaction = $this->transactionService->addTransaction($array);
        if ($transaction){
            return response()->json(['status' => 'success', 'message' => 'transaction added successfully', 'data' => $transaction], 201);
        }
        else {
            return response()->json(['message' => '$validator->errors()', 'status' => 'error'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $transaction = $this->transactionService->getATransaction($id);
        if ($transaction){
            return response()->json(['status' => 'success', 'message' => 'transaction showed successfully', 'data' => $transaction], 201);
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
            'user_id'=> $request->input('user_id'),
            'voucher_id'=> $request->input('voucher_id'),
            'payment_method'=> $request->input('payment_method'),
        ];
        $transaction = $this->transactionService->updateTransaction($array, $id);
        if ($transaction){
            return response()->json(['status' => 'success', 'message' => 'transaction updated successfully', 'data' => $transaction], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request){// thiếu tìm kiếm trong khoảng ngày và giá tiền
        $array = [
            'transaction_id'=> $request->input('transaction_id'),
            // 'user_id'=> $request->input('user_id'),
            // 'total_cost'=> $request->input('total_cost'),
            // 'voucher_id'=> $request->input('voucher_id'),
            // 'payment_method'=> $request->input('payment_method'),
            // 'purchase_date'=> date("Y-m-d H:i:s"),
        ];
        $transaction = $this->transactionService->searchTransaction($array);
        if ($transaction){
            return response()->json(['status' => 'success', 'message' => 'transaction added successfully', 'data' => $transaction], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }    

    public function hide(string $id){
        $array = [       
            'display'=> 0,
        ];
        $transaction = $this->transactionService->updateTransaction($array, $id);
        if ($transaction){
            return response()->json(['status' => 'success', 'message' => 'transaction hid successfully', 'data' => $transaction], 201);
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
