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
        //\App\Models\User::factory(1)->create();

        \App\Models\User::factory()->state([
            'password' => env('ADMIN_USER_PASSWORD'),
        ])
        ->count(1)
        ->create();

    }
}