<?php

namespace App\Listeners;

use App\Events\VtiCreated;
use App\Models\Vti;

class SaveVtiToIChuzzToWork
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
     * @param  VtiCreated  $event
     * @return void
     */
    public function handle(VtiCreated $event)
    {
        $vtiData = new Vti;

        $vtiData->setConnection('mysql2');

        $vtiData->name = $event->vti->name;
        $vtiData->logo = $event->vti->logo;
        $vtiData->location = $event->vti->location;
        $vtiData->about = $event->vti->about;

        $vtiData->save();
    }
}
