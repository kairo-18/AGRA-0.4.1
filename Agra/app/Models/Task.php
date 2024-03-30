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
}
