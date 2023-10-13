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
 * @property int $score_link_id
 * @property ScoreLink $scoreLink
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 */
class PlaylistItemUserHighScore extends Model
{
    use WithDbCursorHelper;

    const SORTS = [
        'score_desc' => [
            ['column' => 'total_score', 'order' => 'DESC'],
            ['column' => 'score_link_id', 'order' => 'ASC'],
        ],
        'score_asc' => [
            ['column' => 'total_score', 'order' => 'ASC'],
            ['column' => 'score_link_id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'score_desc';

    protected $table = 'multiplayer_scores_high';

    public static function lookupOrDefault(ScoreLink $scoreLink): static
    {
        return static::firstOrNew([
            'playlist_item_id' => $scoreLink->playlist_item_id,
            'user_id' => $scoreLink->user_id,
        ], [
            'accuracy' => 0,
            'pp' => 0,
            'total_score' => 0,
        ]);
    }

    public static function scoresAround(ScoreLink $scoreLink): array
    {
        $placeholder = new static([
            'score_link_id' => $scoreLink->getKey(),
            'total_score' => $scoreLink->data->totalScore,
        ]);

        static $typeOptions = [
            'higher' => 'score_asc',
            'lower' => 'score_desc',
        ];

        $ret = [];

        foreach ($typeOptions as $type => $sortName) {
            $cursorHelper = static::makeDbCursorHelper($sortName);

            $ret[$type] = [
                'query' => static
                    ::cursorSort($cursorHelper, $placeholder)
                    ->whereHas('scoreLink')
                    ->where('playlist_item_id', $scoreLink->playlist_item_id)
                    ->where('user_id', '<>', $scoreLink->user_id),
                'cursorHelper' => $cursorHelper,
            ];
        }

        return $ret;
    }

    public function scoreLink()
    {
        return $this->belongsTo(ScoreLink::class);
    }

    public function updateWithScoreLink(ScoreLink $scoreLink): void
    {
        $score = $scoreLink->score;

        $this->fill([
            'accuracy' => $score->data->accuracy,
            'pp' => $score->pp,
            'score_id' => $score->getKey(),
            'score_link_id' => $scoreLink->getKey(),
            'total_score' => $score->data->totalScore,
        ])->save();
    }
}
