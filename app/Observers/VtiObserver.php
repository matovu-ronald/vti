<?php

namespace App\Observers;

use App\Models\Vti;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class VtiObserver
{
    /**
     * Handle the app models vti "created" event.
     *
     * @param  \App\AppModelsVti  $vti
     * @return void
     */
    public function created(Vti $vti)
    {

        /*$vtiData = new Vti;

        $vtiData->setConnection('mysql2');

        $vtiData->name = $vti->name;
        $vtiData->logo = $vti->logo;
        $vtiData->location = $vti->location;
        $vtiData->about = $vti->about;

        $vtiData->save();*/


    }

    /**
     * Handle the app models vti "updated" event.
     *
     * @param  \App\AppModelsVti  $vti
     * @return void
     */
    public function updated(Vti $vti)
    {

    }


}
