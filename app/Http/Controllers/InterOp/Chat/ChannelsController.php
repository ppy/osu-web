<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat\Channel;
use App\Models\User;
use App\Transformers\Chat\ChannelTransformer;
use Illuminate\Http\Response;

class ChannelsController extends Controller
{
    public function addUser(string $id, string $userId): Response
    {
        $channel = Channel::findOrFail($id);
        $user = User::findOrFail($userId);
        $channel->addUser($user);

        return response(null, 204);
    }

    public function close(string $id): Response
    {
        Channel::findOrFail($id)->close();

        return response(null, 204);
    }

    public function removeUser(string $id, string $userId): Response
    {
        $channel = Channel::findOrFail($id);
        $user = User::findOrFail($userId);
        $channel->removeUser($user);

        return response(null, 204);
    }

    public function store(): array
    {
        $channel = new Channel(get_params(\Request::all(), null, [
            'name',
            'type',
            'description',
        ]));
        $channel->saveOrExplode();

        return json_item($channel, new ChannelTransformer());
    }
}
