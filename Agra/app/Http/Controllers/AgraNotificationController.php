<?php

namespace App\Http\Controllers;

use App\Models\AgraNotification;
use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgraNotificationController extends Controller
{
    //
    public function store(Request $request){

        AgraNotification::whereIn('id', $request->notificationIds)
            ->update(['read_at' => Carbon::now()]); // Set the current timestamp

        return response()->json(['message' => 'Notifications marked as read.']);
    }
}
