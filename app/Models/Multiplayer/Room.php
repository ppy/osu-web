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

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Validator;

class Room extends \App\Models\Model
{
    use SoftDeletes;

    protected $table = 'multiplayer_rooms';
    protected $dates = ['starts_at', 'ends_at'];

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

    public function scopeStartedBy($query, \App\Models\User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function topScores()
    {
        $scores = $this->scores()
            ->with('user.country')
            ->get();

        $processed = [];
        $stats = [];

        foreach ($scores as $score) {
            if (!isset($stats[$score->user_id]['attempts'])) {
                $stats[$score->user_id]['attempts'] = 0;
            }

            $stats[$score->user_id]['attempts']++;

            if (!$score->isCompleted() || $score->passed == 0 || isset($processed[$score->user_id][$score->playlist_item_id])) {
                continue;
            }

            $processed[$score->user_id][$score->playlist_item_id] = true;
            foreach (['total_score', 'accuracy', 'pp'] as $key) {
                $stats[$score->user_id][$key] = isset($stats[$score->user_id][$key]) ? $stats[$score->user_id][$key] + $score->$key : $score->$key;
            }

            $stats[$score->user_id]['completed'] = count($processed[$score->user_id]);
            $stats[$score->user_id]['room_id'] = $score->room_id;
            $stats[$score->user_id]['user_id'] = $score->user_id;
            $stats[$score->user_id]['user'] = json_item($score->user, 'UserCompact', ['country']);
        }

        foreach ($stats as $userId => $stat) {
            $stats[$userId]['accuracy'] = $stat['accuracy'] / $stat['completed'];
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
