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

namespace App\Http\Controllers;

use App\Models\Multiplayer\Match;
use App\Models\User;
use App\Transformers\Multiplayer\EventTransformer;
use App\Transformers\Multiplayer\MatchTransformer;
use App\Transformers\UserCompactTransformer;

class MatchesController extends Controller
{
    protected $section = 'multiplayer';

    public function show($id)
    {
        $match = Match::findOrFail($id);

        priv_check('MatchView', $match)->ensureCan();

        $eventsJson = $this->eventsJson([
            'match' => $match,
            'after' => request('after'),
            'before' => request('before'),
        ]);

        $matchJson = json_item(
            $match,
            new MatchTransformer
        );

        return ext_view('multiplayer.match', compact('matchJson', 'eventsJson'));
    }

    public function history($matchId)
    {
        $match = Match::findOrFail($matchId);

        priv_check('MatchView', $match)->ensureCan();

        return $this->eventsJson([
            'match' => $match,
            'after' => request('after'),
            'before' => request('before'),
            'limit' => request('limit'),
        ]);
    }

    private function eventsJson($params)
    {
        $match = $params['match'];
        $after = get_int($params['after'] ?? null);
        $before = get_int($params['before'] ?? null);
        $limit = clamp(get_int($params['limit'] ?? null) ?? 100, 1, 101);

        $events = $match->events()
            ->with([
                'game.beatmap.beatmapset',
                'game.scores' => function ($query) {
                    $query->with('game')->default();
                },
            ])->limit($limit);

        if (isset($after)) {
            $events
                ->where('event_id', '>', $after)
                ->orderBy('event_id', 'ASC');
        } else {
            if (isset($before)) {
                $events->where('event_id', '<', $before);
            }

            $events->orderBy('event_id', 'DESC');
            $reverseOrder = true;
        }

        $events = $events->get();

        if ($reverseOrder ?? false) {
            $events = $events->reverse();
        }

        $users = User::with('country')->whereIn('user_id', $this->usersFromEvents($events))->get();

        $users = json_collection(
            $users,
            new UserCompactTransformer,
            'country'
        );

        $events = json_collection(
            $events,
            new EventTransformer,
            ['game.beatmap.beatmapset', 'game.scores.multiplayer']
        );

        return [
            'events' => $events,
            'users' => $users,
            'latest_event_id' => $match->events()->select('event_id')->last()->getKey(),
            'current_game_id' => optional($match->currentGame())->getKey(),
        ];
    }

    private function usersFromEvents($events)
    {
        $userIds = [];

        foreach ($events as $event) {
            if ($event->user_id) {
                $userIds[] = $event->user_id;
            }

            if ($event->game) {
                foreach ($event->game->scores as $score) {
                    $userIds[] = $score->user_id;
                }
            }
        }

        return array_unique($userIds);
    }
}
