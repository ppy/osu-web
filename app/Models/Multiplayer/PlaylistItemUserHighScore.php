<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Models\Model;
use App\Models\Solo\Score;
use App\Models\Traits\WithDbCursorHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Dumb persistence model for UserScoreAggregate.
 * i.e. should only be modified via UserScoreAggregate.
 *
 * @property float $accuracy
 * @property int $attempts
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property int $playlist_item_id
 * @property int $score_id
 * @property ScoreLink $scoreLink
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

    public static function lookupOrDefault(int $userId, int $playlistItemId): static
    {
        return static::firstOrNew([
            'playlist_item_id' => $playlistItemId,
            'user_id' => $userId,
        ], [
            'accuracy' => 0,
            'total_score' => 0,
        ]);
    }

    public static function new(int $userId, int $playlistItemId): static
    {
        $ret = static::lookupOrDefault($userId, $playlistItemId);

        if (!$ret->exists) {
            $ret->save();
        }

        return $ret;
    }

    public static function scoresAround(ScoreLink $scoreLink): array
    {
        $placeholder = new static([
            'score_id' => $scoreLink->getKey(),
            'total_score' => $scoreLink->score->total_score,
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
                    ->whereHas('scoreLink.score')
                    ->whereHas('user', fn ($userQuery) => $userQuery->default())
                    ->where('playlist_item_id', $scoreLink->playlist_item_id)
                    ->where('user_id', '<>', $scoreLink->user_id),
                'cursorHelper' => $cursorHelper,
            ];
        }

        return $ret;
    }

    public function playlistItem(): BelongsTo
    {
        return $this->belongsTo(PlaylistItem::class);
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class, 'score_id');
    }

    public function scoreLink()
    {
        return $this->belongsTo(ScoreLink::class, 'score_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePassing(Builder $query): Builder
    {
        return $query->where('total_score', '>', 0);
    }

    public function updateUserAttempts()
    {
        $this->incrementInstance('attempts');
    }

    public function updateWithScoreLink(ScoreLink $scoreLink): bool
    {
        $score = $scoreLink->score;

        if ($score === null || $score->total_score <= $this->total_score) {
            return false;
        }

        if (!$score->passed && !$scoreLink->playlistItem->room->isRealtime()) {
            return false;
        }

        return $this->fill([
            'accuracy' => $score->accuracy,
            'score_id' => $score->getKey(),
            'total_score' => $score->total_score,
        ])->save();
    }
}
