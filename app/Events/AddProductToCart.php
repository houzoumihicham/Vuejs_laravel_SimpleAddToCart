<?php

namespace App\Events;

use App\carte;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddProductToCart implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;


    public $carte;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(carte $carte)
    {
        $this->carte=$carte;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('carte.'.$this->carte->user_id);
    }
}
