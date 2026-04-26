<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AntrianUpdated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $antrian;

    public function __construct($antrian)
    {
        $this->antrian = $antrian;
    }

    public function broadcastOn()
    {
        return new Channel('antrian-channel');
    }

    public function broadcastAs()
    {
        return 'antrian.updated';
    }
}