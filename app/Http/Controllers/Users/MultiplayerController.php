<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Multiplayer\Room;
use App\Models\User;
use App\Transformers\Multiplayer\RoomTransformer;
use App\Transformers\UserTransformer;

class MultiplayerController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $userId = request()->route('user');
            $this->user = User::lookupWithHistory($userId, null, false, true);

            if ($this->user === null || $this->user->isBot() || !priv_check('UserShow', $this->user)->can()) {
                return ext_view('users.show_not_found', null, null, 404);
            }

            $this->searchParams = array_merge(request()->query(), ['user' => $this->user->user_id]);

            if ((string) $this->user->user_id !== (string) $userId) {
                return ujs_redirect(route(
                    $request->route()->getName(),
                    $this->searchParams
                ));
            }

            return $next($request);
        });

        parent::__construct();
    }

    public function index()
    {
        $transformer = new UserTransformer(); // TODO: should user profile have standard includes?
        $transformer->mode = $this->user->playmode;
        $user = json_item(
            $this->user,
            $transformer,
            [
                'active_tournament_banner',
                'badges',
                'follower_count',
                'graveyard_beatmapset_count',
                'groups',
                'loved_beatmapset_count',
                'previous_usernames',
                'ranked_and_approved_beatmapset_count',
                'statistics',
                'statistics.country_rank',
                'statistics.rank',
                'support_level',
                'unranked_beatmapset_count',
            ]
        );

        $params = request()->all();
        $limit = clamp(get_int($params['limit'] ?? null) ?? 50, 1, 50);

        // TODO: cleaout the includes
        $search = Room::search(['user' => $this->user, 'limit' => $limit, 'mode' => 'participated', 'sort' => 'ended']);

        $rooms = $search['query']->with(['host', 'playlist.beatmap.beatmapset'])->get();
        $cursor = $search['cursorHelper']->next($rooms);
        $rooms = json_collection($rooms, new RoomTransformer(), ['host', 'playlist.beatmap.beatmapset']);
        $beatmaps = collect($rooms)->pluck('playlist')->flatten(1)->pluck('beatmap')->unique()->values();
        $beatmapsets = $beatmaps->pluck('beatmapset')->unique()->values();

        $json = [
            'beatmaps' => $beatmaps,
            'beatmapsets' => $beatmapsets,
            'cursor' => $cursor,
            'rooms' => $rooms,
            'search' => $search['params'],
            'user' => $user,
        ];

        if (is_api_request()) {
            return $json;
        }

        return ext_view('users.multiplayer.index', ['json' => $json, 'user' => $this->user]);
    }
}
