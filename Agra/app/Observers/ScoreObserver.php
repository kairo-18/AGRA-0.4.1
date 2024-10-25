<?php

namespace App\Observers;

use App\Events\AgraNotification;
use App\Models\Score;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ScoreObserver
{
    /**
     * Handle the Score "created" event.
     */
    public function created(Score $score): void
    {
        //


        $users = User::where('section_id', $score->user->section->id)->get();

        foreach ($users as $user) {
            $isCurrentUser = $user->id === $score->user->id;

            \App\Models\AgraNotification::create([
                'user_id' => $user->id,
                'section_id' => $score->user->section->id,
                'lesson_id' => $score->task->lesson->id,
                'title' => 'New Score',
                'message' => $isCurrentUser
                    ? "You scored {$score->score} on {$score->task->TaskName}!"
                    : "One of your classmate scored {$score->score} on {$score->task->TaskName}!",
                'sender' => 'Agra'
            ]);

        }

        event(new AgraNotification("scored {$score->score} on {$score->task->TaskName}!", $score->user->name));


    }

    /**
     * Handle the Score "updated" event.
     */
    public function updated(Score $score): void
    {
        //
    }

    /**
     * Handle the Score "deleted" event.
     */
    public function deleted(Score $score): void
    {
        //
    }

    /**
     * Handle the Score "restored" event.
     */
    public function restored(Score $score): void
    {
        //
    }

    /**
     * Handle the Score "force deleted" event.
     */
    public function forceDeleted(Score $score): void
    {
        //
    }
}
