<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Libraries\User\FindForProfilePage;
use App\Models\Multiplayer\Room;
use App\Models\User;
use App\Transformers\Multiplayer\RoomTransformer;
use App\Transformers\UserTransformer;

class MultiplayerController extends Controller
{
    public function index($userId, $typeGroup)
    {
        $user = FindForProfilePage::find($userId);

        if (!array_key_exists($typeGroup, Room::TYPE_GROUPS)) {
            return ujs_redirect(route('users.multiplayer.index', ['typeGroup' => 'realtime', 'user' => $userId]));
        }

        $params = get_params(request()->all(), null, [
            'cursor:array',
            'limit:int',
        ], ['null_missing' => true]);

        $json = $this->getJson($user, $params, $typeGroup);

        if (is_json_request()) {
            return $json;
        }

        $jsonUser = json_item(
            $user,
            (new UserTransformer())->setMode($user->playmode),
            UserTransformer::PROFILE_HEADER_INCLUDES,
        );

        return ext_view('users.multiplayer.index', compact('json', 'jsonUser', 'user'));
    }

    private function getJson(User $user, array $params, string $typeGroup)
    {
        $limit = clamp($params['limit'] ?? 50, 1, 50);

        $search = Room::search([
            'cursor' => $params['cursor'],
            'user' => $user,
            'limit' => $limit,
            'mode' => 'participated',
            'sort' => 'ended',
            'type_group' => $typeGroup,
        ]);

        [$rooms, $hasMore] = $search['query']->with([
            'playlist.beatmap',
            'host',
        ])->getWithHasMore();
        $rooms->each->findAndSetCurrentPlaylistItem();
        $rooms->loadMissing('currentPlaylistItem.beatmap.beatmapset');

        return [
            'cursor' => $hasMore ? $search['cursorHelper']->next($rooms) : null,
            'rooms' => json_collection($rooms, new RoomTransformer(), ['current_playlist_item.beatmap.beatmapset', 'difficulty_range', 'host', 'playlist_item_stats']),
            'search' => $search['search'],
            'type_group' => $typeGroup,
        ];
    }
}
