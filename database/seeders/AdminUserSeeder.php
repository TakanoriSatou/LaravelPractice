<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('admin_users')->insert([
            'name' => 'owner',
            'email' => 'owner@example.com',
            'password' => \Hash::make('password'),
            'admin_level' => 1,
        ]);
        \DB::table('admin_users')->insert([
            'name' => 'sub',
            'email' => 'sub@example.com',
            'password' => \Hash::make('password'),
            'admin_level' => 0,
        ]);
    }
}
