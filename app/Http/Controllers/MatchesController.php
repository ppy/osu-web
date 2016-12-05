<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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

use App\Models\Country;
use App\Models\Multiplayer\Match;
use App\Models\User;
use App\Transformers\Multiplayer\EventTransformer;
use App\Transformers\Multiplayer\MatchTransformer;
use App\Transformers\UserCompactTransformer;
use Request;

class MatchesController extends Controller
{
    protected $section = 'multiplayer';

    public function show($match_id)
    {
        $match = Match::findOrFail($match_id);

        $match = json_item(
            $match,
            new MatchTransformer
        );

        $full = Request::input('full', false);

        return view('multiplayer.match', compact('match', 'full'));
    }

    public function history($match_id)
    {
        $since = Request::input('since', 0);
        $full = Request::input('full', false) === 'true';

        $match = Match::findOrFail($match_id);

        $events = $match->events()
            ->with([
                'game.beatmap.beatmapset',
                'game.scores' => function ($query) {
                    $query->with('game')->default();
                },
            ])
            ->where('event_id', '>', $since);

        if ($full) {
            $events->default();
        } else {
            $events
                ->orderBy('event_id', 'desc')
                ->take(config('osu.mp-history.event-count'));
        }

        $events = $events->get();

        if (!$full) {
            $events = $events->reverse();
        }

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

        $users = User::with('country')->whereIn('user_id', array_unique($userIds))->get();

        $users = json_collection(
            $users,
            new UserCompactTransformer,
            'country'
        );

        $events = json_collection(
            $events,
            new EventTransformer,
            ['game.beatmap.beatmapset', 'game.scores']
        );

        return [
            'events' => $events,
            'users' => $users,
            'all_events_count' => $match->events()->count(),
        ];
    }
}
