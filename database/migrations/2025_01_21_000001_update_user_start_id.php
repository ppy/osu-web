<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE phpbb_users AUTO_INCREMENT=2');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE phpbb_users AUTO_INCREMENT=1');
    }
};
