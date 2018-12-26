<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
use App\Libraries\Multiplayer\Mod;
use App\Models\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

class RoomScore extends Model
{
    use SoftDeletes;

    protected $table = 'multiplayer_scores';
    protected $dates = ['started_at', 'ended_at'];
    protected $casts = [
        'passed' => 'boolean',
        'mods' => 'array',
        'statistics' => 'array',
    ];

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

    public static function start(array $params)
    {
        // TODO: move existence checks here?
        $score = new static($params);
        $score->started_at = Carbon::now();

        $score->save();

        return $score;
    }

    public function complete(array $params)
    {
        if ($this->isCompleted()) {
            throw new GameCompletedException('cannot modify score after submission');
        }

        $rulesetId = $this->playlistItem->ruleset_id;

        $mods = Mod::parseInputArray(
            $params['mods'] ?? [],
            $rulesetId
        );

        $this->rank = $params['rank'] ?? null;
        $this->total_score = get_int($params['total_score'] ?? null);
        $this->accuracy = get_float($params['accuracy'] ?? null);
        $this->max_combo = get_int($params['max_combo'] ?? null);
        $this->ended_at = Carbon::now();
        $this->passed = get_bool($params['passed'] ?? null);
        $this->mods = $mods;
        $this->statistics = $params['statistics'] ?? null;

        foreach (['rank', 'total_score', 'accuracy', 'max_combo', 'passed'] as $field) {
            if (!present($this->$field)) {
                throw new InvalidArgumentException("field missing: '{$field}'");
            }
        }

        foreach (['mods', 'statistics'] as $field) {
            if (!is_array($this->$field)) {
                throw new InvalidArgumentException("field must be an array: '{$field}'");
            }
        }

        if (empty($this->statistics)) {
            throw new InvalidArgumentException("field cannot be empty: 'statistics'");
        }

        if (!empty($this->playlistItem->required_mods)) {
            $missingMods = array_diff(
                array_column($this->playlistItem->required_mods, 'acronym'),
                array_column($mods, 'acronym')
            );

            if (!empty($missingMods)) {
                throw new InvalidArgumentException("This play does not include the mods required.");
            };
        }

        if (!empty($this->playlistItem->allowed_mods)) {
            $missingMods = array_diff(
                array_column($mods, 'acronym'),
                array_column($this->playlistItem->allowed_mods, 'acronym')
            );

            if (!empty($missingMods)) {
                throw new InvalidArgumentException("This play includes mods that are not allowed.");
            };
        }

        // todo: also, all the validationsz:
        // - validate statistics json format

        $this->save();
    }
}
