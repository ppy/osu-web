<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers\Chat\Channels;

use App\Exceptions\API;
use App\Http\Controllers\Chat\Controller as BaseController;
use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use Auth;
use Request;

class MessagesController extends BaseController
{
    public function index($channelId)
    {
        $userId = Auth::user()->user_id;
        $since = Request::input('since');
        $limit = clamp(Request::input('limit', 50), 1, 50);

        $userChannel = UserChannel::where(['user_id' => $userId, 'channel_id' => $channelId])->firstOrFail();

        if ($userChannel->channel->isPM()) {
            // restricted users should be treated as if they do not exist
            if (optional($userChannel->channel->pmTargetFor(Auth::user()))->isRestricted()) {
                abort(404);
            }
        }

        $messages = $userChannel->channel
            ->filteredMessages()
            ->with('sender');

        if (presence($since)) {
            $messages = $messages->where('message_id', '>', $since)
                ->orderBy('message_id', 'asc')
                ->limit($limit)
                ->get();
        } else {
            $messages = $messages->orderBy('message_id', 'desc')
                ->limit($limit)
                ->get()
                ->reverse();
        }

        return json_collection(
            $messages,
            'Chat\Message',
            ['sender']
        );
    }

    public function store($channelId)
    {
        $channel = Channel::findOrFail($channelId);

        if ($channel->isPM()) {
            // restricted users should be treated as if they do not exist
            if (optional($channel->pmTargetFor(Auth::user()))->isRestricted()) {
                abort(404);
            }
        }

        priv_check('ChatChannelSend', $channel)->ensureCan();

        try {
            $message = $channel->receiveMessage(
                Auth::user(),
                Request::input('message'),
                get_bool(Request::input('is_action', false))
            );
        } catch (API\ChatMessageTooLongException $e) {
            abort(422, $e->getMessage());
        } catch (API\ExcessiveChatMessagesException $e) {
            abort(429, $e->getMessage());
        }

        return json_item(
            $message,
            'Chat/Message',
            ['sender']
        );
    }
}
