<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status', 'deadline', 'assigned_to', 'taskable_id', 'taskable_type'
    ];

    public function taskable()
    {
        return $this->morphTo();
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function sendReminder()
    {
        if ($this->assignedTo) {
            $this->assignedTo->notify(new \App\Notifications\TaskReminder($this));
        }
    }

}
