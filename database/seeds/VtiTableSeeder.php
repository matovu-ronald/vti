<?php

use Illuminate\Database\Seeder;
// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class VtiTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        // Vtis
        $vtis = factory(App\Models\Vti::class, 15)->create();

        // Courses
        $vtis->each(function ($vti) {
            factory('App\Models\Course', 40)->create(['vti_id' => $vti->id]);
        });
    }
}
