<?php

use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = factory(App\Models\Business::class, 10)->create();
        $businesses->each(function ($business) {
            factory('App\Models\Vti', 15)->create(['business_id' => $business->id]);
        });
    }
}
