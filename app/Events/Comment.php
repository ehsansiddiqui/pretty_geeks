<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Comment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $postId;
    public $username;
    public $action;
    public $comment;
    public $commentId;
    public $userId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username,$postId,$comment, $action,$commentId,$userId)
    {
        $this->postId = $postId;
        $this->username=$username;
        $this->comment=$comment;
        $this->action = $action;
        $this->commentId=$commentId;
        $this->userId=$userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['comment-events'];
    }
}
