<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskScore extends Model
{
    use HasFactory;
    protected $table = 'task_score';
    protected $fillable = [
        'user_id',
        'score_id',
        'task_id',
    ];

    public function task(){
        return $this->belongsToMany(Task::class, 'task_score', 'task_id', 'user_id');
    }

}
