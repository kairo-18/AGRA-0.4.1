<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
