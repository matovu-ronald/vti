<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * The settings to add.
     */
    protected $settings = [
        [
            'key'         => 'contact_email',
            'name'        => 'Contact form email address',
            'description' => 'The email address that all emails from the contact form will go to.',
            'value'       => 'admin@updivision.com',
            'field'       => '{"name":"value","label":"Value","type":"email"}',
            'active'      => 1,
        ],
        [
            'key'           => 'contact_cc',
            'name'          => 'Contact form CC field',
            'description'   => 'Email addresses separated by comma, to be included as CC in the email sent by the contact form.',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,

        ],
        [
            'key'           => 'contact_bcc',
            'name'          => 'Contact form BCC field',
            'description'   => 'Email addresses separated by comma, to be included as BCC in the email sent by the contact form.',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"email"}',
            'active'        => 1,
        ],
        [
            'key'         => 'motto',
            'name'        => 'Motto',
            'description' => 'Website motto',
            'value'       => 'this is the value',
            'field'       => '{"name":"value","label":"Value","type":"textarea"}',
            'active'      => 1,

        ],
        [
            'key'         => 'show_powered_by',
            'name'        => 'Showed Powered By',
            'description' => 'Whether to show the powered by Backpack on the bottom right corner or not',
            'value'       => 1,
            'field'       => '{"name":"value","label":"Value","type":"checkbox"}',
            'active'      => 1,

        ],
        [
            'key'         => 'skin',
            'name'        => 'Skin',
            'description' => 'Backpack admin panel skin settings.',
            'value'       => 'skin-purple-light',
            'field'       => '{"name":"value","label":"Value","type":"select2_from_array","options":{"skin-black":"Black","skin-blue":"Blue", "skin-purple":"Purple","skin-red":"Red","skin-yellow":"Yellow","skin-green":"Green","skin-blue-light":"Blue light", "skin-black-light":"Black light","skin-purple-light":"Purple light","skin-green-light":"Green light","skin-red-light":"Red light", "skin-yellow-light":"Yellow light"},"allows_null":false,"default":"skin-purple"}',
            'active'      => 1,

        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = DB::table('settings')->insert($setting);

            if (! $result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted '.count($this->settings).' records.');
    }
}
