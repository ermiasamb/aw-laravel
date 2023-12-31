<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
});

// Route::prefix('api')->group(function () {
    Route::post('/register', [UserController::class, 'register']); 
    Route::post('/login', [UserController::class, 'login']);
// });
 


    // Route::post('/register', [UserController::class, 'register']);
    // Route::post('/login', [UserController::class, 'login']);

    // Route::get('/login', function () {
    //     return view('auth.login');
    // })->name('login');