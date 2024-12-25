<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('welcome', [WelcomeController::class, 'welcome']); //127.0.0.1:8000/api/welcome
//Route::get('user', [UserController::class, 'index']); //127.0.0.1:8000/api/user
Route::get('user/{id}', [UserController::class, 'CheckUser']); //127.0.0.1:8000/api/user
