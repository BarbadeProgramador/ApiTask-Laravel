<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::all();
        $tasks = Task::where('user_id', $request->user()->id)->get(); // 🔹 Solo obtiene las tareas del usuario autenticado
        return response()->json(['tasks' => $tasks], 200);

        

        // return response()->json(['task' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id; // 🔹 Asigna el ID del usuario actual

        $task = Task::create($data);

        return response()->json([
            'message' => 'Tarea creada exitosamente',
            'task' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    public function update(UpdateTaskRequest $request,  $id)
    {
        $validatedData = $request->validated(); 
        $task = Task::findOrFail($id); 
        $this->authorize('update', $task); // Autoriza la acción
        $task->update($validatedData); 



        return response()->json([
            'message' => 'Tarea actualizada exitosamente',
            'task' => $task 
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id); 

        $this->authorize('delete', $task);
        $task->delete();
        return response()->json([
            'message' => 'Tarea eliminada'
        ], 200);

    }
}
