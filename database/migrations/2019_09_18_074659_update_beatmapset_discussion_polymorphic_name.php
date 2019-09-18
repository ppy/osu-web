<?php

use Illuminate\Database\Migrations\Migration;

class UpdateBeatmapsetDiscussionPolymorphicName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('osu_kudos_exchange')
            ->where('kudosuable_type', '=', App\Models\BeatmapDiscussion::class)
            ->update(['kudosuable_type' => 'beatmapset_discussion']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('osu_kudos_exchange')
            ->where('kudosuable_type', '=', 'beatmapset_discussion')
            ->update(['kudosuable_type' => App\Models\BeatmapDiscussion::class]);
    }
}
