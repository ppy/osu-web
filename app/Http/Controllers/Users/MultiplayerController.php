<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Libraries\User\FindForProfilePage;
use App\Models\Multiplayer\Room;
use App\Models\User;
use App\Transformers\BeatmapCompactTransformer;
use App\Transformers\BeatmapsetCompactTransformer;
use App\Transformers\Multiplayer\RoomTransformer;
use App\Transformers\UserTransformer;

class MultiplayerController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = FindForProfilePage::find($request->route('user'));

            return $next($request);
        });

        parent::__construct();
    }

    public function index()
    {
        $params = request()->all();
        $limit = clamp(get_int($params['limit'] ?? null) ?? 50, 1, 50);

        $search = Room::search([
            'cursor' => $params['cursor'] ?? null,
            'user' => $this->user,
            'limit' => $limit,
            'mode' => 'participated',
            'sort' => 'ended',
        ]);

        $rooms = $search['query']->with(['host', 'playlist.beatmap.beatmapset'])->get();
        $beatmaps = $rooms->pluck('playlist')->flatten(1)->pluck('beatmap')->unique()->values();
        $beatmapsets = $beatmaps->pluck('beatmapset')->unique()->values();

        $userTransformer = new UserTransformer(); // TODO: should user profile have standard includes?
        $userTransformer->mode = $this->user->playmode;
        $jsonUser = json_item(
            $this->user,
            $userTransformer,
            [
                'active_tournament_banner',
                'badges',
                'follower_count',
                'groups',
                'previous_usernames',
                'support_level',
            ]
        );

        $json = [
            'beatmaps' => json_collection($beatmaps, new BeatmapCompactTransformer()),
            'beatmapsets' => json_collection($beatmapsets, new BeatmapsetCompactTransformer()),
            'cursor' => $search['cursorHelper']->next($rooms),
            'rooms' => json_collection($rooms, new RoomTransformer(), ['host', 'playlist']),
            'search' => $search['params'],
        ];

        if (is_json_request()) {
            return $json;
        }

        return ext_view('users.multiplayer.index', ['json' => $json, 'jsonUser' => $jsonUser, 'user' => $this->user]);
    }
}
