<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Model;
use App\Models\Solo\Score;
use App\Models\Traits\SoloScoreInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $build_id
 * @property PlaylistItem $playlistItem
 * @property int $playlist_item_id
 * @property Score $score
 * @property int $score_id
 * @property User $user
 * @property int $user_id
 */
class ScoreLink extends Model implements SoloScoreInterface
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'score_id';
    protected $table = 'multiplayer_score_links';

    private Score $defaultScore;

    public function playlistItem()
    {
        return $this->belongsTo(PlaylistItem::class, 'playlist_item_id');
    }

    public function playlistItemUserHighScore()
    {
        return $this->hasOne(PlaylistItemUserHighScore::class);
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class, 'score_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'build_id',
            'playlist_item_id',
            'score_id',
            'user_id' => $this->getRawAttribute($key),

            'data' => $this->score->data,
            'has_replay' => $this->score->has_replay ?? false,
            'pp' => $this->score->pp ?? 0.0,

            'beatmap_id' => $this->playlistItem?->beatmap_id,
            'ruleset_id' => $this->playlistItem?->ruleset_id,

            'playlistItem',
            'playlistItemUserHighScore',
            'score',
            'user' => $this->getRelationValue($key),
        };
    }

    public function complete(array $params)
    {
        $this->getConnection()->transaction(function () use ($params) {
            $score = Score::createFromJsonOrExplode($params);
            $mods = $score->data->mods;

            if (!empty($this->playlistItem->required_mods)) {
                $missingMods = array_diff(
                    array_column($this->playlistItem->required_mods, 'acronym'),
                    array_column($mods, 'acronym')
                );

                if (!empty($missingMods)) {
                    throw new InvariantException('This play does not include the mods required.');
                }
            }

            if (!empty($this->playlistItem->allowed_mods)) {
                $missingMods = array_diff(
                    array_column($mods, 'acronym'),
                    array_column($this->playlistItem->required_mods, 'acronym'),
                    array_column($this->playlistItem->allowed_mods, 'acronym')
                );

                if (!empty($missingMods)) {
                    throw new InvariantException('This play includes mods that are not allowed.');
                }
            }

            $this->score()->associate($score);
            $this->save();
        });
    }

    public function position(): ?int
    {
        $score = $this->score;

        if ($score === null) {
            return null;
        }

        $query = PlaylistItemUserHighScore
            ::where('playlist_item_id', $this->playlist_item_id)
            ->cursorSort('score_asc', [
                'total_score' => $score->data->totalScore,
                'score_link_id' => $this->getKey(),
            ]);

        return 1 + $query->count();
    }
}
