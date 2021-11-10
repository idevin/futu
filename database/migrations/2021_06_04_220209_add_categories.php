<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddCategories extends Migration
{
    use Vicklr\MaterializedModel\Traits\HasMaterializedPaths;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->materializedFields('parent_id', 'path', 'depth', 'id');
            $table->materializedOrdering('weight');
            $table->json('title')->nullable();
            $table->json('slug')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->json('meta_description')->nullable();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->bigInteger('category_id')->nullable()->unsigned()->after('author_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });

        $locales = array_keys(config('locales'));

        $titles = [];
        $slugs = [];
        $metas = [];

        foreach ($locales as $locale) {
            $titles[$locale] = __('main.Contents', [], $locale);
            $slugs[$locale] = Str::slug(__('main.Contents', [], $locale), '-', $locale);
            $metas[$locale] = __('main.Contents', [], $locale);
        }

        $category = Category::query()->firstOrCreate([
            'title' => $titles, 'slug' => $slugs, 'meta_title' => $metas, 'meta_keywords' => $metas,
            'meta_description' => $metas
        ]);

        $posts = Post::all();
        foreach ($posts as $post) {
            $post->update(['category_id' => $category->id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_category_id_foreign');
            $table->dropColumn('category_id');
        });
        Schema::drop('categories');
    }
}
