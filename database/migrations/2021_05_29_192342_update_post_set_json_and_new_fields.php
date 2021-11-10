<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostSetJsonAndNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexesFound = $sm->listTableIndexes('posts');

            if (array_key_exists("posts_title_index", $indexesFound)) {
                $table->dropIndex('posts_title_index');
            }
            if (array_key_exists("posts_slug_unique", $indexesFound)) {
                $table->dropIndex('posts_slug_unique');
            }
        });

        $posts = Post::all();
        foreach ($posts as $post) {
            $post->delete();
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('content')->change();
            $table->json('slug')->change();
        });

        $locales = array_keys(config('locales'));

        $posts = Post::all();

        $updateAttribute = function ($attribute, $post) use ($locales) {
            $o = [];
            foreach ($locales as $locale) {
                $o[$locale] = $post->{$attribute};
            }

            $post->update([
                $attribute => $o
            ]);
        };

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                if ($post->title) {
                    $updateAttribute('title', $post);
                }

                if ($post->content) {
                    $updateAttribute('content', $post);
                }
            }
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
            $table->string('title')->change();
            $table->longText('content')->change();
            $table->string('slug')->unique()->change();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->index('title');
            $table->index('slug');
        });
    }
}


