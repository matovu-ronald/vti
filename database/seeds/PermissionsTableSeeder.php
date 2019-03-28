<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'user.view'],
            ['name' => 'user.create'],
            ['name' => 'user.update'],
            ['name' => 'user.delete'],

            ['name' => 'courses.view'],
            ['name' => 'courses.create'],
            ['name' => 'courses.update'],
            ['name' => 'courses.delete'],

            ['name' => 'bio_profiles.view'],
            ['name' => 'bio_profiles.create'],
            ['name' => 'bio_profiles.update'],
            ['name' => 'bio_profiles.delete'],

            ['name' => 'vtis.view'],
            ['name' => 'vtis.create'],
            ['name' => 'vtis.update'],
            ['name' => 'vtis.delete'],

            ['name' => 'skills.view'],
            ['name' => 'skills.create'],
            ['name' => 'skills.update'],
            ['name' => 'skills.delete'],

            ['name' => 'ban_users'],
            ['name' => 'dashboard.data'],
        );

        $insert_data = array();
        $time_stamp = Carbon::now()->toDateTimeString();
        foreach ($data as $d) {
            $d['guard_name'] = 'web';
            $d['created_at'] = $time_stamp;
            $insert_data[] = $d;
        }
        Permission::insert($insert_data);
    }
}
