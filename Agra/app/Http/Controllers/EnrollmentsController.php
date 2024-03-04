<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class EnrollmentsController extends Controller
{
    //
    public function create() {
        return "hello world";
    }

    public function store(Request $request){
        $enrollment = new Enrollment();
        $enrollment->user_id = $request->userid;
        $enrollment->course_id = $request->courseid;

        $enrollment->save();
        return redirect('/courses');
    }
}
