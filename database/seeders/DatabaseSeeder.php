<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(20)->create();
        \App\Models\Car::factory(10)->create();
        \App\Models\Location::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'willivmx',
            'email' => 'jadannouzonon@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
