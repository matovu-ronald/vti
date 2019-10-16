<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServiceProviderCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userData;
    public $password;
    public $bioProfile;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userData, $password, $bioProfile)
    {
        $this->userData = $userData;
        $this->password = $password;
        $this->bioProfile = $bioProfile;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
