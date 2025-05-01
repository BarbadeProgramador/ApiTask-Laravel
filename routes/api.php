<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\TaskController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->middleware('auth:sanctum'); // Obtener todas las tareas
    Route::post('/', [TaskController::class, 'store'])->middleware('auth:sanctum');// Crear una nueva tarea
    Route::get('{id}', [TaskController::class, 'show'])->middleware('auth:sanctum'); // Obtener una tarea específica
    Route::put('{id}', [TaskController::class, 'update'])->middleware('auth:sanctum'); // Actualizar una tarea
    Route::delete('{id}', [TaskController::class, 'destroy'])->middleware('auth:sanctum'); // Eliminar una tarea
});