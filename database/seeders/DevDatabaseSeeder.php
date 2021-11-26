<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Media;
use App\Models\MediaLibrary;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DevDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = Category::all();
        $author = User::query()->first();

        if (count($categories) > 0) {
            $categories->each(function ($category) use ($author) {

                $faker = Factory::create(app()->getLocale());

                Post::factory()
                    ->count(100)
                    ->create([
                        'author_id' => $author->id,
                        'category_id' => $category->id,
                        'title' => [app()->getLocale() => $faker->text(250)],
                        'slug' => Str::slug($faker->text(100), '-', app()->getLocale()),
                        'content' => [app()->getLocale() => $faker->text(1000)],
                        'description' => [app()->getLocale() => $faker->text()],
                        'posted_at' => Carbon::now(),
                        'meta_title' => [app()->getLocale() => $faker->text()],
                        'meta_description' => [app()->getLocale() => $faker->text()],
                        'meta_keywords' => [app()->getLocale() => $faker->text()],
                        'media_library_id' => MediaLibrary::query()->inRandomOrder()->first(),
                        'thumbnail_id' => Media::query()->inRandomOrder()->first(),
                        'year' => $faker->year
                    ]);
            });
        }
    }
}
