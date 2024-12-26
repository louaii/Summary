<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//route for index function
Route::get('tasks', [TaskController::class, 'index']);
//route for store function
Route::post('tasks', [TaskController::class, 'store']);
