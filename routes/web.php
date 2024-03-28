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
use App\Http\Controllers\UserController;
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
    Route::resource('users', UserController::class);
    
    //Seat Type Routes
    Route::get('seatTypes/customerget', [SeatTypeController::class,'getAllSeatTypesForCustomer']);
    Route::resource('seatTypes', SeatTypeController::class);
    Route::post('seatTypes/search', [SeatTypeController::class, 'search']);
    Route::put('seatTypes/hide/{id}', [SeatTypeController::class, 'hide']);
    //Seat Routes
    Route::get('seats/customerget', [SeatController::class,'getAllSeatsForCustomer']);
    Route::resource('seats', SeatController::class);
    Route::post('seats/search', [SeatController::class,'search']);
    Route::put('seats/hide/{id}', [SeatController::class,'hide']);
    //Category Routes
    Route::get('categories/customerget', [CategoryController::class,'getAllCategoriesForCustomer']);
    Route::resource('categories', CategoryController::class);
    Route::post('categories/search', [CategoryController::class,'search']);
    Route::put('categories/hide/{id}', [CategoryController::class,'hide']);
    //Combo Routes
    Route::get('combos/customerget', [ComboController::class,'getAllCombosForCustomer']);
    Route::resource('combos',ComboController::class);
    Route::post('combos/search', [ComboController::class,'search']);
    Route::put('combos/hide/{id}', [ComboController::class,'hide']);
    //Consume Routes
    Route::get('consumes/customerget', [ConsumeController::class,'getAllConsumesForCustomer']);
    Route::resource('consumes',ConsumeController::class);
    Route::post('consumes/search', [ConsumeController::class,'search']);
    Route::put('consumes/hide/{id}', [ConsumeController::class,'hide']);
    //Movie Routes
    Route::get('movies/customerget', [MovieController::class,'getAllMoviesForCustomer']);
    Route::resource('movies',MovieController::class);
    Route::post('movies/search', [MovieController::class,'search']);
    Route::put('movies/hide/{id}', [MovieController::class,'hide']);
    //Room Routes
    Route::get('rooms/customerget', [RoomController::class,'getAllRoomsForCustomer']);
    Route::resource('rooms',RoomController::class);
    Route::post('rooms/search', [RoomController::class,'search']);
    Route::put('rooms/hide/{id}', [RoomController::class,'hide']);
    //Showtime Routes
    Route::get('showtimes/customerget', [ShowtimeController::class,'getAllShowtimesForCustomer']);
    Route::resource('showtimes',ShowtimeController::class);
    Route::post('showtimes/search', [ShowtimeController::class,'search']);
    Route::put('showtimes/hide/{id}', [ShowtimeController::class,'hide']);
    //Transaction Routes
    Route::get('transactions/customerget', [TransactionController::class,'getAllTransactionsForCustomer']);
    Route::resource('transactions',TransactionController::class);
    Route::post('transactions/search', [TransactionController::class,'search']);
    Route::put('transactions/hide/{id}', [TransactionController::class,'hide']);
    //Reservation Routes
    Route::get('reservations/customerget', [ReservationController::class,'getAllReservationsForCustomer']);
    Route::resource('reservations',ReservationController::class);
    Route::post('reservations/search', [ReservationController::class,'search']);
    Route::put('reservations/hide/{id}', [ReservationController::class,'hide']);
    // Auth::routes();
    Route::resource('consume', ConsumeController::class);
});

Route::controller(LoginController::class)->group(function () {
    Route::post('login', 'login')->middleware('pass.login');
    Route::get('logout', 'logout');
    Route::post('refresh', 'refresh');
});

// Register route
Route::post('sign-up', [RegisterController::class, 'create']);

// Forgot password
Route::post('password/resent', [ForgotPasswordController::class, 'forgotPassword'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetRequest'])->middleware('guest')->name('password.reset');
Route::post('password/pass-reset', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');

Route::auth();
Auth::routes(['verify' => true]);

// View
Route::middleware(['jwt.attach'])->group(function () {
    Route::view('/users', 'home');
});
Route::view('/sign-up', 'signup');
Route::view('/login', 'signin')->middleware('pass.login');
