<?php

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventController implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;

    public $message;
    public function __construct($username)
    {
        $this->username = $username;
        $this->message  = "{$username} send you Friend Request";
    }

    public function broadcastOn()
    {
        return [''];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
