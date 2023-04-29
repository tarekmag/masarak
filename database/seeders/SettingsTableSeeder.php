<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use ATPGroup\Settings\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        $settings[] = [
            'setting_key' => 'contact_us_email',
            'setting_value' => '',
            'setting_form_type' => 'input',
            'setting_type' => 'text',
        ];

        $settings[] = [
            'setting_key' => 'google_play_link',
            'setting_value' => '',
            'setting_form_type' => 'input',
            'setting_type' => 'text',
        ];

        $settings[] = [
            'setting_key' => 'apple_store_link',
            'setting_value' => '',
            'setting_form_type' => 'input',
            'setting_type' => 'text',
        ];

        $settings[] = [
            'setting_key' => 'arrival_station_radius',
            'setting_value' => 200,
            'setting_form_type' => 'input',
            'setting_type' => 'number',
        ];

        $settings[] = [
            'setting_key' => 'time_to_can_confirm_trip',
            'setting_value' => 5,
            'setting_form_type' => 'input',
            'setting_type' => 'number',
        ];
        
        Setting::insert($settings);
    }
}
