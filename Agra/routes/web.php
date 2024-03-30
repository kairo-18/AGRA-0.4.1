<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return Redirect::to('/agraCourses');
});

Route::get('/agraCourses', function () {

    $user = Auth::user();
    $userCourses = $user->courses;
    $sectionCourses = $user->section->courses;

    $courses = Course::all();
    // Get all courses except the ones the user is enrolled in
    $courses = $courses->whereNotIn('id', $userCourses->pluck('id'));
    $courses = $courses->whereNotIn('id', $sectionCourses->pluck('id'));

    $courses = $courses->whereNotIn('author', 'STI');


    return view('allCourses', [
        'courses' => $courses,
        'user' => $user,
        'tasks' => Task::all(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/courses', function () {

    $user = Auth::user();

    $userCourses = $user->courses;
    $courses = $user->section->courses;
    $courses = $courses->merge($userCourses);

    return view('courses', [
        'courses'=> $courses,
        'user' => $user,
        'tasks' => Task::all()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('courses/{course:id}', function(Course $course) {

    $lessons = $course->lessons;
    $user = Auth::user();
    $tasks = $course->tasks;

    return view('course', [
        'course' => $course,
        'lessons' => $lessons,
        'user' => $user,
        'tasks' => $tasks
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('categories/{category:slug}' , function(Category $category) {
    $courses = $category->courses;
    $user = Auth::user();

    $tasks = Task::all();

    return view('courses', [
        'courses'=> $courses,
        'user' => $user,
        'tasks' => $tasks
    ]);
});

Route::get('/enroll', [\App\Http\Controllers\EnrollmentsController::class, 'store'])->name('enroll.store');

Route::get('lessons/{course:id}/{lesson:id}' , function(Course $course, Lesson $lesson) {
    $tasks = $lesson->tasks;
    $user = Auth::user();

    return view('lessons', [
        'lesson' => $lesson,
        'tasks' => $tasks,
        'lessons' => $course->lessons,
        'course' => $course,
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks/{task:id}' , function(Task $task) {
    $instructions = $task->instructions;

    return view('task', [
        'task' => $task,
        'instructions' => $instructions
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
