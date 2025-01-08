<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//login token
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//route group middleware
Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('tasks', TaskController::class);
Route::apiResource('profiles', ProfileController::class);
Route::get('users/{id}/profiles', [UserController::class, 'getProfile']);
Route::get('users/{id}/tasks', [UserController::class, 'getUserTasks']);
Route::get('task/{id}/user', [TaskController::class, 'getTaskUser']);
Route::post('tasks/{task_id}/categories', [TaskController::class, 'addCategoriesToTask']);
Route::get('tasks/{task_id}/categories', [TaskController::class, 'getTaskCategories']);
Route::get('categories/{category_id}/tasks', [TaskController::class, 'getCategoryTasks']);
});

//user routes
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

//admin routes
Route::get('task/all', [TaskController::class, 'getAllTasks'])->middleware('CheckUser');

//priority order
Route::get('task/order', [TaskController::class, 'getTaskByPriority']);
