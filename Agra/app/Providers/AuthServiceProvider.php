<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Section;
use App\Models\section_management;
use App\Models\SectionManagement;
use App\Models\Task;
use App\Models\User;
use App\Policies\CoursePolicy;
use App\Policies\LessonPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\Section_TeacherPolicy;
use App\Policies\SectionManagementPolicy;
use App\Policies\SectionPolicy;
use App\Policies\SectionTeacherPolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        User::class => UserPolicy::class,
        Course::class => CoursePolicy::class,
        Lesson::class => LessonPolicy::class,
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        Task::class => TaskPolicy::class,
        Section::class => SectionPolicy::class,
        SectionManagement::class, SectionManagementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
