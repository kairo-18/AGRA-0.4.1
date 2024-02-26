<?php

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
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

Route::get('/', function () {

    $courses = Course::all();

    return view('courses', [
        'courses'=> $courses
    ]);
});

Route::get('courses/{course:id}', function(Course $course) {

    $lessons = $course->lessons;

    return view('course', [
        'course' => $course,
        'lessons' => $lessons
    ]);
});

Route::get('categories/{category:slug}' , function(Category $category) {
    $courses = $category->courses;

    return view('courses', [
        'courses'=> $courses
    ]);
});


Route::get('lessons/{lesson:id}' , function(Lesson $lesson) {
    $tasks = $lesson->tasks;

    return view('lessons', [
        'lesson' => $lesson,
        'tasks' => $tasks
    ]);
});
