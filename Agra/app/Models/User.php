<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Http\Middleware\Authenticate;
use App\Policies\UserPolicy;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function courses(){
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public function tasks(){
        return $this->belongsToMany(Task::class, 'task_statuses');
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['admin', 'teacher', 'dev']);
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }

    public function taskStatus(){
        return $this->belongsToMany(TaskStatus::class, 'task_statuses');
    }

    public function taskScores(){
        return $this->hasMany(Score::class);
    }

    public function taskStatuses(){
        return $this->hasMany(TaskStatus::class, 'task_statuses');
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }
}
