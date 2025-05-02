<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        try {

            $tasks = Task::where('user_id', $request->user()->id)->get();
            return response()->json(['tasks' => $tasks], Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'No se pudieron obtener las tareas',
                'details' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $task = Task::create($data);

            return response()->json([
                'message' => 'Tarea creada exitosamente',
                'task' => $task
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Error al crear la tarea',
                'details' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            
            $validatedData = $request->validated();
            $task = Task::findOrFail($id);
            $this->authorize('update', $task);
            $task->update($validatedData);

            return response()->json([
                'message' => 'Tarea actualizada exitosamente',
                'task' => $task
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'error' => 'Tarea no encontrada'
            ], Response::HTTP_NOT_FOUND);

        } catch (AuthorizationException $e) {

            return response()->json([
                'error' => 'No autorizado para actualizar esta tarea'
            ], Response::HTTP_FORBIDDEN);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Error al actualizar la tarea',
                'details' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            
            $task = Task::findOrFail($id);
            $this->authorize('delete', $task);
            $task->delete();

            return response()->json([
                'message' => 'Tarea eliminada exitosamente'
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'error' => 'Tarea no encontrada'
            ], Response::HTTP_NOT_FOUND);

        } catch (AuthorizationException $e) {

            return response()->json([
                'error' => 'No autorizado para eliminar esta tarea'
            ], Response::HTTP_FORBIDDEN);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Error al eliminar la tarea',
                'details' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
