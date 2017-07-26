<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsuBeatmappacksItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('osu_beatmappacks_items')) {
            return;
        }

        Schema::create('osu_beatmappacks_items', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->unsignedMediumInteger('item_id', true);
            $table->unsignedSmallInteger('pack_id');
            $table->unsignedMediumInteger('beatmapset_id');

            $table->index(['pack_id', 'beatmapset_id']);
            $table->index('beatmapset_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_beatmappacks_items');
    }
}
