<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialSettingsToTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('instagram')->nullable()->after('show_likes_count');
            $table->string('facebook')->nullable()->after('show_likes_count');
            $table->string('linkedin')->nullable()->after('show_likes_count');
            $table->string('behance')->nullable()->after('show_likes_count');
            $table->string('twitter')->nullable()->after('show_likes_count');
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
            $table->dropColumn('instagram');
            $table->dropColumn('facebook');
            $table->dropColumn('linkedin');
            $table->dropColumn('behance');
            $table->dropColumn('twitter');
        });
    }
}
