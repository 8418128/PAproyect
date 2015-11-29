<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChEvent implements ShouldBroadcast
{

    /**
     * Create a new event instance.
     *caca
     * @return void
     */
    public $texto;
    public $channel;

    public function __construct($c,$t)
    {
        $this->texto = $t;
        $this->channel = $c;
    }

    public function broadcastOn()
    {
        return [$this->channel];
    }
}
