<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsuBeatmappacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('osu_beatmappacks')) {
            return;
        }

        Schema::create('osu_beatmappacks', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->smallInteger('pack_id', true);
            $table->string('url', 1024);
            $table->string('name', 255);
            $table->string('author', 255);
            $table->string('tag', 5)->unique();
            $table->timestamp('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_beatmappacks');
    }
}
