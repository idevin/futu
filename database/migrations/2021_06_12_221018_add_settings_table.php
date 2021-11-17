<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('show_author')->default(1);
            $table->boolean('show_date')->default(1);
            $table->boolean('allow_comments')->default(1);
            $table->boolean('show_comments_count')->default(1);
            $table->boolean('show_likes_count')->default(1);
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('show_author')->default(1);
            $table->boolean('show_date')->default(1);
            $table->boolean('allow_comments')->default(1);
            $table->boolean('show_comments_count')->default(1);
            $table->boolean('show_likes_count')->default(1);
        });

        Setting::firstOrCreate([
            'show_author' => 1,
            'show_date' => 1,
            'allow_comments' => 1,
            'show_comments_count' => 1,
            'show_likes_count' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('show_author');
            $table->dropColumn('show_date');
            $table->dropColumn('allow_comments');
        });
    }
}
