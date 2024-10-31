<?php

namespace App\Console;

use App\Events\AgraNotificationPusher;
use App\Models\Section;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            try {
                $sections = Section::all();


                foreach ($sections as $section) {
                    // Get the first user in this section
                    $user = $section->users()->first();
                    // Check if the user is null or the section is null
                        Log::warning("section ID: {$section->id}");


                    $tasks = collect();

                    // Retrieve lessons and tasks for the courses in this section
                    if ($user->section->courses) {
                        foreach ($user->section->courses as $course) {
                            foreach ($course->lessons as $lesson) {
                                $tasks = $tasks->merge($lesson->tasks ?? collect());
                            }
                        }
                    }

                    // Send notifications for each task found
                    foreach ($tasks as $task) {
                        if (!$task->TaskName) {
                            continue; // Skip if TaskName is missing
                        }

                        // Broadcast an event for the reminder

                        // Create notifications for each user in the section
                        foreach ($section->users as $user) {
                            \App\Models\AgraNotification::create([
                                'user_id' => $user->id,
                                'section_id' => $user->section?->id,
                                'lesson_id' => $lesson->id ?? null, // Handle null lesson ID if necessary
                                'title' => 'Deadline Reminder',
                                'message' => "Deadline Reminder on {$task->TaskName}!",
                                'sender' => 'Agra'
                            ]);
                        }
                        event(new AgraNotificationPusher("Deadline Reminder: Have you done " . $task->TaskName . "?", 'a', $section->id));
                    }
                }
            } catch (\Exception $e) {
                // Log the error with the message and stack trace
                Log::error("Error in scheduled task: " . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
            }
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
