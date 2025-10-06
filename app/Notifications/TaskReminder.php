<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskReminder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // email va database notification
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Reminder: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name)
            ->line('This is a reminder for your task: ' . $this->task->title)
            ->line('Deadline: ' . ($this->task->deadline ? $this->task->deadline->format('d M, Y') : '—'))
            ->action('View Task', url(route('tasks.edit', $this->task->id)))
            ->line('Please make sure to complete it on time.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'deadline' => $this->task->deadline,
        ];
    }
}
