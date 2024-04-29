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

}
