<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Advertisement, Category, Tag, User};
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
        $users = User::factory(5)->create();

        foreach ($users as $user) {
            Advertisement::factory(5)
                ->for($user)
                ->hasTags(3)
                ->create();
        }
    }
}
