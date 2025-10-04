<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','phone','company','status'];
    const STATUSES = ['New','Qualified','Opportunity','Client'];

    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}
