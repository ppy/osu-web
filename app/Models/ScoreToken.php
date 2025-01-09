<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\InvariantException;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Solo\Score;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \App\Models\Beatmap $beatmap
 * @property int $beatmap_id
 * @property \App\Models\Build|null $build
 * @property int|null $build_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int $ruleset_id
 * @property \App\Models\Solo\Score $score
 * @property int $score_id
 * @property \Carbon\Carbon|null $updated_at
 * @property \App\Models\User $user
 * @property int $user_id
 */
class ScoreToken extends Model
{
    public ?string $beatmapHash = null;

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function build()
    {
        return $this->belongsTo(Build::class, 'build_id');
    }

    public function playlistItem(): BelongsTo
    {
        return $this->belongsTo(PlaylistItem::class);
    }

    public function score()
    {
        return $this->belongsTo(Score::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'beatmap_id',
            'build_id',
            'id',
            'playlist_item_id',
            'ruleset_id',
            'score_id',
            'user_id' => $this->getRawAttribute($key),

            'created_at',
            'updated_at' => $this->getTimeFast($key),

            'created_at_json',
            'updated_at_json' => $this->getJsonTimeFast($key),

            'beatmap',
            'build',
            'playlistItem',
            'score',
            'user' => $this->getRelationValue($key),
        };
    }

    public function setBeatmapHashAttribute(?string $value): void
    {
        $this->beatmapHash = $value;
    }

    public function assertValid(): void
    {
        $beatmap = $this->beatmap;
        if ($this->beatmapHash !== $beatmap->checksum) {
            throw new InvariantException(osu_trans('score_tokens.create.beatmap_hash_invalid'));
        }

        $rulesetId = $this->ruleset_id;
        if ($rulesetId === null) {
            throw new InvariantException('missing ruleset_id');
        }
        if (Beatmap::modeStr($rulesetId) === null || !$beatmap->canBeConvertedTo($rulesetId)) {
            throw new InvariantException('invalid ruleset_id');
        }
    }

    public function save(array $options = []): bool
    {
        if (!$this->exists) {
            $this->assertValid();
        }

        return parent::save($options);
    }
}
