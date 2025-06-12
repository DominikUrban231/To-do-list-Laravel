<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'priority',
        'status',
        'due_date',
        'access_token',
        'token_expires_at',
    ];
    
    protected $casts = [
        'due_date' => 'date',
        'token_expires_at' => 'datetime',
    ];
    
    /**
     * Get the user that owns the task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the history records for this task.
     */
    public function history(): HasMany
    {
        return $this->hasMany(TaskHistory::class)->orderBy('created_at', 'desc');
    }
    
    /**
     * Scope a query to only include tasks due soon.
     */
    public function scopeDueSoon($query)
    {
        return $query->whereDate('due_date', Carbon::tomorrow());
    }
    
    /**
     * Scope a query to only include tasks for a given user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    
    /**
     * Scope a query to filter tasks by status.
     */
    public function scopeByStatus($query, $status)
    {
        if (!empty($status)) {
            return $query->whereRaw('LOWER(status) = ?', [strtolower($status)]);
        }
        
        return $query;
    }
    
    /**
     * Scope a query to filter tasks by priority.
     */
    public function scopeByPriority($query, $priority)
    {
        if (!empty($priority)) {
            return $query->whereRaw('LOWER(priority) = ?', [strtolower($priority)]);
        }
        
        return $query;
    }
    
    /**
     * Scope a query to filter tasks by due date (before given date).
     */
    public function scopeByDueDate($query, $date)
    {
        if (!empty($date)) {
            return $query->whereDate('due_date', '=', $date);
        }
        
        return $query;
    }
    
    /**
     * Generate an access token for the task.
     */
    public function generateAccessToken($expiresInDays = 7)
    {
        $this->access_token = Str::random(64);
        $this->token_expires_at = now()->addDays($expiresInDays);
        $this->save();
        
        return $this->access_token;
    }
    
    /**
     * Check if the task's access token is valid.
     */
    public function isTokenValid()
    {
        return $this->access_token && $this->token_expires_at && now()->lt($this->token_expires_at);
    }
}
