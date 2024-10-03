<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Chat\Channels;

use App\Http\Controllers\Chat\Controller;
use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;
use App\Transformers\UserCompactTransformer;

class UsersController extends Controller
{
    public function index($channelId)
    {
        $channel = Channel::findOrFail($channelId);

        if (!priv_check('ChatChannelListUsers', $channel)->can()) {
            return [
                'users' => [],
                ...cursor_for_response(null),
            ];
        }

        $channel = Channel::findOrFail($channelId);
        $cursorHelper = UserChannel::makeDbCursorHelper();
        [$userChannels, $hasMore] = $channel
            ->userChannels()
            ->select('user_id')
            ->limit(UserChannel::PER_PAGE)
            ->cursorSort($cursorHelper, cursor_from_params(\Request::all()))
            ->getWithHasMore();
        $users = User
            ::with(UserCompactTransformer::CARD_INCLUDES_PRELOAD)
            ->find($userChannels->pluck('user_id'));

        return [
            'users' => json_collection(
                $users,
                new UserCompactTransformer(),
                UserCompactTransformer::CARD_INCLUDES,
            ),
            ...cursor_for_response($cursorHelper->next($userChannels, $hasMore)),
        ];
    }
}
