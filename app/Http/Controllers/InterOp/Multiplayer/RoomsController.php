<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp\Multiplayer;

use App\Http\Controllers\Controller;
use App\Models\Multiplayer\Room;
use App\Models\User;
use App\Transformers\Multiplayer\RoomTransformer;

class RoomsController extends Controller
{
    public function join(string $id, string $userId)
    {
        $user = User::findOrFail($userId);
        $room = Room::findOrFail($id);

        $room->assertCorrectPassword(get_string(request('password')));
        $room->join($user);

        return response(null, 204);
    }

    public function part(string $id, string $userId)
    {
        $user = User::findOrFail($userId);
        $room = Room::findOrFail($id);

        $room->part($user);

        return response(null, 204);
    }

    public function store()
    {
        $params = \Request::all();
        $user = User::findOrFail(get_int($params['user_id'] ?? null));

        $room = (new Room())->startGame($user, $params);

        return $room->getKey();
    }
}
