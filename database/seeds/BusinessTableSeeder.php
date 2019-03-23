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

        //Businesses
        $businesses = factory(App\Models\Business::class, 10)->create();

        //Vocational Training Institutes
        $vtis = $businesses->each(function ($business) {
            factory('App\Models\Vti', 15)->create(['business_id' => $business->id]);
        });

        //Courses
        $vtis->each(function ($vti) {
            factory('App\Models\Course', 50)->create(['vti_id' => $vti->id]);
        });
    }
}
