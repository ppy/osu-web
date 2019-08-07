<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastReplyAtToBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussions', function (Blueprint $table) {
            $table->timestamp('last_reply_at')->nullable();
        });

        // use the current updated_at timestamp as last_reply_at's initial value
        DB::statement('UPDATE beatmap_discussions SET last_reply_at = updated_at');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beatmap_discussions', function (Blueprint $table) {
            $table->dropColumn('last_reply_at');
        });
    }
}
