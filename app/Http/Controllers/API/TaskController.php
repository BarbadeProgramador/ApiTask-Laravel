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

    public function index(Request $request)
    {
        $tasks = Task::all();
        $tasks = Task::where('user_id', $request->user()->id)->get();
        return response()->json(['tasks' => $tasks], 200);

    }


    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id; 

        $task = Task::create($data);

        return response()->json([
            'message' => 'Tarea creada exitosamente',
            'task' => $task
        ], 201);
    }



    public function update(UpdateTaskRequest $request,  $id)
    {
        $validatedData = $request->validated(); 
        $task = Task::findOrFail($id); 
        $this->authorize('update', $task); 
        $task->update($validatedData); 



        return response()->json([
            'message' => 'Tarea actualizada exitosamente',
            'task' => $task 
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id); 

        $this->authorize('delete', $task);
        $task->delete();
        return response()->json([
            'message' => 'Tarea eliminada exitosamente'
        ], 200);

    }
}
