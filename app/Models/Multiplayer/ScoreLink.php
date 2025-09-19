<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Model;
use App\Models\ScoreToken;
use App\Models\Solo\Score;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property PlaylistItem $playlistItem
 * @property int $playlist_item_id
 * @property Score $score
 * @property int $score_id
 * @property User $user
 * @property int $user_id
 */
class ScoreLink extends Model
{
    public static function complete(ScoreToken $token, array $params): static
    {
        return \DB::transaction(function () use ($params, $token) {
            // multiplayer scores are always preserved.
            $score = Score::createFromJsonOrExplode([...$params, 'preserve' => true]);

            $playlistItem = $token->playlistItem;
            $requiredMods = array_column($playlistItem->required_mods, 'acronym');
            $mods = array_column($score->data->mods, 'acronym');
            $mods = app('mods')->excludeModsAlwaysValidForSubmission($score->ruleset_id, $mods);

            if (!empty($requiredMods)) {
                if (!empty(array_diff($requiredMods, $mods))) {
                    throw new InvariantException('This play does not include the mods required.');
                }
            }

            if (!$playlistItem->freestyle) {
                $allowedMods = array_column($playlistItem->allowed_mods, 'acronym');
                if (!empty(array_diff($mods, $requiredMods, $allowedMods))) {
                    throw new InvariantException('This play includes mods that are not allowed.');
                }
            }

            $token->score()->associate($score)->saveOrExplode();

            $ret = (new static())
                ->playlistItem()->associate($playlistItem)
                ->score()->associate($score)
                ->user()->associate($token->user);
            $ret->saveOrExplode();

            return $ret;
        });
    }

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'score_id';
    protected $table = 'multiplayer_playlist_item_scores';

    public function playlistItem(): BelongsTo
    {
        return $this->belongsTo(PlaylistItem::class, 'playlist_item_id');
    }

    public function playlistItemUserHighScore(): HasOne
    {
        return $this->hasOne(PlaylistItemUserHighScore::class);
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class, 'score_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'playlist_item_id',
            'score_id',
            'user_id' => $this->getRawAttribute($key),

            'playlistItem',
            'playlistItemUserHighScore',
            'score',
            'user' => $this->getRelationValue($key),
        };
    }

    public function position(): ?int
    {
        $score = $this->score;

        if ($score === null) {
            return null;
        }

        $query = PlaylistItemUserHighScore
            ::where('playlist_item_id', $this->playlist_item_id)
            ->whereHas('user', fn ($userQuery) => $userQuery->default())
            ->cursorSort('score_asc', [
                'total_score' => $score->total_score,
                'score_id' => $this->getKey(),
            ]);

        return 1 + $query->count();
    }
}
