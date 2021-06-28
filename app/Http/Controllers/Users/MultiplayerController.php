<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Libraries\User\FindForProfilePage;
use App\Models\Multiplayer\Room;
use App\Transformers\BeatmapCompactTransformer;
use App\Transformers\BeatmapsetCompactTransformer;
use App\Transformers\Multiplayer\RoomTransformer;
use App\Transformers\UserTransformer;

class MultiplayerController extends Controller
{
    public function index()
    {
        $request = request();
        $user = FindForProfilePage::find($request->route('user'));
        $params = $request->all();
        $limit = clamp(get_int($params['limit'] ?? null) ?? 50, 1, 50);

        $search = Room::search([
            'cursor' => $params['cursor'] ?? null,
            'user' => $user,
            'limit' => $limit,
            'mode' => 'participated',
            'sort' => 'ended',
        ]);

        [$rooms, $hasMore] = $search['query']->with(['host', 'playlist.beatmap.beatmapset'])->getWithHasMore();
        $beatmaps = $rooms->pluck('playlist')->flatten(1)->pluck('beatmap')->unique()->values();
        $beatmapsets = $beatmaps->pluck('beatmapset')->unique()->values();

        $userTransformer = new UserTransformer(); // TODO: should user profile have standard includes?
        $userTransformer->mode = $user->playmode;
        $jsonUser = json_item(
            $user,
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
            'cursor' => $hasMore ? $search['cursorHelper']->next($rooms) : null,
            'rooms' => json_collection($rooms, new RoomTransformer(), ['host', 'playlist']),
            'search' => $search['params'],
        ];

        if (is_json_request()) {
            return $json;
        }

        return ext_view('users.multiplayer.index', compact('json', 'jsonUser', 'user'));
    }
}
