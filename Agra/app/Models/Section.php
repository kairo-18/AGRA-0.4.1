<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public $guarded = [];

    public function users(){
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasMany(User::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class, "enrollments");
    }

    public function teachers(){
        return $this->belongsToMany(User::class, 'section_teachers', 'section_id', 'user_id');
    }



}
