<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category(){
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function sections(){
        return $this->belongsToMany(Section::class, 'enrollments')->withTimestamps();
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }


}
