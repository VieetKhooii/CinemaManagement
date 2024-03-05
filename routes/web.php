<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Facade\Auth;
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

use App\Http\Controllers\UserController;

// Users CRUD routes
Route::resource('users', UserController::class);

// Login routes
Route::post('login', [LoginController::class, 'login']);

// Forgot password
Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.email');
Route::auth();

// Route::get('/users/add', [UserController::class, 'addUser']);
// Route::view("/", "home");
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
