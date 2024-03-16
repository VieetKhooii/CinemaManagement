<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});
// Route::middleware(['auth:api'])->group(function () {
//     // Your protected routes go here
//     Route::get('/dashboard', 'DashboardController@index');
//     // Add more routes as needed
// });

// // Public routes (no authentication required)
// Route::post('/login', 'Auth\LoginController@login');
// Route::post('/register', 'Auth\RegisterController@register');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
