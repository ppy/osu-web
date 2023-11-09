<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private const ALIASES = [
        'multiplayer_score_links' => 'multiplayer_playlist_item_scores',
        'solo_score_tokens' => 'score_tokens',
        'solo_scores' => 'scores',
        'solo_scores_legacy_id_map' => 'score_legacy_id_map',
        'solo_scores_performance' => 'score_performance',
        'solo_scores_process_history' => 'score_process_history',
    ];

    public function up(): void
    {
        foreach (static::ALIASES as $current => $alias) {
            DB::statement("CREATE VIEW {$alias} AS SELECT * FROM {$current}");
        }
    }

    public function down(): void
    {
        foreach (static::ALIASES as $alias) {
            DB::statement("DROP VIEW {$alias}");
        }
    }
};
