<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE osu_user_reports CHANGE reason reason ENUM(
            'Insults',
            'Spam',
            'Cheating',
            'UnwantedContent',
            'Nonsense',
            'Other',
            'MultipleAccounts',
            'InappropriateChat'
        )");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE osu_user_reports CHANGE reason reason ENUM(
            'Insults',
            'Spam',
            'Cheating',
            'UnwantedContent',
            'Nonsense',
            'Other',
            'MultipleAccounts'
        )");
    }
};
