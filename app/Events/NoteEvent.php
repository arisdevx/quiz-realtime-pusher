<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Models
use App\Models\User;

class NoteEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $key;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $key)
    {
        $this->user = $user;
        $this->key = $key;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('note.1');
        // return new Channel('note');
    }

    public function broadcastAs()
    {
        return 'NoteEvent';
    }

    public function broadcastWith()
    {
        return [
            'key' => $this->key
        ];
    }
}
