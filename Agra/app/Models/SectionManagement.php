<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionManagement extends Model
{
    use HasFactory;
    protected $table = 'section_teachers';
    protected $guarded = [];

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
