<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\DbCursorHelper;
use App\Models\Match\Match;
use App\Models\User;
use App\Transformers\Match\EventTransformer;
use App\Transformers\UserCompactTransformer;

class MatchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public', ['only' => ['index', 'show']]);
    }

    public function index()
    {
        $params = request()->all();
        $cursorHelper = new DbCursorHelper(Match::SORTS, Match::DEFAULT_SORT, $params['sort'] ?? null);

        $sort = $cursorHelper->getSort();
        $cursor = $cursorHelper->prepare($params['cursor'] ?? null);
        $limit = clamp(get_int($params['limit'] ?? null) ?? 50, 1, 50);

        $matches = Match
            ::where('private', false)
            ->cursorSort($sort, $cursor)
            ->limit($limit + 1) // an extra to check for pagination
            ->get();

        $hasMore = count($matches) === $limit + 1;
        if ($hasMore) {
            $matches->pop();
        }

        return [
            'cursor' => $hasMore ? $cursorHelper->next($matches) : null,
            'matches' => json_collection($matches, 'Match\Match'),
            'params' => ['limit' => $limit, 'sort' => $cursorHelper->getSortName()],
        ];
    }

    public function show($id)
    {
        $match = Match::findOrFail($id);

        $params = get_params(request()->all(), null, ['after:int', 'before:int', 'limit:int']);
        $params['match'] = $match;

        priv_check('MatchView', $match)->ensureCan();

        $eventsJson = $this->eventsJson($params);

        if (is_json_request()) {
            return $eventsJson;
        } else {
            return ext_view('matches.index', compact('match', 'eventsJson'));
        }
    }

    private function eventsJson($params)
    {
        $match = $params['match'];
        $after = $params['after'] ?? null;
        $before = $params['before'] ?? null;
        $limit = clamp($params['limit'] ?? 100, 1, 101);

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
            new UserCompactTransformer(),
            'country'
        );

        $events = json_collection(
            $events,
            new EventTransformer(),
            ['game.beatmap.beatmapset', 'game.scores.match']
        );

        $eventEndIds = $match
            ->events()
            ->selectRaw('MIN(event_id) first_event_id, MAX(event_id) latest_event_id')
            ->first();

        return [
            'match' => json_item($match, 'Match\Match'),
            'events' => $events,
            'users' => $users,
            'first_event_id' => $eventEndIds->first_event_id ?? 0,
            'latest_event_id' => $eventEndIds->latest_event_id ?? 0,
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
