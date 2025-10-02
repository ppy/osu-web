<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\LegacyMatch\LegacyMatch;
use App\Models\User;
use App\Transformers\LegacyMatch\EventTransformer;
use App\Transformers\UserCompactTransformer;

/**
 * @group Matches
 */
class LegacyMatchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public', ['only' => ['index', 'show']]);
    }

    /**
     * Get Matches Listing
     *
     * Returns a list of matches.
     *
     * ---
     *
     * ### Response Format
     *
     * Field         | Type                          | Notes
     * ------------- | ----------------------------- | -----
     * cursor        | [Cursor](#cursor)             | |
     * cursor_string | [CursorString](#cursorstring) | |
     * matches       | [Match](#match)[]             | |
     * params.limit  | integer                       | |
     * params.sort   | string                        | |
     * params.active | boolean                       | |
     *
     * @usesCursor
     * @queryParam limit integer Maximum number of matches (50 default, 1 minimum, 50 maximum). No-example
     * @queryParam sort string `id_desc` for newest first; `id_asc` for oldest first. Defaults to `id_desc`. No-example
     * @queryParam active boolean `true` for active matches only; `false` for inactive matches only. Defaults to not specified, returning both. No-example
     * @response {
     *     "matches": [
     *         {
     *             "id": 114428685,
     *             "start_time": "2024-06-25T00:55:30+00:00",
     *             "end_time": null,
     *             "name": "peppy's game"
     *         },
     *         // ...
     *     ],
     *     "params": {
     *         "limit": 50,
     *         "sort": "id_desc",
     *         "active": null
     *     },
     *     "cursor": {
     *         "match_id": 114428685
     *     },
     *     "cursor_string": "eyJtYXRjaF9pZCI6MTE0NDI4Njg1fQ"
     * }
     */
    public function index()
    {
        $params = request()->all();
        $limit = \Number::clamp(get_int($params['limit'] ?? null) ?? 50, 1, 50);
        $cursorHelper = LegacyMatch::makeDbCursorHelper($params['sort'] ?? null);
        $active = get_bool($params['active'] ?? null);

        [$matches, $hasMore] = LegacyMatch
            ::where('private', false)
            ->when(!is_null($active), fn ($q) =>
                 $active
                 ? $q->whereNull('end_time')
                 : $q->whereNotNull('end_time'))
            ->cursorSort($cursorHelper, cursor_from_params($params))
            ->limit($limit)
            ->getWithHasMore();

        return [
            'matches' => json_collection($matches, 'LegacyMatch\LegacyMatch'),
            'params' => [
                'limit' => $limit,
                'sort' => $cursorHelper->getSortName(),
                'active' => $active,
            ],
            ...cursor_for_response($cursorHelper->next($matches, $hasMore)),
        ];
    }

    /**
     * Get Match
     *
     * Returns details of the specified match.
     *
     * ---
     *
     * ### Response Format
     *
     * Field           | Type                        | Notes
     * --------------- | --------------------------- | -----
     * match           | [Match](#match)             | |
     * events          | [MatchEvent](#matchevent)[] | |
     * users           | [User](#user)[]             | Includes `country`.
     * first_event_id  | integer                     | ID of the first [MatchEvent](#matchevent) in the match.
     * latest_event_id | integer                     | ID of the lastest [MatchEvent](#matchevent) in the match.
     *
     * @urlParam match integer required Match ID. No-example
     * @queryParam before integer Filter for match events before the specified [MatchEvent.id](#matchevent). No-example
     * @queryParam after integer Filter for match events after the specified [MatchEvent.id](#matchevent). No-example
     * @queryParam limit integer Maximum number of match events (100 default, 1 minimum, 101 maximum). No-example
     * @response {
     *     "match": {
     *         "id": 16155689,
     *         "start_time": "2015-05-16T09:44:51+00:00",
     *         "end_time": "2015-05-16T10:55:08+00:00",
     *         "name": "CWC 2015: (Australia) vs (Poland)"
     *     },
     *     "events": [
     *         {
     *             "id": 484385927,
     *             "detail": {
     *                 "type": "match-created"
     *             },
     *             "timestamp": "2015-05-16T09:44:51+00:00",
     *             "user_id": null
     *         },
     *         // ...
     *     ],
     *     "users": [],
     *     "first_event_id": 484385927,
     *     "latest_event_id": 484410607,
     *     "current_game_id": null
     * }
     */
    public function show($id)
    {
        $match = LegacyMatch::findOrFail($id);

        $params = get_params(request()->all(), null, ['after:int', 'before:int', 'limit:int']);
        $params['match'] = $match;

        priv_check('MatchView', $match)->ensureCan();

        $eventsJson = $this->eventsJson($params);

        if (is_json_request()) {
            return $eventsJson;
        } else {
            return ext_view('legacy_matches.show', compact('match', 'eventsJson'));
        }
    }

    private function eventsJson($params)
    {
        $match = $params['match'];
        $after = $params['after'] ?? null;
        $before = $params['before'] ?? null;
        $limit = \Number::clamp($params['limit'] ?? 100, 1, 101);

        $events = $match->events()
            ->with([
                'game.beatmap.beatmapset',
                'game.scores' => fn ($q) => $q->default(),
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
        foreach ($events as $event) {
            $game = $event->game;
            if ($game !== null) {
                foreach ($game->scores as $score) {
                    $score->setRelation('game', $game);
                }
            }
        }

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
            'match' => json_item($match, 'LegacyMatch\LegacyMatch'),
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
