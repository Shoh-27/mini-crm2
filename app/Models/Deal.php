<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'title', 'amount', 'status', 'deadline'];

    public function client()
    {
        return $this->belongsTo(Lead::class, 'client_id');
    }

    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}
