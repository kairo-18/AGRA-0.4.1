<?php

namespace App\Http\Controllers;

use App\Events\AgraNotificationPusher;
use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    //
    public function broadcast(Request $request)
    {
        event(new PusherBroadcast($request->code, $request->user));
    }

    public function notifyStudents(Request $request){
        event(new AgraNotificationPusher($request->notif, $request->user));
    }
}
