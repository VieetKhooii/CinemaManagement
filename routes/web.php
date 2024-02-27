<?php

use App\Http\Controllers\AreaController;
use Illuminate\Support\Facades\Route;

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
use Illuminate\Support\Facades\DB;

// Users CRUD routes
Route::resource('users', UserController::class);


// Route::get('/users/add', [UserController::class, 'addUser']);
// Route::view("/", "home");
// Route::get("/", function(){
//     $users = DB::select("select* from users");
//     dd($users);
// });

//Area Routes
Route::resource('areas', AreaController::class);