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
    Route::get('/', [TaskController::class, 'index']); // Obtener todas las tareas
    Route::post('/', [TaskController::class, 'store']); // Crear una nueva tarea
    Route::get('{id}', [TaskController::class, 'show']); // Obtener una tarea específica
    Route::put('{id}', [TaskController::class, 'update']); // Actualizar una tarea
    Route::delete('{id}', [TaskController::class, 'destroy']); // Eliminar una tarea
});