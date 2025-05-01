<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    // /**
    //  * Determina si el usuario puede ver cualquier tarea.
    //  */
    // public function viewAny(User $user): bool
    // {
    //     // Permitir que el usuario vea sus propias tareas
    //     return true;
    // }

    /**
     * Determina si el usuario puede ver una tarea específica.
     */
    public function author(User $user, Task $task): bool
    {
        if($user->id === $task->user_id){
            return true;
        }else{
            return false;
        }
    }

    // /**
    //  * Determina si el usuario puede crear tareas.
    //  */
    // public function create(User $user): bool
    // {
    //     // Permitir que cualquier usuario autenticado cree tareas
    //     return true;
    // }

    // /**
    //  * Determina si el usuario puede actualizar una tarea específica.
    //  */
    // public function update(User $user, Task $task): bool
    // {
    //     return $user->id === $task->user_id;
    // }

    // /**
    //  * Determina si el usuario puede eliminar una tarea específica.
    //  */
    // public function delete(User $user, Task $task): bool
    // {
    //     return $user->id === $task->user_id;
    // }

    // /**
    //  * Determina si el usuario puede restaurar una tarea específica.
    //  */
    // public function restore(User $user, Task $task): bool
    // {
    //     return $user->id === $task->user_id;
    // }

    // /**
    //  * Determina si el usuario puede eliminar permanentemente una tarea específica.
    //  */
    // public function forceDelete(User $user, Task $task): bool
    // {
    //     return $user->id === $task->user_id;
    // }
}
