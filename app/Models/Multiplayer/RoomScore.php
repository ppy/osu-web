<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models\Multiplayer;

use App\Exceptions\GameCompletedException;
use App\Exceptions\InvariantException;
use App\Libraries\ScoreRank;
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
class RoomScore extends Model
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

        if (!ScoreRank::isValid($this->rank)) {
            throw new InvariantException("'{$this->rank}' is not a valid rank.");
        }

        foreach (['total_score', 'accuracy', 'max_combo', 'passed'] as $field) {
            if (!present($this->$field)) {
                throw new InvariantException("field missing: '{$field}'");
            }
        }

        foreach (['mods', 'statistics'] as $field) {
            if (!is_array($this->$field)) {
                throw new InvariantException("field must be an array: '{$field}'");
            }
        }

        if (empty($this->statistics)) {
            throw new InvariantException("field cannot be empty: 'statistics'");
        }

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
                array_column($this->playlistItem->allowed_mods, 'acronym')
            );

            if (!empty($missingMods)) {
                throw new InvariantException('This play includes mods that are not allowed.');
            }
        }

        // todo: also, all the validationsz:
        // - validate statistics json format

        $this->save();
    }
}
