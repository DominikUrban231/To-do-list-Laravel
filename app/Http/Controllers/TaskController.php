<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->tasks();
        
        // Filtrowanie według statusu
        if ($request->has('status')) {
            $query->byStatus($request->status);
        }
        
        // Filtrowanie według priorytetu
        if ($request->has('priority')) {
            $query->byPriority($request->priority);
        }
        
        // Filtrowanie według daty
        if ($request->has('due_date')) {
            $query->byDueDate($request->due_date);
        }
        
        $tasks = $query->orderBy('due_date', 'asc')
                     ->orderBy('priority', 'desc')
                     ->paginate(10);
        
        return view('tasks.index', [
            'tasks' => $tasks,
            'statuses' => ['to-do', 'in progress', 'done'],
            'priorities' => ['low', 'medium', 'high']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $priorities = ['low', 'medium', 'high'];
        $statuses = ['to-do', 'in progress', 'done'];
        
        return view('tasks.create', compact('priorities', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in progress,done',
            'due_date' => 'required|date|after_or_equal:today',
        ]);
        
        $task = Auth::user()->tasks()->create($validated);
        
        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        
        return view('tasks.show', compact('task'));
    }
    
    /**
     * Display the task history.
     */
    public function history(Task $task)
    {
        $this->authorize('view', $task);
        
        $history = $task->history()->paginate(15);
        
        return view('tasks.history', compact('task', 'history'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        
        return view('tasks.edit', [
            'task' => $task,
            'statuses' => ['to-do', 'in progress', 'done'],
            'priorities' => ['low', 'medium', 'high']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in progress,done',
            'due_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($task) {
                    $date = Carbon::parse($value);
                    $today = Carbon::today();
                    $currentTaskDate = Carbon::parse($task->due_date);
                    
                    // Pozwól na datę od dzisiaj w przód lub zachowanie obecnej daty zadania
                    if ($date->lt($today) && !$date->eq($currentTaskDate)) {
                        $fail('Data musi być dzisiejsza lub przyszła.');
                    }
                }
            ],
        ]);
        
        $task->update($validated);
        
        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        
        $task->delete();
        
        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully.');
    }
    
    /**
     * Generate a sharing link for the task.
     */
    public function generateShareLink(Task $task)
    {
        $this->authorize('update', $task);
        
        $token = $task->generateAccessToken();
        
        return back()->with('share_link', route('tasks.shared', $token));
    }
    
    /**
     * Display a task using a sharing token.
     */
    public function showShared($token)
    {
        $task = Task::where('access_token', $token)->firstOrFail();
        
        if (!$task->isTokenValid()) {
            abort(403, 'This sharing link has expired.');
        }
        
        return view('tasks.shared', compact('task'));
    }
}
