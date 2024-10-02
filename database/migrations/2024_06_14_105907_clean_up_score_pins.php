<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE score_pins DROP id, DROP score_type, DROP new_score_id');
        DB::statement('ALTER TABLE score_pins ADD PRIMARY KEY (score_id)');
        DB::statement('DROP INDEX score_id ON score_pins');
        DB::statement('DROP INDEX score_pins_user_id_score_type_score_id_unique ON score_pins');
        DB::statement('DROP INDEX score_pins_user_id_new_score_id_index ON score_pins');
        DB::statement('CREATE INDEX user_id ON score_pins (user_id)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE score_pins DROP PRIMARY KEY');
        DB::statement("ALTER TABLE score_pins ADD score_type enum('score_best_fruits','score_best_mania','score_best_osu','score_best_taiko','solo_score') DEFAULT NULL AFTER user_id");
        DB::statement('ALTER TABLE score_pins ADD new_score_id bigint unsigned DEFAULT NULL AFTER score_id');
        DB::statement('ALTER TABLE score_pins ADD id bigint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT FIRST');
        DB::statement('CREATE UNIQUE INDEX score_id ON score_pins (score_id)');
        DB::statement('CREATE UNIQUE INDEX score_pins_user_id_score_type_score_id_unique ON score_pins (user_id, score_type, score_id)');
        DB::statement('CREATE INDEX score_type ON score_pins (score_type)');
        DB::statement('CREATE INDEX score_pins_user_id_new_score_id_index ON score_pins (user_id, new_score_id)');
        DB::statement('DROP INDEX user_id ON score_pins');
    }
};
