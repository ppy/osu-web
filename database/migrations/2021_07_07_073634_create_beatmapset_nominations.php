<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeatmapsetNominations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beatmapset_nominations', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('beatmapset_id');
            $table->unsignedInteger('user_id');
            $table->json('modes')->nullable();
            $table->unsignedInteger('reset_user_id')->nullable();
            $table->boolean('reset')->default(false);
            $table->timestampTz('reset_at')->nullable();
            $table->timestampsTz();
            $table->unsignedBigInteger('event_id')->unique(); // just to prevent dupes when migrating, not sure how useful it'll actually be after.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beatmapset_nominations');
    }
}
