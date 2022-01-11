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
    public function index()
    {
        $request = request();
        $user = FindForProfilePage::find($request->route('user'));

        $jsonUser = json_item(
            $user,
            (new UserTransformer())->setMode($user->playmode),
            UserTransformer::PROFILE_HEADER_INCLUDES,
        );

        $params = get_params($request->all(), null, [
            'category:string',
            'cursor:any',
            'limit:int',
        ], ['null_missing' => true]);

        if (!is_json_request()) {
            $json = $this->getJson($user, $params, 'any');

            return ext_view('users.multiplayer.index', compact('json', 'jsonUser', 'user'));
        }

        return $this->getJson($user, $params, $params['category']);
    }

    private function getJson(User $user, array $params, ?string $category)
    {
        $limit = clamp(get_int($params['limit']) ?? 50, 1, 50);

        $search = Room::search([
            'category' => $category,
            'cursor' => $params['cursor'],
            'user' => $user,
            'limit' => $limit,
            'mode' => 'participated',
            'sort' => 'ended',
        ]);

        [$rooms, $hasMore] = $search['query']->with(['host', 'playlist.beatmap.beatmapset'])->getWithHasMore();
        $beatmaps = $rooms->pluck('playlist')->flatten(1)->pluck('beatmap')->unique()->values();
        $beatmapsets = $beatmaps->pluck('beatmapset')->unique()->values();

        return [
            'beatmaps' => json_collection($beatmaps, new BeatmapCompactTransformer()),
            'beatmapsets' => json_collection($beatmapsets, new BeatmapsetCompactTransformer()),
            'cursor' => $hasMore ? $search['cursorHelper']->next($rooms) : null,
            'rooms' => json_collection($rooms, new RoomTransformer(), ['host', 'playlist']),
            'search' => $search['search'],
        ];
    }
}
