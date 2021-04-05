<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Currencies;

class CurrencyUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * The currencies instance.
     *
     * @var \App\Models\Currencies
     */
    public $currency;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Currencies $currency)
    {
        $this->currency = $currency;
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
