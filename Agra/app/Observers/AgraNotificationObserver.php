<?php

namespace App\Observers;

use App\Events\AgraNotificationPusher;
use App\Models\AgraNotification;

class AgraNotificationObserver
{
    /**
     * Handle the AgraNotificationPusher "created" event.
     */
    public function created(AgraNotification $agraNotification): void
    {
        // Ensure that $agraNotification is not null and has a title
    }

    /**
     * Handle the AgraNotificationPusher "updated" event.
     */
    public function updated(AgraNotification $agraNotification): void
    {
        //
    }

    /**
     * Handle the AgraNotificationPusher "deleted" event.
     */
    public function deleted(AgraNotification $agraNotification): void
    {
        //
    }

    /**
     * Handle the AgraNotificationPusher "restored" event.
     */
    public function restored(AgraNotification $agraNotification): void
    {
        //
    }

    /**
     * Handle the AgraNotificationPusher "force deleted" event.
     */
    public function forceDeleted(AgraNotification $agraNotification): void
    {
        //
    }
}
