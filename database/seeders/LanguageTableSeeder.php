<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language[] = [
            'name' => 'English',
            'symbol' => 'en',
            'direction' => 'ltr',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $language[] = [
            'name' => 'عربى',
            'symbol' => 'ar',
            'direction' => 'rtl',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('languages')->insert($language);
    }
}
