<?php

use App\Events\PusherBroadcast;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Course;
use App\Models\LessonSection;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Task;
use App\Models\TaskScore;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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


    $tasks = getAllTasksSti($user);

    $hiddenLessons = LessonSection::where('section_id', $user->section->id)
        ->pluck('lesson_id')
        ->toArray();

    $tasks = $tasks->filter(function ($task) use ($hiddenLessons) {
        return !in_array($task->lesson_id, $hiddenLessons);
    })->values(); // Reindex to avoid gaps in keys




    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    $notifications = $user->agraNotifications;

    return view('home', [
        'courses' => $courses,
        'user' => $user,
        'tasks' => $tasks,
        'doneTasks' => $doneTasks,
        'notifications' => $notifications,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

function getAgraCourses($user){
    $userCourses = $user->courses;
    $sectionCourses = $user->section->courses;

    // Retrieve task IDs that the current user has marked as "Done"
    $userDoneTaskIds = getUserDoneTaskIds($user);

    // Get all courses except the ones the user is enrolled in and those authored by 'STI'
    $excludedCourseIds = $userCourses->pluck('id')->merge($sectionCourses->pluck('id'));
    $courses = Course::whereNotIn('id', $excludedCourseIds)
        ->where('author', '!=', 'STI')
        ->orderBy('CourseName', 'asc')
        ->get();

    return $courses;
}

function getUserDoneTaskIds($user){
    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
        $query->where('status', 'Done');
    })->pluck('task_id')->toArray();

    return $userDoneTaskIds;
}

Route::get('/agraCourses', function () {
    $user = Auth::user();
    $courses = getAgraCourses($user);

    $allTasks = getAllTasksSti($user);

    // Collect tasks from the filtered courses
    $tasks = collect();
    foreach ($courses as $course) {
        foreach ($course->lessons as $lesson) {
            $tasks = $tasks->merge($lesson->tasks ?? collect());
        }
    }

    // Remove tasks that are marked as "Done"
    $tasks = $tasks->whereNotIn('id', getUserDoneTaskIds($user));
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();

    return view('allCourses', [
        'courses' => $courses,
        'user' => $user,
        'tasks' => $tasks,
        'doneTasks' => $doneTasks,
        'allTasks' => $allTasks
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/agraCourses/References', function () {
    $user = Auth::user();
    $courses = getAgraCourses($user);

    // Collect tasks from the filtered courses
    $tasks = collect();
    foreach ($courses as $course) {
        foreach ($course->lessons as $lesson) {
            $tasks = $tasks->merge($lesson->tasks ?? collect());
        }
    }

    $allTasks = getAllTasksSti($user);

    // Remove tasks that are marked as "Done"
    $tasks = $tasks->whereNotIn('id', getUserDoneTaskIds($user));
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('agraReferences', [
        'courses' => $courses,
        'user' => $user,
        'tasks' => $tasks,
        'doneTasks' => $doneTasks,
        'allTasks' => $allTasks
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


function getAllTasksSti($user){
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

    return $tasks;
}

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

    $tasks = getAllTasksSti($user);

    $hiddenLessons = LessonSection::where('section_id', $user->section->id)
        ->pluck('lesson_id')
        ->toArray();

    $tasks = $tasks->filter(function ($task) use ($hiddenLessons) {
        return !in_array($task->lesson_id, $hiddenLessons);
    })->values(); // Reindex to avoid gaps in keys


    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('courses', [
        'courses'=> $courses,
        'user' => $user,
        'tasks' => $tasks,
        'doneTasks' => $doneTasks
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/task/{course:id}/{lesson:id}', function (Course $course, Lesson $lesson) {
    $user = Auth::user();

    // Filter tasks to only include those under the current lesson
    $tasks = $lesson->tasks;

    $allTasks = getAllTasksSti($user);
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('courseTask', [
        'course' => $course,
        'lesson'=>$lesson,
        'tasks' => $tasks,
        'user' => $user,
        'lessons' => $course->lessons,
        'allTasks' => $allTasks,
        'doneTasks' => $doneTasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/taskDeadlines/{date}', function ($date, Course $course, Lesson $lesson) {
    $user = Auth::user();

    $tasks = getAllTasksSti($user);

    // Filter tasks based on the given deadline date
    $taskDeadlines = $tasks->filter(function($task) use ($date) {
        return $task->Deadline && $task->Deadline->format('Y-m-d') === $date;
    });

    return view('taskDeadlines', [
        'course' => $course,
        'lesson' => $lesson,
        'tasks' => $tasks,
        'user' => $user,
        'lessons' => $course->lessons,
        'taskDeadlines' => $taskDeadlines,
        'selectedDate' => $date
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('courses/{course}', function (Course $course) {
    $user = Auth::user();
    // Fetch lessons from the course, but exclude those present in lesson_section table for this user
    $lessons = $course->lessons()->whereDoesntHave('sections', function ($query) use ($user) {
        $query->where('section_id', $user->section->id);
    })->get();

    $tasks = getAllTasksSti($user);

    // Get all the hidden lessons (where the lesson_id and section_id exist in lesson_section table)
    $hiddenLessons = LessonSection::where('section_id', $user->section->id)
        ->pluck('lesson_id')
        ->toArray();

    // Filter out tasks that belong to hidden lessons
    $tasks = $tasks->filter(function ($task) use ($hiddenLessons) {
        return !in_array($task->lesson_id, $hiddenLessons);
    });
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('lesson', [
        'course' => $course,
        'lessons' => $lessons,
        'user' => $user,
        'tasks' => $tasks,
        'doneTasks' => $doneTasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('agraCourses/{course:id}', function(Course $course) {
    $lessons = $course->lessons()->orderBy('LessonName', 'asc')->get();
    $user = Auth::user();

    $userCourses = $user->courses;
    $sectionCourses = $user->section->courses;

    // Get all courses except the ones the user is enrolled in and authored by 'STI'
    $courses = Course::whereNotIn('id', $userCourses->pluck('id'))
        ->whereNotIn('id', $sectionCourses->pluck('id'))
        ->where('author', '!=', 'STI')
        ->get();

    // Initialize the task collection
    $tasks = collect();

    // Fetch tasks from the filtered courses
    foreach($courses as $courseItem) {
        foreach ($courseItem->lessons as $lesson) {
            $tasks = $tasks->merge($lesson->tasks ?? collect());
        }
    }

    $allTasks = getAllTasksSti($user);
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('agraLessons', [
        'course' => $course, // Ensure the original course parameter is passed to the view
        'lessons' => $lessons,
        'user' => $user,
        'tasks' => $tasks,
        'allTasks' => $allTasks,
        'doneTasks' => $doneTasks
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
    $allTasks = getAllTasksSti($user);
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();

    return view('modules', [
        'lesson' => $lesson,
        'tasks' => $lesson->tasks,
        'lessons' => $course->lessons,
        'doneTasks' => $doneTasks,
        'course' => $course,
        'user' => $user,
        'allTasks' => $allTasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('agraLessons/{course:id}/{lesson:id}' , function(Course $course, Lesson $lesson) {
    $user = Auth::user();

//    // Retrieve task IDs that the current user has marked as "Done"
//    $userDoneTaskIds = $user->tasks()->whereHas('taskStatus', function ($query) {
//        $query->where('status', 'Done');
//    })->pluck('task_id')->toArray();
//
//    // Retrieve all tasks except those that are marked as "Done" for the current user
//    $tasks = Task::whereNotIn('id', $userDoneTaskIds)->get();

    $ytLinks = explode("\n", $lesson->links);

    $webLinks = explode("\n", $lesson->webLinks);

    $ytLinks = explode("\n", $lesson->links);

    function convertToEmbedUrl($url) {
        if (preg_match('/youtu\.be\/([^\?]*)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        } elseif (preg_match('/youtube\.com\/watch\?v=([^\&\?]*)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        return $url; // return the original URL if it doesn't match
    }

    $ytEmbedLinks = array_map('convertToEmbedUrl', $ytLinks);

    $allTasks = getAllTasksSti($user);
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('agraLesson', [
        'lesson' => $lesson,
        'tasks' => $lesson->tasks,
        'lessons' => $course->lessons,
        'course' => $course,
        'user' => $user,
        'allTasks' => $allTasks,
        'ytLinks' => $ytEmbedLinks,
        'webLinks' => $webLinks,
        'doneTasks' => $doneTasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('agraTasks/{course:id}/{lesson:id}' , function(Course $course, Lesson $lesson, Task $tasks) {
    $user = Auth::user();

    $allTasks = getAllTasksSti($user);
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('agraLessonTasks', [
        'lesson' => $lesson,
        'tasks' => $lesson->tasks,
        'lessons' => $course->lessons,
        'course' => $course,
        'user' => $user,
        'allTasks' => $allTasks,
        'doneTasks' => $doneTasks
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks/{task:id}' , function(Course $course, Lesson $lesson, Task $task) {
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

    $tasks = getAllTasksSti($user);
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('taskView', [
        'course' => $course,
        'lesson'=>$lesson,
        'user' => $user,
        'lessons' => $course->lessons,
        'task' => $task,
        'instructions' => $instructions,
        'tasks' => $task->lesson->tasks,
        'scores' => $scores,
        'doneTasks' => $doneTasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('agraTasks/{task:id}' , function(Task $task) {
    $instructions = $task->instructions;
    $user = Auth::user();
    $scores = \App\Models\Score::where('user_id', $user->id)->get();
    $courses = getAgraCourses($user);


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

    $allTasks = getAllTasksSti($user);
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();
    return view('agraTaskView', [
        'task' => $task,
        'courses' => $courses,
        'instructions' => $instructions,
        'user' => $user,
        'tasks' => $task->lesson->tasks,
        'scores' => $scores,
        'allTasks' => $allTasks,
        'doneTasks' => $doneTasks,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks/fight/{task:id}', function (Task $task) {
    $instructions = $task->instructions;
    $user = Auth::user();

    // Collect all answers into a single prompt
    $batchedAnswers = $instructions->map(function ($instruction) {
        $answerVariants = explode("\n", $instruction->answer);
        return [
            'instruction' => $instruction->instruction,
            'answers' => $answerVariants,
        ];
    });

    // Generate a single prompt for Gemini
    $yourApiKey = getenv('GEMINI_API_KEY');
    $client = Gemini::client($yourApiKey);
    $prompt = "Generate concise learning objectives for the following instructions and their answers. For example: Instruction: Declare a variable called number that has an integer value of 10 Objective: Declaring a Variable. You are not limited to the example, but just observe how it is made. Limit the objective to 3 words that relate to a programming concept. Refrain from generating a specific response like a data type, Just generate the programming concept/topic.Provide results in the format(just the objective not the Instruction, the instruction is just for context): "
        . "'Objective: [objective]'.\n\n";

    foreach ($batchedAnswers as $item) {
        $prompt .= "Instruction: " . $item['instruction'] . "\n";
        $prompt .= "Answers: " . json_encode($item['answers']) . "\n\n";
    }

    // Send the batched prompt to Gemini
    $response = $client->geminiPro()->generateContent($prompt);

    // Parse the response and map objectives back to instructions
    $objectives = explode("\n", $response->text()); // Adjust based on response format
    $instructionsWithObjectives = $instructions->map(function ($instruction, $index) use ($objectives) {
        $instruction->objective = $objectives[$index] ?? 'Objective not generated';
        return $instruction;
    });

    return view('task', [
        'task' => $task,
        'instructions' => $instructionsWithObjectives,
        'user' => $user,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks/ship/{task:id}' , function(Task $task) {
    $instructions = $task->instructions;
    $user = Auth::user();

    return view('taskShipMode', [
        'task' => $task,
        'courses' => $courses,
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
        $inputsArray = [];

        // Check if there are inputs
        if (trim($parts[0], '()') !== '') {
            // Map inputs to an array of integers
            $inputsArray = array_map('intval', explode(',', trim($parts[0], '()')));
        }

        // Check if there is an '=' character and handle the output part as a string
        if (count($parts) == 2) {
            // Trim and add the output part as a string
            $outputPart = trim($parts[1]);
            $inputsArray[] = $outputPart;
        }

        return $inputsArray;
    }, $testcasesLines);

    $user = Auth::user();

    if($task->lesson->course->category->name == 'Java'){

    return view('taskOutput', [
        'task' => $task,
        'testcases' => $testcasesArray,
        'user' => $user,
        'template' => $template,
        'methodName' => $task->output[0]->methodName,
    ]);
    }else if($task->lesson->course->category->name == 'C#'){
        return view('taskOutputCsharp', [
            'task' => $task,
            'testcases' => $testcasesArray,
            'user' => $user,
            'template' => $template,
            'methodName' => $task->output[0]->methodName,
        ]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

function generateTemplateWithBlanks($template, $answers) {
    // Iterate over the answers and replace each `{blank}` with the correct number of underscores
    foreach ($answers as $answer) {
        // Count the number of underscores needed for the answer
        $underscoreString = str_repeat('_', strlen($answer));
        // Replace the first occurrence of `{blank}` with the underscore string
        $template = preg_replace('/\{blank\}/', $underscoreString, $template, 1);
    }
    return $template;
}

Route::get('tasks/fitb/{task:id}' , function(Task $task) {
    $instructions = $task->instructions;
    $user = Auth::user();
    $answers = array();
    foreach ($instructions as $instruction){
        array_push($answers, $instruction->answer);
    }
    $template = generateTemplateWithBlanks($task->TaskCodeTemplate, $answers);
    

    // Collect all answers into a single prompt
    $batchedAnswers = $instructions->map(function ($instruction) {
        $answerVariants = explode("\n", $instruction->answer);
        return [
            'instruction' => $instruction->instruction,
            'answers' => $answerVariants,
        ];
    });

    // Generate a single prompt for Gemini
    $yourApiKey = getenv('GEMINI_API_KEY');
    $client = Gemini::client($yourApiKey);
    $prompt = "Generate concise learning objectives for the following instructions and their answers. For example: Instruction: Declare a variable called number that has an integer value of 10 Objective: Declaring a Variable. You are not limited to the example, but just observe how it is made. Limit the objective to 3 words that relate to a programming concept. Refrain from generating a specific response like a data type, Just generate the programming concept/topic.Provide results in the format(just the objective not the Instruction, the instruction is just for context): "
        . "'Objective: [objective]'.\n\n";

    foreach ($batchedAnswers as $item) {
        $prompt .= "Instruction: " . $item['instruction'] . "\n";
        $prompt .= "Answers: " . json_encode($item['answers']) . "\n\n";
    }

    // Send the batched prompt to Gemini
    $response = $client->geminiPro()->generateContent($prompt);

    // Parse the response and map objectives back to instructions
    $objectives = explode("\n", $response->text()); // Adjust based on response format
    $instructionsWithObjectives = $instructions->map(function ($instruction, $index) use ($objectives) {
        $instruction->objective = $objectives[$index] ?? 'Objective not generated';
        return $instruction;
    });

    return view('taskFITB', [
        'task' => $task,
        'instructions' => $instructions,
        'user' => $user,
        'template' => $template
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/multiplayer', function () {
    $user = Auth::user();

    // Retrieve the cached random task
    $randomTask = Cache::get('random_task');

    // If the task is not found (e.g., cache expired), generate and cache it again
    if (!$randomTask) {
        // Handle the situation when the cache expires or is not set
        // You could redirect, show an error, or select a new task
        return response()->json('An Error occurred please refresh after a minute');
    }

    // Now use the task in the view
    return view('taskMultiplayer', [
        'user' => $user,
        'instructions' => $randomTask->instructions,
        'task' => $randomTask,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/courseGrades', function(Task $task) {
//     $user = Auth::user();
//     $scores = \App\Models\Score::where('user_id', $user->id)->get();
//     $tasks = $user->tasks;

//     return view('courseGrades', [
//         'user' => $user,
//         'scores' => $scores,
//         'tasks' => $tasks
//     ]);
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('lessons/{course:id}/{lesson:id}/grades', function(Course $course, Lesson $lesson) {
    return handleGrades($course, $lesson);
})->middleware(['auth', 'verified'])->name('lessons.grades');

Route::get('task/{course:id}/{lesson:id}/grades', function(Course $course, Lesson $lesson) {
    return handleGrades($course, $lesson);
})->middleware(['auth', 'verified'])->name('task.grades');

function handleGrades(Course $course, Lesson $lesson) {
    $user = Auth::user();

    // Verify that the lesson belongs to the course
    if (!$course->lessons->contains($lesson)) {
        abort(404, 'Lesson not found in the course');
    }

    // Filter tasks to only include those under the current lesson
    $tasks = $lesson->tasks;

    // Filter tasks to get only those that are done by the user
    $doneTasks = \App\Models\TaskStatus::where('user_id', $user->id)->get();

    // Collect all tasks from the courses
    $allTasks = getAllTasksSti($user);

    return view('courseGrades', [
        'lesson' => $lesson,
        'tasks' => $tasks,
        'doneTasks' => $doneTasks,
        'lessons' => $course->lessons,
        'course' => $course,
        'user' => $user,
        'allTasks'=> $allTasks
    ]);
}

Route::get('/userProfile', function (){
    $user =Auth::user();

    $userCourses = $user->courses;
    $courses = $user->section->courses;
    $courses = $courses->merge($userCourses);

    return view ('userProfile', [
        'user' => $user,
        'courses' => $courses,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/userAnalytics', function () {
    try {
        $user = Auth::user();
        $taskData = fetchUserData($user);

        $taskJavaAccuracy = [];
        $taskCsharpAccuracy = [];
        $taskJavaCodingSpeed = [];
        $taskCsharpCodingSpeed = [];
        $taskJavaScore = [];
        $taskCsharpScore = [];

        $totalJavaTasks = isset($taskData['Java']['categories']) ? count($taskData['Java']['categories']) : 0;
        $totalCSharpTasks = isset($taskData['C#']['categories']) ? count($taskData['C#']['categories']) : 0;
        $totalTasks = $totalJavaTasks + $totalCSharpTasks;
        $overallAccuracy = 0;
        $overallSpeed = 0;
        $overallScore = 0;
        $overallPerformance = 0;

        // Iterate through Java tasks
        if (isset($taskData['Java'])) {
            foreach ($taskData['Java']['score'] as $index => $score) {
                $accuracy = calculateAccuracy(
                    $score,
                    $taskData['Java']['maxScore'][$index],
                    $taskData['Java']['errors'][$index]
                );
                $score = calculateScore($taskData['Java']['score'][$index], $taskData['Java']['maxScore'][$index]);
                $taskJavaAccuracy[] = $accuracy;
                $taskJavaScore[] = $score;
                $overallScore += $score;
                $overallAccuracy += $accuracy;
            }

            foreach ($taskData['Java']['timeLeft'] as $index => $timeLeft) {
                $speed = calculateCodingSpeed($timeLeft, $taskData['Java']['timeTaken'][$index]);
                $taskJavaCodingSpeed[] = $speed;
                $overallSpeed += $speed;
            }
        }

        // Iterate through C# tasks
        if (isset($taskData['C#'])) {
            foreach ($taskData['C#']['score'] as $index => $score) {
                $accuracy = calculateAccuracy(
                    $score,
                    $taskData['C#']['maxScore'][$index],
                    $taskData['C#']['errors'][$index]
                );
                $score = calculateScore($taskData['C#']['score'][$index], $taskData['C#']['maxScore'][$index]);
                $taskCsharpAccuracy[] = $accuracy;
                $taskCsharpScore[] = $score;
                $overallAccuracy += $accuracy;
                $overallScore += $score;
            }

            foreach ($taskData['C#']['timeLeft'] as $index => $timeLeft) {
                $speed = calculateCodingSpeed($timeLeft, $taskData['C#']['timeTaken'][$index]);
                $taskCsharpCodingSpeed[] = $speed;
                $overallSpeed += $speed;
            }
        }

        // Calculate overall accuracy and speed
        if ($totalTasks > 0) {
            $overallAccuracy = $overallAccuracy / $totalTasks;
            $overallSpeed = $overallSpeed / $totalTasks;
            $overallScore = $overallScore / $totalTasks;
            $overallPerformance = ($overallScore + $overallSpeed + $overallAccuracy) / 3;
        }

        $lessonJavaPerformance = [];
        $lessonCsharpPerformance = [];
        $tempLessonId = 0;

        // Iterate over the task data to group tasks by lessons
        foreach ($taskData as $category => $tasks) {
            // Iterate over each task in the current category
            foreach ($tasks['categories'] as $index => $categoryName) {
                // Extract the lesson ID from the task category name
                $lessonId = explode(' ', $categoryName)[1]; // Assuming the category name is like 'Task 123'
                $taskId = Task::find($lessonId);
                if (!$taskId) continue; // Skip if taskId is not found
                $lessonId = $taskId->lesson->id;
                $tempLessonId = $lessonId;
                $lessonName = Lesson::find($lessonId)->LessonName;

                // Check if the lesson ID exists as a key in the corresponding lesson performance array
                if (!isset($lessonPerformance[$lessonName])) {
                    // If the lesson ID doesn't exist, initialize its data structure in the appropriate array
                    if ($category === 'Java') {
                        $lessonPerformance[$lessonId] = [
                            'accuracy' => [],
                            'speed' => [],
                            'score' => [],
                        ];
                    } elseif ($category === 'C#') {
                        $lessonPerformance[$lessonId] = [
                            'accuracy' => [],
                            'speed' => [],
                            'score' => [],
                        ];
                    }
                }

                // Calculate accuracy and speed for the current task
                $accuracy = calculateAccuracy(
                    $tasks['score'][$index],
                    $tasks['maxScore'][$index],
                    $tasks['errors'][$index]
                );
                $speed = calculateCodingSpeed(
                    $tasks['timeLeft'][$index],
                    $tasks['timeTaken'][$index]
                );
                $score = calculateScore(
                    $tasks['score'][$index],
                    $tasks['maxScore'][$index]
                );

                // Add accuracy and speed for the current task to the appropriate lesson performance array
                if ($category === 'Java') {
                    $lessonJavaPerformance[$lessonId]['accuracy'][] = $accuracy;
                    $lessonJavaPerformance[$lessonId]['speed'][] = $speed;
                    $lessonJavaPerformance[$lessonId]['score'][] = $score;
                    $lessonJavaPerformance[$lessonId]['course_name'] = Lesson::find($tempLessonId)->course->CourseName;
                    $lessonJavaPerformance[$lessonId]['course_category_name'] = Lesson::find($tempLessonId)->course->category->name;

                    $lessonJavaPerformance[$lessonId]['lessonName'] = Lesson::find($tempLessonId)->LessonName;
                } elseif ($category === 'C#') {
                    $lessonCsharpPerformance[$lessonId]['accuracy'][] = $accuracy;
                    $lessonCsharpPerformance[$lessonId]['speed'][] = $speed;
                    $lessonCsharpPerformance[$lessonId]['score'][] = $score;
                    $lessonCsharpPerformance[$lessonId]['course_name'] = Lesson::find($tempLessonId)->course->CourseName;
                    $lessonCsharpPerformance[$lessonId]['course_category_name'] = Lesson::find($tempLessonId)->course->category->name;

                    $lessonCsharpPerformance[$lessonId]['lessonName'] = Lesson::find($tempLessonId)->LessonName;
                }
            }
        }

        $yourApiKey = getenv('GEMINI_API_KEY');
        $client = Gemini::client($yourApiKey);

        foreach ($lessonJavaPerformance as $lessonName => &$performance) {
            $tempOverallAccuracy = count($performance['accuracy']) > 0 ? array_sum($performance['accuracy']) / count($performance['accuracy']) : 0;
            $tempOverallSpeed = count($performance['speed']) > 0 ? array_sum($performance['speed']) / count($performance['speed']) : 0;
            $tempOverallScore = count($performance['score']) > 0 ? array_sum($performance['score']) / count($performance['score']) : 0;

            $overallPerformance = ($tempOverallAccuracy + $tempOverallSpeed + $tempOverallScore) / 3;

            // Determine the text interpretation based on overall performance
            switch (true) {
                case $overallPerformance >= 95:
                    $performance['textInterpretation'] = "S. Hooray! Your coding performance for "
                        . Lesson::find($lessonName)->LessonName
                        . " is excellent, what a wizard, keep up the good work!";
                    $performance['geminiTips'] = "Good Job!";
                    break;
                case $overallPerformance >= 90:
                    $performance['textInterpretation'] = "A. Keep up the good work! Your coding performance for Java is excellent!";
                    $performance['geminiTips'] = "Study more and you'll get S tier!";
                    break;
                case $overallPerformance >= 85:
                    $performance['textInterpretation'] = "B. Good effort! Try to refine your accuracy or speed for better results.";
                    $performance['geminiTips'] = "Keep improving you are getting there!";
                    break;
                case $overallPerformance >= 80:
                    $performance['textInterpretation'] = "C. Decent performance. Consider reviewing your approach to improve results.";
                    break;
                case $overallPerformance >= 75:
                    $performance['textInterpretation'] = "D. You’re making progress, but there's room for improvement.";
                    break;
                default:
                    $performance['textInterpretation'] = "F. Focus on addressing your weak areas to achieve better results.";
                    break;
            }

            $performance['overall_performance'] = $overallPerformance;

            // For "B" tier and below, fetch tips from Gemini
            if ($overallPerformance < 85) {
                $lesson = Lesson::find($lessonName); // Fetch the lesson object
                $categories = $lesson->categories->pluck('name')->toArray(); // Get the category names as an array
                $categoryList = implode(", ", $categories); // Convert to a comma-separated string

                $geminiPrompt = "Provide tips to improve coding performance for a student in the Java category. The lesson covers these topics: $categoryList. Focus on actionable advice related to the categories and all the content you return should be in one to two sentences only. do not add any special characters or bullets and asterisks just a plain sentence with proper punctuations.";
                $result = $client->geminiPro()->generateContent($geminiPrompt);
                $performance['geminiTips'] = $result->text();
            }
        }

        foreach ($lessonCsharpPerformance as $lessonName => &$performance) {
            $tempOverallAccuracy = count($performance['accuracy']) > 0 ? array_sum($performance['accuracy']) / count($performance['accuracy']) : 0;
            $tempOverallSpeed = count($performance['speed']) > 0 ? array_sum($performance['speed']) / count($performance['speed']) : 0;
            $tempOverallScore = count($performance['score']) > 0 ? array_sum($performance['score']) / count($performance['score']) : 0;

            $overallPerformance = ($tempOverallAccuracy + $tempOverallSpeed + $tempOverallScore) / 3;

            // Determine the text interpretation based on overall performance
            switch (true) {
                case $overallPerformance >= 95:
                    $performance['textInterpretation'] = "S. Fantastic work on "
                        . Lesson::find($lessonName)->LessonName
                        . "! Your C# coding skills are phenomenal.";
                    $performance['geminiTips'] = "Keep up the good work!";
                    break;
                case $overallPerformance >= 90:
                    $performance['textInterpretation'] = "A. Great job! Your C# coding performance is excellent!";
                    $performance['geminiTips'] = "Keep up the good work!";
                    break;
                case $overallPerformance >= 85:
                    $performance['textInterpretation'] = "B. Solid work! Review your techniques to achieve greater consistency.";
                    $performance['geminiTips'] = "Keep up the good work!";
                    break;
                case $overallPerformance >= 80:
                    $performance['textInterpretation'] = "C. Decent effort. Focus on refining your speed and accuracy.";
                    break;
                case $overallPerformance >= 75:
                    $performance['textInterpretation'] = "D. There’s room for improvement. Keep practicing!";
                    break;
                default:
                    $performance['textInterpretation'] = "F. Don’t get discouraged. Practice regularly to improve your skills.";
                    break;
            }

            $performance['overall_performance'] = $overallPerformance;

            if ($overallPerformance <= 90) {
                $lesson = Lesson::find($lessonName); // Fetch the lesson object
                $categories = $lesson->categories->pluck('name')->toArray(); // Get the category names as an array
                $categoryList = implode(", ", $categories); // Convert to a comma-separated string
                $geminiPrompt = "Provide tips to improve coding performance for a student. The lesson covers these topics: $categoryList. provide technical programming advice that help them to improve at the categories given and and all the content you return should be in one to two sentences only. do not add any special characters or bullets ar asterisks just a plain sentence with proper punctuations.";
                $result = $client->geminiPro()->generateContent($geminiPrompt);
                $performance['geminiTips'] = $result->text();
            }
        }




        $lessonPerformance = $lessonJavaPerformance + $lessonCsharpPerformance;

        return view('userAnalytics', [
            'user' => $user,
            'taskData' => $taskData,
            'lessonPerformance' => $lessonPerformance,
            'taskJavaAccuracy' => $taskJavaAccuracy,
            'taskJavaSpeed' => $taskJavaCodingSpeed,
            'taskCsharpAccuracy' => $taskCsharpAccuracy,
            'taskCsharpSpeed' => $taskCsharpCodingSpeed,
            'taskJavaScore' => $taskJavaScore,
            'taskCsharpScore' => $taskCsharpScore,
            'overallSpeed' => $overallSpeed,
            'overallAccuracy' => $overallAccuracy,
            'overallScore' => $overallScore,
            'overallPerformance' => $overallPerformance,
        ]);
    } catch (Exception $e) {
        // Log the exception message for debugging purposes
        Log::error('Error occurred in user analytics: ' . $e->getMessage());
        // Retrieve the authenticated user
        $user = Auth::user();

        // Initialize the collections and other variables if not already set
        $taskData = $taskData ?? collect();
        $lessonPerformance = $lessonPerformance ?? collect();
        $taskJavaAccuracy = $taskJavaAccuracy ?? [];
        $taskJavaCodingSpeed = $taskJavaCodingSpeed ?? [];
        $taskCsharpAccuracy = $taskCsharpAccuracy ?? [];
        $taskCsharpCodingSpeed = $taskCsharpCodingSpeed ?? [];
        $taskJavaScore = $taskJavaScore ?? [];
        $taskCsharpScore = $taskCsharpScore ?? [];
        $overallSpeed = $overallSpeed ?? 0;
        $overallAccuracy = $overallAccuracy ?? 0;
        $overallScore = $overallScore ?? 0;
        $overallPerformance = $overallPerformance ?? 0;

        // Return the view with the user data and analytics
        return view('userAnalytics', [
            'user' => $user,
            'taskData' => $taskData,
            'lessonPerformance' => $lessonPerformance,
            'taskJavaAccuracy' => $taskJavaAccuracy,
            'taskJavaSpeed' => $taskJavaCodingSpeed,
            'taskCsharpAccuracy' => $taskCsharpAccuracy,
            'taskCsharpSpeed' => $taskCsharpCodingSpeed,
            'taskJavaScore' => $taskJavaScore,
            'taskCsharpScore' => $taskCsharpScore,
            'overallSpeed' => $overallSpeed,
            'overallAccuracy' => $overallAccuracy,
            'overallScore' => $overallScore,
            'overallPerformance' => $overallPerformance,
        ]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');


function fetchUserData($user)  {
    // Default taskData structure with default values set to 0 for Java and C#
    $taskData = [
        'Java' => [
            'errors' => [1],
            'timeTaken' => [1],
            'timeLeft' => [1],
            'score' => [1],
            'maxScore' => [1],
            'categories' => ['No Java Tasks Available']
        ],
        'C#' => [
            'errors' => [1],
            'timeTaken' => [1],
            'timeLeft' => [1],
            'score' => [1],
            'maxScore' => [1],
            'categories' => ['No C# Tasks Available']
        ]
    ];

    // Fetch task scores for the authenticated user
    $taskScores = TaskScore::where('user_id', $user->id)->get();

    // Populate taskData if there are relevant task scores
    foreach ($taskScores as $taskScore) {
        // Retrieve the task using task_id
        $task = Task::find($taskScore->task_id);

        if ($task) {
            // Retrieve the category name from the task's lesson course
            $categoryName = $task->lesson->course->category->name;
            $score = \App\Models\Score::find($taskScore->score_id);

            // Store data in the taskData array, replacing the default 0 values
            $taskData[$categoryName]['errors'][] = $taskScore->Errors;
            $taskData[$categoryName]['timeTaken'][] = $taskScore->TimeTaken;
            $taskData[$categoryName]['timeLeft'][] = $taskScore->TimeLeft;
            $taskData[$categoryName]['score'][] = $score->score;
            $taskData[$categoryName]['maxScore'][] = $score->MaxScore;
            $taskData[$categoryName]['categories'][] = 'Task ' . $taskScore->task_id;
        }
    }

    // Remove the default values if actual data exists
    foreach (['Java', 'C#'] as $category) {
        if (count($taskData[$category]['categories']) > 1) { // more than the default item
            // Remove the initial default 0 values
            array_shift($taskData[$category]['errors']);
            array_shift($taskData[$category]['timeTaken']);
            array_shift($taskData[$category]['timeLeft']);
            array_shift($taskData[$category]['score']);
            array_shift($taskData[$category]['maxScore']);
            array_shift($taskData[$category]['categories']);
        }
    }

    return $taskData;
}

Route::get('/recommendation', function () {
    $user = Auth::user();
    try {

        $taskData = fetchUserData($user);

        $taskJavaAccuracy = [];
        $taskCsharpAccuracy = [];
        $taskJavaCodingSpeed = [];
        $taskCsharpCodingSpeed = [];
        $taskJavaScore = [];
        $taskCsharpScore = [];

        $totalJavaTasks = count($taskData['Java']['categories']);
        $totalCSharpTasks = count($taskData['C#']['categories']);
        $totalTasks = $totalJavaTasks + $totalCSharpTasks;
        $overallAccuracy = 0;
        $overallSpeed = 0;
        $overallScore = 0;
        $overallPerformance = 0;

        // Iterate through Java tasks
        foreach ($taskData['Java']['score'] as $index => $score) {
            $accuracy = calculateAccuracy(
                $score,
                $taskData['Java']['maxScore'][$index],
                $taskData['Java']['errors'][$index]
            );
            $score = calculateScore($taskData['Java']['score'][$index], $taskData['Java']['maxScore'][$index]);
            $taskJavaAccuracy[] = $accuracy;
            $taskJavaScore[] = $score;
            $overallScore += $score;
            $overallAccuracy += $accuracy;
        }

        // Iterate through C# tasks
        foreach ($taskData['C#']['score'] as $index => $score) {
            $accuracy = calculateAccuracy(
                $score,
                $taskData['C#']['maxScore'][$index],
                $taskData['C#']['errors'][$index]
            );
            $score = calculateScore($taskData['C#']['score'][$index], $taskData['C#']['maxScore'][$index]);
            $taskCsharpAccuracy[] = $accuracy;
            $taskCsharpScore[] = $score;
            $overallAccuracy += $accuracy;
            $overallScore += $score;
        }




        // Iterate through C# tasks for coding speed
        foreach ($taskData['C#']['timeLeft'] as $index => $timeLeft) {
            $speed = calculateCodingSpeed($timeLeft, $taskData['C#']['timeTaken'][$index]);
            $taskCsharpCodingSpeed[] = $speed;
            $overallSpeed += $speed;
        }

        // Iterate through Java tasks for coding speed
        foreach ($taskData['Java']['timeLeft'] as $index => $timeLeft) {
            $speed = calculateCodingSpeed($timeLeft, $taskData['Java']['timeTaken'][$index]);
            $taskJavaCodingSpeed[] = $speed;
            $overallSpeed += $speed;
        }


        // Calculate overall accuracy and speed
        if ($totalTasks > 0) {
            $overallAccuracy = $overallAccuracy / $totalTasks;
            $overallSpeed = $overallSpeed / $totalTasks;
            $overallScore = $overallScore / $totalTasks;
            $overallPerformance = ($overallScore + $overallSpeed + $overallAccuracy) / 3;
        }

        $lessonJavaPerformance = [];
        $lessonCsharpPerformance = [];

        // Iterate over the task data to group tasks by lessons
        foreach ($taskData as $category => $tasks) {
            // Iterate over each task in the current category
            foreach ($tasks['categories'] as $index => $categoryName) {
                // Extract the lesson ID from the task category name
                $lessonId = explode(' ', $categoryName)[1]; // Assuming the category name is like 'Task 123'
                $taskId = Task::find($lessonId);
                if (!$taskId) continue; // Skip if taskId is not found
                $lessonId = $taskId->lesson->id;
                //error_log($categoryName . ' ' . $index . ' l ' . $lessonId);

                // Check if the lesson ID exists as a key in the corresponding lesson performance array
                if (!isset($lessonPerformance[$lessonId])) {
                    // If the lesson ID doesn't exist, initialize its data structure in the appropriate array
                    if ($category === 'Java') {
                        $lessonPerformance[$lessonId] = [
                            'accuracy' => [],
                            'speed' => [],
                            'score'=> [],
                        ];
                    } elseif ($category === 'C#') {
                        $lessonPerformance[$lessonId] = [
                            'accuracy' => [],
                            'speed' => [],
                            'score' => [],
                        ];
                    }
                }

                // Calculate accuracy and speed for the current task
                $accuracy = calculateAccuracy(
                    $tasks['score'][$index],
                    $tasks['maxScore'][$index],
                    $tasks['errors'][$index]
                );
                $speed = calculateCodingSpeed(
                    $tasks['timeLeft'][$index],
                    $tasks['timeTaken'][$index]
                );
                $score = calculateScore(
                   $tasks['score'][$index],
                   $tasks['maxScore'][$index]
                );

                // Add accuracy and speed for the current task to the appropriate lesson performance array
                if ($category === 'Java') {
                    $lessonJavaPerformance[$lessonId]['accuracy'][] = $accuracy;
                    $lessonJavaPerformance[$lessonId]['speed'][] = $speed;
                    $lessonJavaPerformance[$lessonId]['score'][] = $score;
                } elseif ($category === 'C#') {
                    $lessonCsharpPerformance[$lessonId]['accuracy'][] = $accuracy;
                    $lessonCsharpPerformance[$lessonId]['speed'][] = $speed;
                    $lessonCsharpPerformance[$lessonId]['score'][] = $score;
                }
            }
        }

        // Calculate overall performance for each lesson
        foreach ($lessonJavaPerformance as $lessonId => &$performance) {
            // Calculate overall accuracy and speed for the lesson
            $overallAccuracy = count($performance['accuracy']) > 0 ? array_sum($performance['accuracy']) / count($performance['accuracy']) : 0;
            $overallSpeed = count($performance['speed']) > 0 ? array_sum($performance['speed']) / count($performance['speed']) : 0;
            $overallScore = count($performance['score']) > 0 ? array_sum($performance['score']) / count($performance['score']) : 0;

            // Perform your formula to compute overall user performance for the lesson
            $overallPerformance = ($overallAccuracy + $overallSpeed + $overallScore) / 3;

            // Store the overall user performance for the lesson
            $performance['overall_performance'] = $overallPerformance;
        }

        // Calculate overall performance for each lesson
        foreach ($lessonCsharpPerformance as $lessonId => &$performance) {
            // Calculate overall accuracy and speed for the lesson
            $overallAccuracy = count($performance['accuracy']) > 0 ? array_sum($performance['accuracy']) / count($performance['accuracy']) : 0;
            $overallSpeed = count($performance['speed']) > 0 ? array_sum($performance['speed']) / count($performance['speed']) : 0;
            $overallScore = count($performance['score']) > 0 ? array_sum($performance['score']) / count($performance['score']) : 0;

            // Perform your formula to compute overall user performance for the lesson
            $overallPerformance = ($overallAccuracy + $overallSpeed + $overallScore) / 3;

            // Store the overall user performance for the lesson
            $performance['overall_performance'] = $overallPerformance;
        }

        $lessonPerformance = $lessonJavaPerformance + $lessonCsharpPerformance;
        $lessonPerformanceWithAgra = $lessonPerformance;
        $lessonPerformance = removeAgraLessons($lessonPerformance, $user);

        $badperformancelessons = []; // Initialize array to store lesson IDs with bad performance

        // Calculate overall performance for each lesson
        foreach ($lessonPerformance as $lessonId => &$performance) {
            // Calculate overall accuracy and speed for the lesson
            $overallAccuracy = count($performance['accuracy']) > 0 ? array_sum($performance['accuracy']) / count($performance['accuracy']) : 0;
            $overallSpeed = count($performance['speed']) > 0 ? array_sum($performance['speed']) / count($performance['speed']) : 0;
            $overallScore = count($performance['score']) > 0 ? array_sum($performance['score']) / count($performance['score']) : 0;

            // Perform your formula to compute overall user performance for the lesson
            $overallPerformance = ($overallAccuracy + $overallSpeed + $overallScore) / 3;
            // Store the overall user performance for the lesson
            $performance['overall_performance'] = $overallPerformance;

            // Check if overall performance is below 45
            if ($overallPerformance < 90) {
                $badperformancelessons[] = ['lesson_id' => $lessonId, 'performance' => $overallPerformance]; // Push lesson ID and performance to badperformancelessons array
            }
        }

        // Calculate overall performance for each lesson
        foreach ($lessonPerformanceWithAgra as $lessonId => &$performance) {
            // Calculate overall accuracy and speed for the lesson
            $overallAccuracy1 = count($performance['accuracy']) > 0 ? array_sum($performance['accuracy']) / count($performance['accuracy']) : 0;
            $overallSpeed1 = count($performance['speed']) > 0 ? array_sum($performance['speed']) / count($performance['speed']) : 0;
            $overallScore1 = count($performance['score']) > 0 ? array_sum($performance['score']) / count($performance['score']) : 0;

            // Perform your formula to compute overall user performance for the lesson
            $overallPerformance1 = ($overallAccuracy + $overallSpeed + $overallScore) / 3;
            // Store the overall user performance for the lesson
            $performance['overall_performance'] = $overallPerformance1;

            // Check if overall performance is below 45
            if ($overallPerformance < 90) {
                $badperformancelessons[] = ['lesson_id' => $lessonId, 'performance' => $overallPerformance1]; // Push lesson ID and performance to badperformancelessons array
            }
        }



        // Sort badperformancelessons by overall performance in ascending order
        usort($badperformancelessons, function ($a, $b) {
            return $a['performance'] <=> $b['performance'];
        });

        // Extract sorted lesson IDs
        $badperformancelessonIds = array_column($badperformancelessons, 'lesson_id');

        $agraCourses = getAgraCourses($user);
        $agraLessons = collect();
        $recommendedLessons = collect();
        $relatedLessons = collect();
        $badPerformanceLessonCategories = [];
        // Iterate over each course in agraCourses
        foreach ($agraCourses as $course) {
            // Merge lessons from the current course into agraLessons collection
            $agraLessons = $agraLessons->merge($course->lessons);
        }

        // Iterate over each bad performance lesson
        foreach ($badperformancelessonIds as $lessonId) {
            // Find the lesson by ID
            $lesson = Lesson::find($lessonId);
            if (!$lesson) continue; // Skip if lesson is not found
            foreach ($lesson->categories as $category) {
                $badPerformanceLessonCategories[] = $category->name;
            }

            // Count the number of shared categories with each lesson
            foreach ($agraCourses as $course) {
                foreach ($course->lessons as $lesson) {
                    // Iterate over each category of the lesson
                    $sharedCategoriesCount = 0;
                    foreach ($lesson->categories as $category) {
                        // Check if the category exists in bad performance lessons
                        if (in_array($category->name, $badPerformanceLessonCategories)) {
                            $sharedCategoriesCount++;
                        }
                    }
                    if ($sharedCategoriesCount >= 2) {
                        $recommendedLessons->push($lesson);
                        continue;
                    }
                    if ($sharedCategoriesCount >= 1) {
                        $relatedLessons->push($lesson);
                    }
                }
            }
        }

        $badPerformanceLessonCategories = array_unique($badPerformanceLessonCategories);


        $recommendedLessons = $recommendedLessons->unique();
        return view('recommended', [
            'user' => $user,
            'lessons' => $recommendedLessons,
            'relatedLessons' => $relatedLessons,
            'badLessonCategories' => $badPerformanceLessonCategories,
        ]);
    } catch (Exception $e) {
        error_log('An error occurred: ' . $e->getMessage());
        $lessons = collect();
        $relatedLessons = collect();
        return view('recommended', [
            'user' => $user,
            'lessons' => $lessons,
            'relatedLessons' => $relatedLessons,
        ]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');


function removeAgraLessons($lessonPerformance, $user)
{
    // Fetch courses owned or created by Agra
    $agraCourses = getAgraCourses($user);

// Iterate over the lesson performances to remove lessons belonging to Agra's courses
    foreach ($lessonPerformance as $lessonId => $performance) {
        // Check if the lesson's course is owned or created by Agra
        $lesson = Lesson::find($lessonId);
        if ($lesson && $agraCourses->contains('id', $lesson->course_id)) {
            // Remove lesson performance for lessons belonging to Agra's courses
            unset($lessonPerformance[$lessonId]);
        }
    }

    return $lessonPerformance;
}

// Functions to calculate accuracy and coding speed
function calculateAccuracy($score, $maxScore, $errors, $errorPenaltyPercent = 1.5) {
    // Calculate the base accuracy as a percentage

    // Calculate the penalty per error as a percentage
    //20  * 0.2 = 0.4
    $basePenalty = ($maxScore * 0.02);

    //Calculate error percentage
    //5 errors = 2
    $errorPenalty = $basePenalty * $errors;

    // Calculate adjusted accuracy by deducting the penalty for errors
    $adjustedAccuracy = $maxScore - $errorPenalty;
    $adjustedAccuracy = ($adjustedAccuracy / $maxScore) * 100;

    // Ensure adjusted accuracy doesn't go below 0
    $adjustedAccuracy = max($adjustedAccuracy, 0);

    // Round the accuracy to two decimal places for precision
    $adjustedAccuracy = round($adjustedAccuracy, 2);

    return $adjustedAccuracy;
}

function calculateScore($score, $maxScore){
    return ($score / $maxScore) * 100;
}

function calculateCodingSpeed($timeLeft, $timeTaken) {
    // Ensure timeLeft and timeTaken are non-negative
    $timeLeft = max($timeLeft, 0);
    $timeTaken = max($timeTaken, 0);

    // Calculate total time spent coding
    $totalTime = $timeTaken + $timeLeft;

    // Check if the user has more than 50% of time left
    if ($timeLeft / $totalTime > 0.5) {
        return 5 * 20; // Set coding speed to 5
    } else {
        // Calculate the percentage of time left
        $percentageTimeLeft = ($timeLeft / $totalTime) * 100;

        // Calculate rating based on percentage of time left
        $rating = max(1, $percentageTimeLeft / 10) * 20;

        return round($rating, 1);
    }
}


Route::get('/aboutUs', function (){
    $user =Auth::user();

    return view ('aboutUs', [
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('courses/{course:id}/grades', function(Course $course) {
//     $user = Auth::user();

//     $tasks = collect();

//     if ($user->courses) {
//         foreach($user->courses as $userCourse) {
//             foreach ($userCourse->lessons as $lesson) {
//                 $tasks = $tasks->merge($lesson->tasks ?? collect());
//             }
//         }
//     }

//     if ($user->section && $user->section->courses) {
//         foreach($user->section->courses as $sectionCourse) {
//             foreach ($sectionCourse->lessons as $lesson) {
//                 $tasks = $tasks->merge($lesson->tasks ?? collect());
//             }
//         }
//     }

//     // Filter tasks to get only those that are done by the user
//     $doneTasks = \App\Models\TaskStatus::all()->where('user_id', $user->id);



//     return view('taskGrades', [
//         'tasks' => $tasks,
//         'doneTasks' => $doneTasks,
//         'lessons' => $course->lessons,
//         'course' => $course,
//         'user' => $user
//     ]);
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/studentAnalytics/{student}{', function (User $student) {
    try {
        $user = $student;
        $taskData = fetchUserData($user);

        $taskJavaAccuracy = [];
        $taskCsharpAccuracy = [];
        $taskJavaCodingSpeed = [];
        $taskCsharpCodingSpeed = [];
        $taskJavaScore = [];
        $taskCsharpScore = [];

        $totalJavaTasks = isset($taskData['Java']['categories']) ? count($taskData['Java']['categories']) : 0;
        $totalCSharpTasks = isset($taskData['C#']['categories']) ? count($taskData['C#']['categories']) : 0;
        $totalTasks = $totalJavaTasks + $totalCSharpTasks;
        $overallAccuracy = 0;
        $overallSpeed = 0;
        $overallScore = 0;
        $overallPerformance = 0;

        // Iterate through Java tasks
        if (isset($taskData['Java'])) {
            foreach ($taskData['Java']['score'] as $index => $score) {
                $accuracy = calculateAccuracy(
                    $score,
                    $taskData['Java']['maxScore'][$index],
                    $taskData['Java']['errors'][$index]
                );
                $score = calculateScore($taskData['Java']['score'][$index], $taskData['Java']['maxScore'][$index]);
                $taskJavaAccuracy[] = $accuracy;
                $taskJavaScore[] = $score;
                $overallScore += $score;
                $overallAccuracy += $accuracy;
            }

            foreach ($taskData['Java']['timeLeft'] as $index => $timeLeft) {
                $speed = calculateCodingSpeed($timeLeft, $taskData['Java']['timeTaken'][$index]);
                $taskJavaCodingSpeed[] = $speed;
                $overallSpeed += $speed;
            }
        }

        // Iterate through C# tasks
        if (isset($taskData['C#'])) {
            foreach ($taskData['C#']['score'] as $index => $score) {
                $accuracy = calculateAccuracy(
                    $score,
                    $taskData['C#']['maxScore'][$index],
                    $taskData['C#']['errors'][$index]
                );
                $score = calculateScore($taskData['C#']['score'][$index], $taskData['C#']['maxScore'][$index]);
                $taskCsharpAccuracy[] = $accuracy;
                $taskCsharpScore[] = $score;
                $overallAccuracy += $accuracy;
                $overallScore += $score;
            }

            foreach ($taskData['C#']['timeLeft'] as $index => $timeLeft) {
                $speed = calculateCodingSpeed($timeLeft, $taskData['C#']['timeTaken'][$index]);
                $taskCsharpCodingSpeed[] = $speed;
                $overallSpeed += $speed;
            }
        }

        // Calculate overall accuracy and speed
        if ($totalTasks > 0) {
            $overallAccuracy = $overallAccuracy / $totalTasks;
            $overallSpeed = $overallSpeed / $totalTasks;
            $overallScore = $overallScore / $totalTasks;
            $overallPerformance = ($overallScore + $overallSpeed + $overallAccuracy) / 3;
        }

        $lessonJavaPerformance = [];
        $lessonCsharpPerformance = [];
        $tempLessonId = 0;

        // Iterate over the task data to group tasks by lessons
        foreach ($taskData as $category => $tasks) {
            // Iterate over each task in the current category
            foreach ($tasks['categories'] as $index => $categoryName) {
                // Extract the lesson ID from the task category name
                $lessonId = explode(' ', $categoryName)[1]; // Assuming the category name is like 'Task 123'
                $taskId = Task::find($lessonId);
                if (!$taskId) continue; // Skip if taskId is not found
                $lessonId = $taskId->lesson->id;
                $tempLessonId = $lessonId;
                $lessonName = Lesson::find($lessonId)->LessonName;

                // Check if the lesson ID exists as a key in the corresponding lesson performance array
                if (!isset($lessonPerformance[$lessonName])) {
                    // If the lesson ID doesn't exist, initialize its data structure in the appropriate array
                    if ($category === 'Java') {
                        $lessonPerformance[$lessonName] = [
                            'accuracy' => [],
                            'speed' => [],
                            'score' => [],
                        ];
                    } elseif ($category === 'C#') {
                        $lessonPerformance[$lessonName] = [
                            'accuracy' => [],
                            'speed' => [],
                            'score' => [],
                        ];
                    }
                }

                // Calculate accuracy and speed for the current task
                $accuracy = calculateAccuracy(
                    $tasks['score'][$index],
                    $tasks['maxScore'][$index],
                    $tasks['errors'][$index]
                );
                $speed = calculateCodingSpeed(
                    $tasks['timeLeft'][$index],
                    $tasks['timeTaken'][$index]
                );
                $score = calculateScore(
                    $tasks['score'][$index],
                    $tasks['maxScore'][$index]
                );

                // Add accuracy and speed for the current task to the appropriate lesson performance array
                if ($category === 'Java') {
                    $lessonJavaPerformance[$lessonName]['accuracy'][] = $accuracy;
                    $lessonJavaPerformance[$lessonName]['speed'][] = $speed;
                    $lessonJavaPerformance[$lessonName]['score'][] = $score;
                    $lessonJavaPerformance[$lessonName]['course_name'] = Lesson::find($tempLessonId)->course->CourseName;
                    $lessonJavaPerformance[$lessonName]['course_category_name'] = Lesson::find($tempLessonId)->course->category->name;
                } elseif ($category === 'C#') {
                    $lessonCsharpPerformance[$lessonName]['accuracy'][] = $accuracy;
                    $lessonCsharpPerformance[$lessonName]['speed'][] = $speed;
                    $lessonCsharpPerformance[$lessonName]['score'][] = $score;
                    $lessonCsharpPerformance[$lessonName]['course_name'] = Lesson::find($tempLessonId)->course->CourseName;
                    $lessonCsharpPerformance[$lessonName]['course_category_name'] = Lesson::find($tempLessonId)->course->category->name;
                }
            }
        }

        // Calculate overall performance for each lesson
        foreach ($lessonJavaPerformance as $lessonName => &$performance) {
            $tempOverallAccuracy = count($performance['accuracy']) > 0 ? array_sum($performance['accuracy']) / count($performance['accuracy']) : 0;
            $tempOverallSpeed = count($performance['speed']) > 0 ? array_sum($performance['speed']) / count($performance['speed']) : 0;
            $tempOverallScore = count($performance['score']) > 0 ? array_sum($performance['score']) / count($performance['speed']) : 0;

            $overallPerformance = ($tempOverallAccuracy + $tempOverallSpeed + $tempOverallScore) / 3;
            $performance['overall_performance'] = $overallPerformance;
        }

        foreach ($lessonCsharpPerformance as $lessonName => &$performance) {
            $tempOverallAccuracy = count($performance['accuracy']) > 0 ? array_sum($performance['accuracy']) / count($performance['accuracy']) : 0;
            $tempOverallSpeed = count($performance['speed']) > 0 ? array_sum($performance['speed']) / count($performance['speed']) : 0;
            $tempOverallscore = count($performance['score']) > 0 ? array_sum($performance['score']) / count($performance['score']) : 0;

            $overallPerformance = ($tempOverallAccuracy + $tempOverallSpeed + $tempOverallscore) / 3;
            $performance['overall_performance'] = $overallPerformance;
        }

        $lessonPerformance = $lessonJavaPerformance + $lessonCsharpPerformance;
        return view('userAnalytics', [
            'user' => $user,
            'taskData' => $taskData,
            'lessonPerformance' => $lessonPerformance,
            'taskJavaAccuracy' => $taskJavaAccuracy,
            'taskJavaSpeed' => $taskJavaCodingSpeed,
            'taskCsharpAccuracy' => $taskCsharpAccuracy,
            'taskCsharpSpeed' => $taskCsharpCodingSpeed,
            'taskJavaScore' => $taskJavaScore,
            'taskCsharpScore' => $taskCsharpScore,
            'overallSpeed' => $overallSpeed,
            'overallAccuracy' => $overallAccuracy,
            'overallScore' => $overallScore,
            'overallPerformance' => $overallPerformance,
        ]);
    } catch (Exception $e) {
        // Log the exception message for debugging purposes
        Log::error('Error occurred in user analytics: ' . $e->getMessage());
        // Retrieve the authenticated user
        $user = Auth::user();

        // Initialize the collections and other variables if not already set
        $taskData = $taskData ?? collect();
        $lessonPerformance = $lessonPerformance ?? collect();
        $taskJavaAccuracy = $taskJavaAccuracy ?? [];
        $taskJavaCodingSpeed = $taskJavaCodingSpeed ?? [];
        $taskCsharpAccuracy = $taskCsharpAccuracy ?? [];
        $taskCsharpCodingSpeed = $taskCsharpCodingSpeed ?? [];
        $taskJavaScore = $taskJavaScore ?? [];
        $taskCsharpScore = $taskCsharpScore ?? [];
        $overallSpeed = $overallSpeed ?? 0;
        $overallAccuracy = $overallAccuracy ?? 0;
        $overallScore = $overallScore ?? 0;
        $overallPerformance = $overallPerformance ?? 0;

        // Return the view with the user data and analytics
        return view('userAnalytics', [
            'user' => $user,
            'taskData' => $taskData,
            'lessonPerformance' => $lessonPerformance,
            'taskJavaAccuracy' => $taskJavaAccuracy,
            'taskJavaSpeed' => $taskJavaCodingSpeed,
            'taskCsharpAccuracy' => $taskCsharpAccuracy,
            'taskCsharpSpeed' => $taskCsharpCodingSpeed,
            'taskJavaScore' => $taskJavaScore,
            'taskCsharpScore' => $taskCsharpScore,
            'overallSpeed' => $overallSpeed,
            'overallAccuracy' => $overallAccuracy,
            'overallScore' => $overallScore,
            'overallPerformance' => $overallPerformance,
        ]);
    }
})->middleware(['auth', 'verified'])->name('studentAnalytics');


Route::post('/execute-code', [\App\Http\Controllers\RunCode::class, 'executeCode']);

Route::post('/execute-code-csharp', [\App\Http\Controllers\RunCode::class, 'executeCodeCsharp']);

Route::post('/prompt', [\App\Http\Controllers\GeminiController::class, 'prompt']);

Route::post('/readNotifications', [\App\Http\Controllers\AgraNotificationController::class, 'store']);

require __DIR__.'/auth.php';
