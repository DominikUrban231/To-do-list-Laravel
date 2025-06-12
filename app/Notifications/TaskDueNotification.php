<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDueNotification extends Notification implements ShouldQueue
{
    use Queueable;
    
    protected $task;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Task Due Tomorrow: ' . $this->task->name)
                    ->greeting('Hello ' . $notifiable->name . '!')
                    ->line('Reminder: You have a task due tomorrow.')
                    ->line('Task name: **' . $this->task->name . '**')
                    ->line('Priority: ' . ucfirst($this->task->priority))
                    ->line('Due date: ' . $this->task->due_date->format('Y-m-d'))
                    ->action('View Task', url('/tasks/' . $this->task->id))
                    ->line('Thank you for using our Task Manager application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'task_name' => $this->task->name,
            'due_date' => $this->task->due_date->format('Y-m-d'),
            'priority' => $this->task->priority,
        ];
    }
}
