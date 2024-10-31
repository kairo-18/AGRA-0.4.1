<?php

namespace App\Jobs;

use App\Events\AgraNotificationPusher;
use App\Models\AgraNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BroadcastNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $notification;

    public function __construct(AgraNotification $notification)
    {
        $this->notification = $notification;
    }

    public function handle()
    {

    }
}
