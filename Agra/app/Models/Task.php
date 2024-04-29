<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $casts = [
        'DateGiven' => 'datetime',
        'Deadline' => 'datetime',
    ];

    public function lesson(){
        return $this::belongsTo(Lesson::class);
    }

    public function instructions()
    {
        return $this->hasMany(Instruction::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function score(){
        return $this->belongsToMany(Score::class, 'task_score');
    }

    public function taskStatus(){
        return $this->belongsToMany(Task::class, 'task_statuses');
    }


}
