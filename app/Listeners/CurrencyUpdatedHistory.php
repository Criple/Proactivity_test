<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CurrencyUpdated;

class CurrencyUpdatedHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CurrencyUpdated $event)
    {
        $event->currency->history()->create([
            'currency_id' => $event->currency->id,
            'rate' => $event->currency->getOriginal('rate'),
        ]);
    }
}
