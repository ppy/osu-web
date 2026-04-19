<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matchmaking_user_elo_history', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('room_id')->unsigned();
            $table->integer('pool_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('opponent_id')->unsigned();

            $table->enum('result', ['win', 'loss', 'draw']);

            $table->integer('elo_before');
            $table->integer('elo_after');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matchmaking_user_elo_history');
    }
};
