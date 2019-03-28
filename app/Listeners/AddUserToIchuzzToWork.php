<?php

namespace App\Listeners;

use App\Events\ServiceProviderCreated;
use App\Models\RoleModel;
use Illuminate\Support\Facades\DB;

class AddUserToIchuzzToWork
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
     * @param  ServiceProviderCreated $event
     * @return void
     */
    public function handle(ServiceProviderCreated $event)
    {
        $user = (new \App\User([
            'name' => $event->userData['name'],
            'email' => $event->userData['email'],
            'email_verified_at' => $event->userData['email_verified_at'],
            'password' => $event->userData['password'],
            'vti_id' => $event->userData['vti_id'],
        ]))->setConnection('mysql2');

        $user->save();

        $this->assigUserRole($user);

        $this->saveBioProfile($user, $event->bioProfile);
        $this->saveToProviderMap($user);
    }

    private function saveBioProfile($user, $bioProfile)
    {
        (new \App\Models\BioProfile([
            'user_id' => $user->id,
            'profile_pic' => config('vti.profile_pic'),
            'phone_number' => $bioProfile['phone'],
            'address' => $bioProfile['address'],
        ]))
            ->setConnection('mysql2')
            ->save();
    }

    private function saveToProviderMap($user)
    {
        //$services = DB::connection('mysql2')->select('select * from services');

        //foreach($services as $service) {

        //\Log::info($user->id);

        (new \App\Models\Service([
            'user_id' => $user->id,
            'service_id' => 32,
            'isVerified' => 1,
            'isAvailable' => 1,
        ]))
            ->setConnection('mysql2')
            ->save();
        //}
    }

    private function assigUserRole($user)
    {
        $roles = DB::connection('mysql2')->select('select * from roles');
        foreach ($roles as $role) {
            if ($role->name == 'public') {
                (new RoleModel([
                    'role_id' => $role->id,
                        'model_type' => 'App\User',
                        'model_id' => $user->id,
                    ]))
                    ->setConnection('mysql2')
                    ->save();
            }

            if ($role->name == 'provider') {
                (new RoleModel([
                    'role_id' => $role->id,
                    'model_type' => 'App\User',
                    'model_id' => $user->id,
                ]))
                    ->setConnection('mysql2')
                    ->save();
            }
        }
    }
}
