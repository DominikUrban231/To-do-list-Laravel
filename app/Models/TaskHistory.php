<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskHistory extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'user_id',
        'field_name',
        'old_value',
        'new_value',
        'change_type'
    ];
    
    /**
     * Get the task that owns the history record.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
    
    /**
     * Get the user that made the change.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get formatted field name for display.
     */
    public function getFormattedFieldNameAttribute(): string
    {
        $fieldMap = [
            'name' => 'Nazwa',
            'description' => 'Opis',
            'status' => 'Status',
            'priority' => 'Priorytet',
            'due_date' => 'Termin wykonania',
        ];
        
        return $fieldMap[$this->field_name] ?? $this->field_name;
    }
    
    /**
     * Get formatted change type for display.
     */
    public function getFormattedChangeTypeAttribute(): string
    {
        $typeMap = [
            'create' => 'Utworzono',
            'update' => 'Zaktualizowano',
            'delete' => 'Usunięto',
        ];
        
        return $typeMap[$this->change_type] ?? $this->change_type;
    }
}
