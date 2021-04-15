<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Exceptions\GameCompletedException;
use App\Exceptions\InvariantException;
use App\Libraries\ScoreCheck;
use App\Models\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property float|null $accuracy
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $ended_at
 * @property int $id
 * @property int|null $max_combo
 * @property array|null $mods
 * @property bool|null $passed
 * @property PlaylistItem $playlistItem
 * @property int $playlist_item_id
 * @property float|null $pp
 * @property mixed|null $rank
 * @property Room $room
 * @property int $room_id
 * @property \Carbon\Carbon $started_at
 * @property array|null $statistics
 * @property int|null $total_score
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class Score extends Model
{
    use SoftDeletes;

    protected $table = 'multiplayer_scores';
    protected $dates = ['started_at', 'ended_at'];
    protected $casts = [
        'passed' => 'boolean',
        'mods' => 'object',
        'statistics' => 'array',
    ];

    public static function start(array $params)
    {
        // TODO: move existence checks here?
        $score = new static($params);
        $score->started_at = Carbon::now();

        $score->save();

        return $score;
    }

    public function playlistItem()
    {
        return $this->belongsTo(PlaylistItem::class, 'playlist_item_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('ended_at');
    }

    public function scopeForPlaylistItem($query, $playlistItemId)
    {
        return $query->where('playlist_item_id', $playlistItemId);
    }

    public function isCompleted()
    {
        return present($this->ended_at);
    }

    public function complete(array $params)
    {
        if ($this->isCompleted()) {
            throw new GameCompletedException('cannot modify score after submission');
        }

        $this->fill($params);

        if (!empty($this->playlistItem->required_mods)) {
            $missingMods = array_diff(
                array_column($this->playlistItem->required_mods, 'acronym'),
                array_column($this->mods, 'acronym')
            );

            if (!empty($missingMods)) {
                throw new InvariantException('This play does not include the mods required.');
            }
        }

        if (!empty($this->playlistItem->allowed_mods)) {
            $missingMods = array_diff(
                array_column($this->mods, 'acronym'),
                array_column($this->playlistItem->required_mods, 'acronym'),
                array_column($this->playlistItem->allowed_mods, 'acronym')
            );

            if (!empty($missingMods)) {
                throw new InvariantException('This play includes mods that are not allowed.');
            }
        }

        ScoreCheck::assertCompleted($this);

        $this->save();
    }

    public function userRank()
    {
        if ($this->total_score === null || $this->getKey() === null) {
            return;
        }

        $query = PlaylistItemUserHighScore
            ::where('playlist_item_id', $this->playlist_item_id)
            ->cursorSort('score_asc', [
                'total_score' => $this->total_score,
                'score_id' => $this->getKey(),
            ]);

        return 1 + $query->count();
    }
}
