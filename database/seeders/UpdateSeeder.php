<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class UpdateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Setting::firstOrCreate([
            'show_author' => 1,
            'show_date' => 1,
            'allow_comments' => 1,
            'show_comments_count' => 1,
            'show_likes_count' => 1
        ]);
    }
}
