<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendTaskDueNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-task-due-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications for tasks due tomorrow';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        
        $tasks = Task::whereDate('due_date', $tomorrow)
                      ->with('user')
                      ->get();
        
        $count = 0;
        
        foreach ($tasks as $task) {
            if ($task->user) {
                $task->user->notify(new \App\Notifications\TaskDueNotification($task));
                $count++;
            }
        }
        
        $this->info("Wysłano $count powiadomień o zadaniach z terminem na jutro.");
        
        return Command::SUCCESS;
    }
}
