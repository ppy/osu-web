<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('DROP VIEW scores');
        DB::statement('ALTER TABLE solo_scores RENAME TO scores');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE scores RENAME TO solo_scores');
        DB::statement('CREATE VIEW scores AS SELECT * from solo_scores');
    }
};
