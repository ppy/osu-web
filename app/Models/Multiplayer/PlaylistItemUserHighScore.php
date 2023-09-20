<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Models\Model;
use App\Models\Traits\WithDbCursorHelper;

/**
 * Dumb persistence model for UserScoreAggregate.
 * i.e. should only be modified via UserScoreAggregate.
 *
 * @property float $accuracy
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property int $playlist_item_id
 * @property float|null $pp
 * @property int $score_id
 * @property Score $score
 * @property int $total_score
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 */
class PlaylistItemUserHighScore extends Model
{
    use WithDbCursorHelper;

    const SORTS = [
        'score_desc' => [
            ['column' => 'total_score', 'order' => 'DESC'],
            ['column' => 'score_id', 'order' => 'ASC'],
        ],
        'score_asc' => [
            ['column' => 'total_score', 'order' => 'ASC'],
            ['column' => 'score_id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'score_desc';

    protected $table = 'multiplayer_scores_high';

    public static function lookupOrDefault(Score $score): static
    {
        return static::firstOrNew([
            'playlist_item_id' => $score->playlist_item_id,
            'user_id' => $score->user_id,
        ], [
            'accuracy' => 0,
            'pp' => 0,
            'total_score' => 0,
        ]);
    }

    public function score()
    {
        return $this->belongsTo(Score::class);
    }

    public function updateWithScore(Score $score): void
    {
        $this->fill([
            'accuracy' => $score->accuracy,
            'pp' => $score->pp,
            'score_id' => $score->getKey(),
            'total_score' => $score->total_score,
        ])->save();
    }
}
