<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateRolesTableSeeder::class);
        $this->call(CreatePermissionsSeeder::class);
        $this->call(CreateUserTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
