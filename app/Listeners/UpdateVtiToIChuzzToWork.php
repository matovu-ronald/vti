<?php

namespace App\Listeners;

use App\Events\VtiUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateVtiToIChuzzToWork
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
     * @param  VtiUpdated  $event
     * @return void
     */
    public function handle(VtiUpdated $event)
    {

    }
}
