<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BranchController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
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

// Users CRUD routes
Route::resource('users', UserController::class);

// Login routes
Route::post('login', [LoginController::class, 'login']);

// Forgot password
Route::post('password/resent', [ForgotPasswordController::class, 'forgotPassword'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetRequest'])->middleware('guest')->name('password.reset');
Route::post('password/pass-reset', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');
// Route::auth();
Auth::routes(['verify' => true]);

// Route::get('/users/add', [UserController::class, 'addUser']);
// Route::view("/", "auth.login");
// Route::get("/", function(){
//     $users = DB::select("select* from users");
//     dd($users);
// });

//Area Routes
Route::resource('areas', AreaController::class);
Route::post('areas/search', [AreaController::class, 'search']);
Route::put('areas/hide/{id}', [AreaController::class, 'hide']);
//Branch Routes
Route::resource('branches', BranchController::class);
Route::post('branches/search', [BranchController::class,'search']);
Route::put('branches/hide/{id}', [BranchController::class,'hide']);
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
