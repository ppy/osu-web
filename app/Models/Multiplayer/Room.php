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

use App\Libraries\Multiplayer\Mod;
use App\Models\Chat\Channel;
use App\Models\Beatmap;
use App\Models\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Room extends Model
{
    use SoftDeletes;

    protected $table = 'multiplayer_rooms';
    protected $dates = ['starts_at', 'ends_at'];

    public function channel()
    {
        return $this->hasOne(Channel::class, 'channel_id', 'channel_id');
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function playlist()
    {
        return $this->hasMany(PlaylistItem::class, 'room_id');
    }

    public function scores()
    {
        return $this->hasMany(RoomScore::class, 'room_id');
    }

    public function scopeActive($query)
    {
        return $query
            ->where('starts_at', '<', Carbon::now())
            ->where('ends_at', '>', Carbon::now());
    }

    public function scopeEnded($query)
    {
        return $query->where('ends_at', '<', Carbon::now());
    }

    public function scopeHasParticipated($query, User $user)
    {
        return $query->whereIn(
            'id',
            // SoftDelete scope is ignored, fixed in 5.8:
            // https://github.com/laravel/framework/pull/26198
            RoomScore::withoutTrashed()->where('user_id', $user->getKey())->select('room_id')
        );
    }

    public function scopeStartedBy($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function completePlay(RoomScore $score, array $params)
    {
        return $score->getConnection()->transaction(function () use ($params, $score) {
            $score->complete($params);
            (new UserScoreAggregate($score->user, $this))->addScore($score);

            return $score;
        });
    }

    public function startGame(User $owner, array $params)
    {
        if (static::active()->startedBy($owner)->exists()) {
            abort(403, 'number of simultaneously active rooms reached');
        }

        if (array_key_exists('starts_at', $params)) {
            $startTime = Carbon::parse($params['starts_at']);
        } else {
            $startTime = Carbon::now();
        }

        if (array_key_exists('ends_at', $params)) {
            $endTime = Carbon::parse($params['ends_at']);

            if ($endTime->isBefore($startTime)) {
                abort(422, "'ends_at' cannot be before 'starts_at'");
            }
        } elseif (array_key_exists('duration', $params)) {
            $endTime = $startTime->copy()->addMinutes($params['duration']);
        } else {
            abort(422, "field 'duration' or 'ends_at' required");
        }

        $maxAttempts = get_int($params['max_attempts'] ?? null);
        if ($maxAttempts !== null) {
            if ($maxAttempts < 1 || $maxAttempts > 32) {
                abort(422, "field 'max_attempts' must be between 1 and 32");
            }
        }

        $playlistParams = $params['playlist'] ?? [];
        if (!is_array($playlistParams)) {
            abort(422, "field 'playlist' must an an array");
        }

        $playlistBeatmaps = array_map(function ($item) {
            if (isset($item['beatmap_id'])) {
                return $item['beatmap_id'];
            } else {
                abort(422, "playlist item missing field 'beatmap_id'");
            }
        }, $playlistParams);

        $beatmaps = Beatmap::whereIn('beatmap_id', $playlistBeatmaps)->get();

        $playlistItems = [];
        foreach ($playlistParams as $item) {
            foreach (['beatmap_id', 'ruleset_id'] as $field) {
                if (!present($item[$field] ?? null)) {
                    abort(422, "playlist item missing field '{$field}'");
                }
            }

            if (!$beatmaps->where('beatmap_id', $item['beatmap_id'])->first()) {
                abort(422, "beatmap not found: {$item['beatmap_id']}");
            }

            $allowedMods = Mod::parseInputArray(
                $item['allowed_mods'] ?? [],
                $item['ruleset_id']
            );

            $requiredMods = Mod::parseInputArray(
                $item['required_mods'] ?? [],
                $item['ruleset_id']
            );

            $playlistItems[] = new PlaylistItem([
                'beatmap_id' => $item['beatmap_id'],
                'ruleset_id' => $item['ruleset_id'],
                'allowed_mods' => $allowedMods,
                'required_mods' => $requiredMods,
            ]);
        }

        $roomOptions = [
            'name' => $params['name'],
            'user_id' => $owner->getKey(),
            'starts_at' => $startTime,
            'ends_at' => $endTime,
            'max_attempts' => presence($maxAttempts),
        ];


        $this->getConnection()->transaction(function () use ($owner, $roomOptions, $playlistItems) {
            $this->fill($roomOptions);
            $this->assertValidStartGame();
            $this->save();

            foreach ($playlistItems as $playlistItem) {
                $playlistItem->room()->associate($this);
                $playlistItem->save();
            }

            // create the chat channel for the room
            // $channel = new Channel();
            // $channel->name = "#lazermp_{$room->id}";
            // $channel->type = Channel::TYPES['multiplayer'];
            // $channel->description = $roomOptions['name'];
            // $channel->save();

            // $room->update(['channel_id' => $channel->channel_id]);
            // $channel->addUser($owner);
        });

        return $this;
    }

    private function assertValidStartGame()
    {
        foreach (['name', 'starts_at', 'ends_at'] as $field) {
            if (empty($this->$field)) {
                abort(422, "'{$field}' is required");
            }
        }
    }

    public function startPlay(User $user, PlaylistItem $playlistItem, array $params)
    {
        return RoomScore::start([
            'user_id' => $user->getKey(),
            'room_id' => $this->getKey(),
            'playlist_item_id' => $playlistItem->getKey(),
            'beatmap_id' => $playlistItem->beatmap_id,
        ]);
    }

    public function topScores()
    {
        $users = User::whereIn('user_id', RoomScore::where('room_id', $this->getKey())->select('user_id'))
            ->with('country')
            ->get();

        $stats = [];

        foreach ($users as $user) {
            if ($user === null || $user->isRestricted()) {
                continue;
            }

            $agg = new UserScoreAggregate($user, $this);
            $userStats = $agg->toArray();

            if ($userStats !== null) {
                $stats[$user->getKey()] = $userStats;
            }
        }

        // todo: add priority for scores set first in case of a tie (this requires quite a bit more effort/restructure)
        usort($stats, function ($a, $b) {
            // if ($a['total_score'] === $b['total_score']) {
            //     if ($a['ended_at']['timestamp'] === $b['ended_at']['timestamp']) {
            //         // On the rare chance that both were submitted in the same second, default to submission order
            //         return ($a->id < $b->id) ? -1 : 1;
            //     }

            //     return ($a['ended_at']['timestamp'] < $b['ended_at']['timestamp']) ? -1 : 1;
            // }

            return ($a['total_score'] > $b['total_score']) ? -1 : 1;
        });

        // return array_values(array_slice($stats, 0, $limit));

        return array_values($stats);
    }
}
