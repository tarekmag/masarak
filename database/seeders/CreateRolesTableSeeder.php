<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect();

        $roles->push([
            'name' => 'Super Admin',
            'is_super' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $roles->push([
            'name' => 'Admin',
            'is_super' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('roles')->insert($roles->toArray());
    }
}
