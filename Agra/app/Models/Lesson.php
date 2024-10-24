<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function categories(){
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsToMany(Category::class, 'category_lessons');
    }

    public function sections(){
        return $this->belongsToMany(Section::class);
    }
}
