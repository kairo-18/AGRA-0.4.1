<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Score;
use App\Models\Task;
use App\Models\TaskScore;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $score = new Score();
        $score->user_id = $request->userid;
        $score->task_id = $request->taskid;
        $score->section_id = $request->sectionid;
        $score->score = $request->score;
        $score->MaxScore = $request->MaxScore;
        $score->Percentage = $request->Percentage;

        $taskStatus = new TaskStatus();

        $user = Auth::user();

        $taskStatus->user_id = $request->userid;
        if($user->section){
            $taskStatus->section_id = $request->sectionid;
        }
        $taskStatus->task_id = $request->taskid;
        $taskStatus->status = $request->TaskStatus;
        $taskStatus->save();

        $score->save();

        $taskScore = new TaskScore();
        $taskScore->user_id = $score->user_id;
        $taskScore->score_id = $score->id;
        $taskScore->task_id = $score->task_id;
        $taskScore->timestamps = false;
        $taskScore->save();

        return redirect('/courses');
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        //
    }
}
