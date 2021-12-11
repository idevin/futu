<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('show_likes_count');
            $table->string('meta_keywords')->nullable()->after('show_likes_count');
            $table->string('meta_description')->nullable()->after('show_likes_count');
            $table->longText('content')->nullable()->after('show_likes_count');
            $table->string('phone')->nullable()->after('show_likes_count');
            $table->string('email')->nullable()->after('show_likes_count');
            $table->string('google_tag')->nullable()->after('show_likes_count');
            $table->string('google_analytics')->nullable()->after('show_likes_count');
            $table->string('google_map')->nullable()->after('show_likes_count');
            $table->string('address')->nullable()->after('show_likes_count');
            $table->string('title')->nullable()->after('show_likes_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_keywords');
            $table->dropColumn('meta_description');
            $table->dropColumn('content');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('google_tag');
            $table->dropColumn('google_analytics');
            $table->dropColumn('address');
            $table->dropColumn('google_map');
        });
    }
}
