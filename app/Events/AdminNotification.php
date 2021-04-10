<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
      public $title;
      public $messages;
      public $reciver_id;
      public $image;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($title,$messages,$reciver_id,$image)
    {
        $this->title=$title;
        $this->messages=$messages;
        $this->reciver_id=$reciver_id;
        $this->image=$image;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['admin-channel'];
    }

    public function broadcastAs()
  {
      return 'admin-channel';
  }
}
