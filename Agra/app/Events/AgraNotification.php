<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AgraNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public string $username;
    /**
     * Create a new event instance.
     */
    public function __construct(string $message, string $username)
    {
        $this->message = $message;
        $this->username = $username;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('private.notif.' . auth()->user()->section->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'agra-notif';
    }

    public function broadcastWith(): array
    {
        return[
            'message' => $this->message,
            'username' => $this->username
        ];
    }
}
