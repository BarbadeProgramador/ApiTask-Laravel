<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\TaskController;


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']); // Obtener todas las tareas
    Route::post('/', [TaskController::class, 'store']); // Crear una nueva tarea
    Route::put('/{id}', [TaskController::class, 'update']); // Actualizar una tarea
    Route::delete('/{id}', [TaskController::class, 'destroy']); // Eliminar una tarea
});
