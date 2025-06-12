<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Support\Facades\Auth;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        $this->recordHistory($task, 'create', null, $task->getAttributes());
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        $changes = $task->getChanges();
        $original = $task->getOriginal();
        
        // Nie zapisujemy zmian dla pól access_token i token_expires_at
        unset($changes['access_token'], $changes['token_expires_at'], $changes['updated_at']);
        
        foreach ($changes as $field => $newValue) {
            if (isset($original[$field])) {
                $this->recordHistory(
                    $task,
                    'update',
                    $field,
                    $original[$field],
                    $newValue
                );
            }
        }
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        $this->recordHistory($task, 'delete');
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        $this->recordHistory($task, 'restore');
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        // Nie zapisujemy historii dla trwale usuniętych zadań
    }
    
    /**
     * Record task history.
     */
    private function recordHistory(Task $task, string $changeType, ?string $fieldName = null, $oldValue = null, $newValue = null): void
    {
        // Jeśli zmieniamy konkretne pole, to tworzymy wpis dla tego pola
        if ($fieldName) {
            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'field_name' => $fieldName,
                'old_value' => is_array($oldValue) ? json_encode($oldValue) : $oldValue,
                'new_value' => is_array($newValue) ? json_encode($newValue) : $newValue,
                'change_type' => $changeType
            ]);
        } 
        // W przypadku utworzenia lub usunięcia zadania, tworzymy ogólny wpis
        else {
            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'field_name' => 'task',
                'change_type' => $changeType
            ]);
        }
    }
}
