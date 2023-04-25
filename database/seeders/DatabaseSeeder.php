<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Website::factory(20)->has(Post::factory()->count(5))->create();

        User::factory(10)->hasAttached(Website::all()->random(3), relationship: 'subscriptions')->create();

    }
}
