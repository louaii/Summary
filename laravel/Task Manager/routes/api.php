<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//legacy usage
// //route for index function
// Route::get('tasks', [TaskController::class, 'index']);
// //route for store function
// Route::post('tasks', [TaskController::class, 'store']);
// //route for update function {id} is an argument to look
// Route::put('tasks/{id}', [TaskController::class, 'update']);
// //route for show function {id} as argument
// Route::get('tasks/{id}', [TaskController::class, 'show']);
// //route to delete from table
// Route::delete('tasks/{id}', [TaskController::class, 'destroy']);

//This route here concludes the work of all function above
Route::apiResource('tasks', TaskController::class);
Route::apiResource('profiles', ProfileController::class);
Route::get('users/{id}/profiles', [UserController::class, 'getProfile']);
Route::get('users/{id}/tasks', [UserController::class, 'getUserTasks']);
Route::get('task/{id}/user', [TaskController::class, 'getTaskUser']);
//Route::apiResource('users', UserController::class);
