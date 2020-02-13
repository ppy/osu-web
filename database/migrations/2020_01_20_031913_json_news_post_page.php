<?php

use Illuminate\Database\Migrations\Migration;

class JsonNewsPostPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DBAL (2.10.0) can't migrate to JSON datatype.
        // It only creates TEXT with DC2Type:json as comment.
        DB::statement('ALTER TABLE news_posts MODIFY page JSON');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DBAL (2.10.0) can't migrate from JSON datatype.
        // It explodes at unrecognized JSON datatype.
        DB::statement('ALTER TABLE news_posts MODIFY page TEXT');
    }
}
