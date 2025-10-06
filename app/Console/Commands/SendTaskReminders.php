<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class SendTaskReminders extends Command
{
    protected $signature = 'tasks:reminders';
    protected $description = 'Send reminders for tasks whose deadline is today';

    public function handle()
    {
        $today = Carbon::today();

        $tasks = Task::whereDate('deadline', $today)->get();

        foreach ($tasks as $task) {
            $task->sendReminder();
        }

        $this->info('Task reminders sent successfully!');
    }
}
