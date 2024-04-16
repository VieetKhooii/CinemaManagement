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
use App\Http\Controllers\ComboTransactionController;
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

use App\Models\Transactions;

// Route::middleware(['auth:api'])->group(function () {
//     // Your protected routes go here
//     Route::resource('users', UserController::class);
    
//     // Add more routes as needed
// });
Route::middleware(['jwt.attach', 'refresh.token'])->group(function () {
    // Your protected routes go here
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
    Route::view('/member', 'member');
    Route::view('/dashboard', 'app');

    Route::resource('users', UserController::class);
    Route::post('users/search', [UserController::class, 'search']);
    Route::put('users/{id}', [UserController::class,'update']);
    Route::put('users/hide/{id}', [UserController::class,'hide']);
    //Seat Type Routes
    Route::get('seatTypes/customerget', [SeatTypeController::class,'getAllSeatTypesForCustomer']);
    Route::resource('seatTypes', SeatTypeController::class);
    Route::put('seatTypes/{id}', [SeatTypeController::class,'update']);
    Route::post('seatTypes/search', [SeatTypeController::class, 'search']);
    Route::put('seatTypes/hide/{id}', [SeatTypeController::class, 'hide']);
    //Seat Routes
    Route::get('seats/customerget', [SeatController::class,'getAllSeatsForCustomer']);
    Route::resource('seats', SeatController::class);
    Route::put('seats/{id}', [SeatController::class,'update']);
    Route::post('seats/search', [SeatController::class,'search']);
    Route::put('seats/hide/{id}', [SeatController::class,'hide']);
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
    
    //Movie Routes
    Route::get('movies/customerget', [MovieController::class,'getAllMoviesForCustomer']);
    Route::resource('movies',MovieController::class);
    Route::put('movies/{id}', [MovieController::class,'update']);
    Route::post('movies/search', [MovieController::class,'search']);
    Route::put('movies/hide/{id}', [MovieController::class,'hide']);
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
    //Reservation Routes
    Route::resource('reservations',ReservationController::class);
    Route::put('reservation/{id}', [ReservationController::class,'update']);
    Route::post('reservations/search', [ReservationController::class,'search']);
    Route::put('reservations/hide/{id}', [ReservationController::class,'hide']);
    //ComboTransaction Routes
    Route::delete('comboTransactions/{id1}/{id2}', [ComboTransactionController::class,'destroy']);
    Route::put('comboTransactions/{id1}/{id2}', [ComboTransactionController::class,'update']);
    Route::resource('comboTransactions',ComboTransactionController::class);
    //ShowtimeRoom Routes
    Route::delete('showtimeRooms/{id1}/{id2}', [ShowtimeRoomController::class, 'destroy']);
    Route::resource('showtimeRooms',ShowtimeRoomController::class);
    // Voucher Routes
    Route::resource('vouchers', VoucherController::class);
    Route::put('vouchers/{id}', [VoucherController::class,'update']);
    Route::put('vouchers/hide/{id}', [VoucherController::class,'hide']);
    // Route::post('vouchers/search',[VoucherController::class, 'searchByDate']);
    Route::post('vouchers/search',[VoucherController::class, 'search']);
    // Auth::routes();
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
Route::post('password/pass-reset', [ForgotPasswordController::class, 'updatePassword']);
Route::view('/forget_pass','auth/passwords/forgetpass');
Route::view('/xacthuc','auth/passwords/xacthuc');

Route::auth();
Auth::routes(['verify' => true]);

Route::view('/sign-up', 'auth/signup');
Route::view('/login', 'auth/signin')->middleware('pass.login');