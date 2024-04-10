<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    //
    public function broadcast(Request $request)
    {
        event(new PusherBroadcast($request->code, $request->user));
    }
}
