<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Libraries\User\FindForProfilePage;
use App\Models\Multiplayer\Room;
use App\Transformers\UserTransformer;

class MultiplayerController extends Controller
{
    public function index($userId, $typeGroup)
    {
        $user = FindForProfilePage::find($userId);

        if (!array_key_exists($typeGroup, Room::TYPE_GROUPS)) {
            return ujs_redirect(route('users.multiplayer.index', ['typeGroup' => 'realtime', 'user' => $userId]));
        }

        $rawParams = request()->all();
        $params = [
            'cursor' => cursor_from_params($rawParams),
            'limit' => get_int($rawParams['limit'] ?? null),
            'mode' => 'participated',
            'sort' => 'ended',
            'type_group' => $typeGroup,
            'user' => $user,
        ];

        $json = Room::responseJson($params);

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
}
