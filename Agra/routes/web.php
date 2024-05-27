<?php

use App\Events\PusherBroadcast;
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

Route::post('/checkmarkComplete', [App\Http\Controllers\PusherController::class, 'broadcast']);

Route::get('/agra', function () {

    $user = Auth::user();
    $userCourses = $user->courses;
    $sectionCourses = $user->section->courses;

    // Retrieve task IDs that the current user has marked as "Done"
    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
        $query->where('status', 'Done');
    })->pluck('task_id')->toArray();

    // Retrieve all tasks except those that are marked as "Done" for the current user
    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();

    $courses = Course::all();
    // Get all courses except the ones the user is enrolled in
    $courses = $courses->whereNotIn('id', $userCourses->pluck('id'));
    $courses = $courses->whereNotIn('id', $sectionCourses->pluck('id'));
    $courses = $courses->whereNotIn('author', 'STI');

    return view('agra', [
        'courses' => $courses,
        'user' => $user,
        'tasks' => $tasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {

    $user = Auth::user();

    $userCourses = $user->courses;
    $courses = $user->section->courses;
    $courses = $courses->merge($userCourses);

    // Retrieve task IDs that the current user has marked as "Done"
    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
        $query->where('status', 'Done');
    })->pluck('task_id')->toArray();

    // Retrieve all tasks except those that are marked as "Done" for the current user
    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();



    return view('home', [
        'courses' => $courses,
        'user' => $user,
        'tasks' => $tasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/agraCourses', function () {

    $user = Auth::user();
    $userCourses = $user->courses;
    $sectionCourses = $user->section->courses;

    // Retrieve task IDs that the current user has marked as "Done"
    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
        $query->where('status', 'Done');
    })->pluck('task_id')->toArray();

    // Retrieve all tasks except those that are marked as "Done" for the current user
    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();

    $courses = Course::all();
    // Get all courses except the ones the user is enrolled in
    $courses = $courses->whereNotIn('id', $userCourses->pluck('id'));
    $courses = $courses->whereNotIn('id', $sectionCourses->pluck('id'));
    $courses = $courses->whereNotIn('author', 'STI');

    return view('allCourses', [
        'courses' => $courses,
        'user' => $user,
        'tasks' => $tasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/courses', function () {

    $user = Auth::user();

    $userCourses = $user->courses;
    $courses = $user->section->courses;
    $courses = $courses->merge($userCourses);

    // Retrieve task IDs that the current user has marked as "Done"
//    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
//        $query->where('status', 'Done');
//    })->pluck('task_id')->toArray();
//
//    // Retrieve all tasks except those that are marked as "Done" for the current user
//    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();

    $tasks = collect();

    if ($user->courses) {
        foreach($user->courses as $course){
            foreach ($course->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }

    }

    if ($user->section->courses) {
        foreach($user->section->courses as $course){
            foreach ($course->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }

    }

    return view('courses', [
        'courses'=> $courses,
        'user' => $user,
        'tasks' => $tasks
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

//    // Retrieve task IDs that the current user has marked as "Done"
//    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
//        $query->where('status', 'Done');
//    })->pluck('task_id')->toArray();
//
//    // Retrieve all tasks except those that are marked as "Done" for the current user
//    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();

    $tasks = collect();

    if ($user->courses) {
        foreach($user->courses as $course){
            foreach ($course->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }

    }

    if ($user->section->courses) {
        foreach($user->section->courses as $course){
            foreach ($course->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }

    }

    return view('course', [
        'course' => $course,
        'lessons' => $lessons,
        'user' => $user,
        'tasks' => $tasks
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('categories/{category:slug}' , function(Category $category) {

    $user = Auth::user();
    $userCourses = $user->courses;

    $sectionCourses = $user->section->courses;

    $courses = Course::whereHas('category', function ($query) use ($category) {
        $query->where('slug', $category->slug);
    })->get();

    $courses = $courses->whereNotIn('id', $userCourses->pluck('id'));
    $courses = $courses->whereNotIn('id', $sectionCourses->pluck('id'));
    $courses = $courses->whereNotIn('author', 'STI');

    // Retrieve task IDs that the current user has marked as "Done"
    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
        $query->where('status', 'Done');
    })->pluck('task_id')->toArray();

    // Retrieve all tasks except those that are marked as "Done" for the current user
    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();



    return view('allCourses', [
        'courses'=> $courses,
        'user' => $user,
        'tasks' => $tasks
    ]);
});

Route::get('courses/categories/{category:slug}' , function(Category $category) {

    $user = Auth::user();

    $courses = $user->courses()->whereHas('category', function ($query) use ($category) {
        $query->where('id', $category->id);
    })->get();

    $secCourses = $user->section->courses()->whereHas('category', function ($query) use ($category) {
        $query->where('id', $category->id);
    })->get();

    $courses = $courses->merge($secCourses);

    // Retrieve task IDs that the current user has marked as "Done"
    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
        $query->where('status', 'Done');
    })->pluck('task_id')->toArray();

    // Retrieve all tasks except those that are marked as "Done" for the current user
    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();

    return view('courses', [
        'courses'=> $courses,
        'user' => $user,
        'tasks' => $tasks
    ]);
});


Route::get('/enroll', [\App\Http\Controllers\EnrollmentsController::class, 'store'])->name('enroll.store');

Route::get('/score', [\App\Http\Controllers\ScoreController::class, 'store'])->name('score.store');

Route::get('/done', [\App\Http\Controllers\TaskController::class, 'update'])->name('task.done');

Route::get('lessons/{course:id}/{lesson:id}' , function(Course $course, Lesson $lesson) {
    $user = Auth::user();

//    // Retrieve task IDs that the current user has marked as "Done"
//    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
//        $query->where('status', 'Done');
//    })->pluck('task_id')->toArray();
//
//    // Retrieve all tasks except those that are marked as "Done" for the current user
//    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();

    return view('lessons', [
        'lesson' => $lesson,
        'tasks' => $lesson->tasks,
        'lessons' => $course->lessons,
        'course' => $course,
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks/{task:id}' , function(Task $task) {
    $instructions = $task->instructions;
    $user = Auth::user();
    $scores = \App\Models\Score::where('user_id', $user->id)->get();


    $tasks = collect();

    if ($user->courses) {
        foreach($user->courses as $userCourse) {
            foreach ($userCourse->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }
    }

    if ($user->section && $user->section->courses) {
        foreach($user->section->courses as $sectionCourse) {
            foreach ($sectionCourse->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }
    }

    return view('taskView', [
        'task' => $task,
        'instructions' => $instructions,
        'user' => $user,
        'tasks' => $task->lesson->tasks,
        'scores' => $scores
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks/fight/{task:id}' , function(Task $task) {
    $instructions = $task->instructions;
    $user = Auth::user();

    return view('task', [
        'task' => $task,
        'instructions' => $instructions,
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks/ship/{task:id}' , function(Task $task) {
    $instructions = $task->instructions;
    $user = Auth::user();

    return view('taskShipMode', [
        'task' => $task,
        'instructions' => $instructions,
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks/output/{task:id}', function(Task $task) {
    $testcasesString = $task->output[0]->code; // Assuming output has a property 'code' that needs to be 'testcases'
    $template = $task->output[0]->template;

    // Split by actual newline characters
    $testcasesLines = array_filter(array_map('trim', explode("\n", $testcasesString)));

    $testcasesArray = array_map(function($testcase) {
        // Split the testcase into input and output
        $parts = explode('=', $testcase);

        // Initialize inputsArray
        $inputsArray = array_map('intval', explode(',', trim($parts[0], '()')));

        // Check if there is an '=' character and handle the output part as a string
        if (count($parts) == 2) {
            // Trim and add the output part as a string
            $outputPart = trim($parts[1]);
            $inputsArray[] = $outputPart;
        }

        return $inputsArray;
    }, $testcasesLines);

    $user = Auth::user();

    return view('taskOutput', [
        'task' => $task,
        'testcases' => $testcasesArray,
        'user' => $user,
        'template' => $template,
        'methodName' => $task->output[0]->methodName,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');






Route::get('tasks/fitb/{task:id}' , function(Task $task) {
    $instructions = $task->instructions;
    $user = Auth::user();

    return view('taskFITB', [
        'task' => $task,
        'instructions' => $instructions,
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/multiplayer' , function(Task $task) {
    $user = Auth::user();

    return view('taskMultiplayer', [
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/grades', function(Task $task) {
    $user = Auth::user();
    $scores = \App\Models\Score::where('user_id', $user->id)->get();
    $tasks = $user->tasks;

    return view('taskGrades', [
        'user' => $user,
        'scores' => $scores,
        'tasks' => $tasks
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('lessons/{course:id}/{lesson:id}/grades' , function(Course $course, Lesson $lesson) {
    $user = Auth::user();

    $tasks = collect();

    if ($user->courses) {
        foreach($user->courses as $userCourse) {
            foreach ($userCourse->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }
    }

    if ($user->section && $user->section->courses) {
        foreach($user->section->courses as $sectionCourse) {
            foreach ($sectionCourse->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }
    }

    // Filter tasks to get only those that are done by the user
    $doneTasks = \App\Models\TaskStatus::all()->where('user_id', $user->id);


    return view('taskGrades', [
        'lesson' => $lesson,
        'tasks' => $tasks,
        'doneTasks' => $doneTasks,
        'lessons' => $course->lessons,
        'course' => $course,
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('courses/{course:id}/grades', function(Course $course) {
    $user = Auth::user();

    $tasks = collect();

    if ($user->courses) {
        foreach($user->courses as $userCourse) {
            foreach ($userCourse->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }
    }

    if ($user->section && $user->section->courses) {
        foreach($user->section->courses as $sectionCourse) {
            foreach ($sectionCourse->lessons as $lesson) {
                $tasks = $tasks->merge($lesson->tasks ?? collect());
            }
        }
    }

    // Filter tasks to get only those that are done by the user
    $doneTasks = \App\Models\TaskStatus::all()->where('user_id', $user->id);



    return view('taskGrades', [
        'tasks' => $tasks,
        'doneTasks' => $doneTasks,
        'lessons' => $course->lessons,
        'course' => $course,
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');



Route::post('/execute-code', [\App\Http\Controllers\RunCode::class, 'executeCode']);


require __DIR__.'/auth.php';
