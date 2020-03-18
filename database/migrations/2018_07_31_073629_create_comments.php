<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedMediumInteger('user_id')->nullable();

            $table->text('message');

            $table->enum('commentable_type', ['beatmapset', 'build', 'news_post'])->nullable();
            $table->unsignedBigInteger('commentable_id')->nullable();

            $table->unsignedBigInteger('replies_count_cache')->default(0);

            $table->unsignedBigInteger('disqus_id')->nullable();
            $table->unsignedBigInteger('disqus_parent_id')->nullable();
            $table->string('disqus_thread_id')->nullable();
            $table->text('disqus_user_data')->nullable();

            $table->timestampTz('edited_at')->nullable();
            $table->unsignedMediumInteger('edited_by_id')->nullable();

            $table->timestampTz('deleted_at')->nullable();
            $table->unsignedMediumInteger('deleted_by_id')->nullable();

            $table->timestampsTz();

            $table->index(['commentable_type', 'commentable_id']);
            $table->index('parent_id');
            $table->unique('disqus_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
