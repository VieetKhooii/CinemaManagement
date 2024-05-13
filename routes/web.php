<?php

use App\Http\Controllers\SeatTypeController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\ConsumeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ComboTransactionController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\Film_booking_controller;
use App\Http\Controllers\ShowtimeRoomController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Middleware\AttachJwtToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Middleware\TrustHosts;
use App\Models\Detail_model;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::middleware(['auth:api'])->group(function () {
//     // Your protected routes go here
//     Route::resource('users', UserController::class);
    
//     // Add more routes as needed
// });
Route::view ('/home','layouts/home')->middleware('pass.login');
Route::post('/list_item_get', function(){
    return view('layouts/list_item');
});
//Movie Routes
    Route::get('movies/customer', [MovieController::class,'getAllMoviesForCustomer']);
    Route::resource('movies',MovieController::class);
    Route::put('movies/{id}', [MovieController::class,'update']);
    Route::post('movies/search', [MovieController::class,'search']);
    Route::put('movies/hide/{id}', [MovieController::class,'hide']);

Route::middleware(['jwt.attach', 'refresh.token'])->group(function () {
    
    //---------------------------ADMIN Quản lý----------------------------------
    Route::view('/admin', 'admin/admin');
    Route::get('admin/add', function(Request $request){
        $name = $request->query('name');
        return view('admin/admin_add', ['name' => $name]);
    });
    Route::get('admin/edit', function(Request $request){
        $name = $request->query('name');
        $id = $request->query('id');
        $idtable = $request->query('idtable');
        if ($name)
        return view('admin/admin_add', ['name' => $name, 'id' => $id, 'idtable' => $idtable]);
        else return view('admin/admin_add');
    });
    Route::post('admin/query', function(){
        return view('admin/admin_query');
    });
    // -------------------------------Quản lý-------------------------------------

    // ---------------------------ADMIN Thống kê----------------------------------
    Route::view('/admin_static', 'admin/admin_static');
    Route::view('/filmSeat', 'statistic/filmSeat');
    Route::get('/maxFilmSeat', function(Request $request){
        $date = $request->query('date');
        return view('statistic/maxFilmSeat', ['date' => $date]);
    });
    Route::get('/maxFilm', function(Request $request){
        $date = $request->query('date');
        return view('statistic/maxFilm', ['date' => $date]);
    });
    Route::get('/minFilmSeat', function(Request $request){
        $date = $request->query('date');
        return view('statistic/minFilmSeat', ['date' => $date]);
    });
    Route::get('/minFilm', function(Request $request){
        $date = $request->query('date');
        return view('statistic/minFilm', ['date' => $date]);
    });
    Route::get('/totalFilmSeat', function(Request $request){
        $date = $request->query('date');
        return view('statistic/totalFilmSeat', ['date' => $date]);
    });
    Route::get('/totalFilm', function(Request $request){
        $date = $request->query('date');
        return view('statistic/totalFilm', ['date' => $date]);
    });
    Route::get('/revenue', function(Request $request){
        $date = $request->query('date');
        return view('statistic/revenue', ['date' => $date]);
    });
    Route::get('/film', function(Request $request){
        $date = $request->query('date');
        return view('statistic/film', ['date' => $date]);
    });
    Route::get('/combo', function(Request $request){
        $date = $request->query('date');
        return view('statistic/combo', ['date' => $date]);
    });
    Route::get('/maxCombo', function(Request $request){
        $date = $request->query('date');
        return view('statistic/maxCombo', ['date' => $date]);
    });
    Route::get('/minCombo', function(Request $request){
        $date = $request->query('date');
        return view('statistic/minCombo', ['date' => $date]);
    });
    Route::get('/totalCombo', function(Request $request){
        $date = $request->query('date');
        return view('statistic/totalCombo', ['date' => $date]);
    });
    // ---------------------------Thống kê------------------------------------//

    //----------------------------User view----------------------------
    Route::view('/member', 'layouts/member');
    Route::view('/dashboard', 'layouts/dashboard');
    Route::view('/vouchers', 'layouts/voucher');
    Route::view('/myself', 'layouts/myself');
    Route::post('vouchers_get', function(){
        return view('layouts/voucher');
    });
    Route::get('/payment', function (Request $request) {
        $necessaryData = $request->query('data');
        return view('layouts/booking/payment', ['necessaryData' => $necessaryData]);
    });
    Route::post('/momo', function(Request $request){
        $amount = $request->query('amount');
        return view('layouts/booking/momo', ['amount' => $amount]);
    });
    //----------------------------User view----------------------------
    
    //Backend
    //Category Routes
    Route::get('categories/customerget', [CategoryController::class,'getAllCategoriesForCustomer']);
    Route::resource('categories', CategoryController::class);
    Route::put('categories/{id}', [CategoryController::class,'update']);
    Route::post('categories/search', [CategoryController::class,'search']);
    Route::put('categories/hide/{id}', [CategoryController::class,'hide']);

    //Combo Routes
    Route::get('combos/customerget', [ComboController::class,'getAllCombosForCustomer']);
    Route::resource('combos',ComboController::class);
    Route::put('conbos/{id}', [ComboController::class,'update']);
    Route::post('combos/search', [ComboController::class,'search']);
    Route::put('combos/hide/{id}', [ComboController::class,'hide']);

    Route::get('comments/{user_id}', function($user_id){
        $comment_list = Detail_model::get_comment_by_user($user_id);
        if ($comment_list){
            return response()->json([
                'message' => 'List comments by user_id gotten successfully',
                'status' => 'success',
                'data' => $comment_list
            ], 201);
        }
        else {
            return response()->json([
                'error' => 'getting comment list by user_id failed',
                'status' => 'error'], 
                500);
        }
    });

    //ComboTransaction Routes
    Route::delete('comboTransactions/{id1}/{id2}', [ComboTransactionController::class,'destroy']);
    Route::put('comboTransactions/{id1}/{id2}', [ComboTransactionController::class,'update']);
    Route::resource('comboTransactions',ComboTransactionController::class);

    //Reservation Routes
    Route::resource('reservations',ReservationController::class);
    Route::put('reservation/{id}', [ReservationController::class,'update']);
    Route::post('reservations/search', [ReservationController::class,'search']);
    Route::put('reservations/hide/{id}', [ReservationController::class,'hide']);

    //Role Routes
    Route::resource('roles',RoleController::class);
    Route::put('roles/{id}', [RoleController::class,'update']);
    Route::put('roles/hide/{id}', [RoleController::class,'hide']);
    Route::post('roles/search', [RoleController::class,'search']);

    //Room Routes
    Route::get('rooms/customerget', [RoomController::class,'getAllRoomsForCustomer']);
    Route::resource('rooms',RoomController::class);
    Route::put('rooms/{id}', [RoomController::class,'update']);
    Route::post('rooms/search', [RoomController::class,'search']);
    Route::put('rooms/hide/{id}', [RoomController::class,'hide']);

    //Seat Routes
    Route::get('seats/customerget', [SeatController::class,'getAllSeatsForCustomer']);
    Route::resource('seats', SeatController::class);
    Route::get('seats/{id}/{showtime_id}', [SeatController::class,'getForBooking']);
    Route::put('seats/{id}', [SeatController::class,'update']);
    Route::post('seats/search', [SeatController::class,'search']);
    Route::put('seats/hide/{id}', [SeatController::class,'hide']);

    //Seat Type Routes
    Route::get('seatTypes/customerget', [SeatTypeController::class,'getAllSeatTypesForCustomer']);
    Route::resource('seatTypes', SeatTypeController::class);
    Route::put('seatTypes/{id}', [SeatTypeController::class,'update']);
    Route::post('seatTypes/search', [SeatTypeController::class, 'search']);
    Route::put('seatTypes/hide/{id}', [SeatTypeController::class, 'hide']);

    //ShowtimeRoom Routes
    Route::delete('showtimeRooms/{id1}/{id2}', [ShowtimeRoomController::class, 'destroy']);
    Route::resource('showtimeRooms',ShowtimeRoomController::class);

    //Showtime Routes
    Route::get('showtimes/customerget', [ShowtimeController::class,'getAllShowtimesForCustomer']);
    Route::resource('showtimes',ShowtimeController::class);
    Route::put('showtimes/{id}', [ShowtimeController::class,'update']);
    Route::post('showtimes/search', [ShowtimeController::class,'search']);
    Route::put('showtimes/hide/{id}', [ShowtimeController::class,'hide']);

    //Transaction Routes
    Route::get('transactions/customerget', [TransactionController::class,'getAllTransactionsForCustomer']);
    Route::resource('transactions',TransactionController::class);
    Route::put('transactions/{id}', [TransactionController::class,'update']);
    Route::post('transactions/search', [TransactionController::class,'search']);
    Route::put('transactions/hide/{id}', [TransactionController::class,'hide']);

    //User Type Routes
    Route::resource('users', UserController::class);
    Route::post('users/search', [UserController::class, 'search']);
    Route::put('users/{id}', [UserController::class,'update']);
    Route::put('users/hide/{id}', [UserController::class,'hide']);
    Route::put('users/hideFromClient/{id}', [UserController::class,'hideFromClient']);

    // Voucher Routes
    Route::resource('vouchers', VoucherController::class);
    Route::put('vouchers/{id}', [VoucherController::class,'update']);
    Route::put('vouchers/hide/{id}', [VoucherController::class,'hide']);
    // Route::post('vouchers/search',[VoucherController::class, 'searchByDate']);
    Route::post('vouchers/search',[VoucherController::class, 'search']);
    // Auth::routes();

    Route::view('dashboard/film_booking', 'layouts/film_booking');
    Route::post('dashboard/film_booking_controller',[Film_booking_controller::class, 'filmBooking']);
    Route::get('dashboard/film_booking_controller',[Film_booking_controller::class, 'filmBooking']);
    // Route::view('/seat-wrap', 'layouts/booking/seatwrap');
    Route::post('/seat-wrap', function(){
        return view('layouts/booking/seatwrap');
    });
    // Route::get('/seat-wrap', function(Request $request) {
    //     $combos = $request->input('combos');
    //     $necessaryData = $request->input('necessaryData');
    //     $seatArray = $request->input('seatArray');
    //     return view("layouts/booking/seatwrap", [
    //         'combos' => $combos,
    //         'necessaryData' => $necessaryData,
    //         'seatArray' => $seatArray
    //     ]);
    // });
});




Route::controller(LoginController::class)->group(function () {
    Route::post('login', 'login')->middleware('pass.login');
    Route::get('logout', 'logout');
    Route::post('refresh', 'refresh');
});

// Register route
Route::post('sign-up', [RegisterController::class, 'create']);

// Forgot password
Route::post('password/resent', [ForgotPasswordController::class, 'forgotPassword']);
// Route::post('password/reset/{token}', [ForgotPasswordController::class, 'resetRequest']);
Route::post('password/update', [ResetPasswordController::class, 'resetPass']);
Route::post('password/pass-reset', [ForgotPasswordController::class, 'updatePassword']);
Route::view('/forget_pass','auth/passwords/forgetpass');
Route::view('/xacthuc','auth/passwords/xacthuc');

Route::auth();
Auth::routes(['verify' => true]);

Route::view('/sign-up', 'auth/signup');
Route::view('/login', 'auth/signin')->middleware('pass.login');



// Route::view('/detail_film', 'layouts/detail_film');
Route::get('detail_film/get', [DetailController::class, 'get']);
Route::post('detail_film/post', [DetailController::class, 'post']);

Route::view('/dashboard/detail_ticket', 'layouts/booking/detail_ticket');