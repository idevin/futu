<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollectionNameToMediaLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_libraries', function (Blueprint $table) {
            if (!Schema::hasColumn('media_libraries', 'collection_name')) {
                $table->string('collection_name')->nullable(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_libraries', function (Blueprint $table) {
            if (Schema::hasColumn('media_libraries', 'collection_name')) {
                $table->string('collection_name')->nullable(false);
            }
        });
    }
}
