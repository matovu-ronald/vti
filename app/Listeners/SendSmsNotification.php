<?php

namespace App\Listeners;

use App\Events\ServiceProviderCreated;
use App\Models\Vti;
use App\Utilities\SendSMS;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSmsNotification implements ShouldQueue
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
     * @param  ServiceProviderCreated  $event
     * @return void
     */
    public function handle(ServiceProviderCreated $event)
    {
        //$institution = Vti::where(id, $event->userData->vti_id)->first()->pluck('name');

        $message = 'Hey ' . $event->userData['name'] . ' You have been registered to 
        ichuzz2work by your institution ' . ' Your Username is : ' . $event->userData['email'] . ' and Password is : ' . $event->password . ' To Log into you 
        account click this link ' . config('vti.links.login');

        $sendSms = new SendSMS(config('vti.ata.username'),config('vti.ata.api'));
        $sendSms->sendSms($event->bioProfile['phone'], $message);
    }
}
