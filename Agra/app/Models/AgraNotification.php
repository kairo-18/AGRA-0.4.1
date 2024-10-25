<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgraNotification extends Model
{
    use HasFactory;
    protected $table = "agra_notification";

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function score()
    {
        return $this->belongsTo(Score::class);
    }
}
