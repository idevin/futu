<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentShortToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->json('description')->after('content')->nullable();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('show_comments_count')->default(1);
            $table->boolean('show_likes_count')->default(1);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('show_comments_count')->default(1);
            $table->boolean('show_likes_count')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('show_comments_count');
            $table->dropColumn('show_likes_count');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('show_comments_count');
            $table->dropColumn('show_likes_count');
        });
    }
}
