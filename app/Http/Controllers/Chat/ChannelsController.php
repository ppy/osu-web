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

namespace App\Http\Controllers\Chat;

use App\Exceptions\API;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\UserChannel;
use App\Models\User;
use Auth;
use DB;
use Request;

class ChannelsController extends Controller
{
    public function index()
    {
        return json_collection(
            Channel::public()->get(),
            'Chat/Channel'
        );
    }

    public function show($channel_id)
    {
        $user_id = Auth::user()->user_id;
        $since = Request::input('since');
        $limit = clamp(Request::input('limit', 50), 1, 50);

        $userChannel = UserChannel::where(['user_id' => $user_id, 'channel_id' => $channel_id])->firstOrFail();

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

    public function join($channel_id, $user_id)
    {
        // FIXME: Update this to proper permission check when public-only restriction is lifted
        $channel = Channel::public()->where('channel_id', $channel_id)->firstOrFail();

        if (Auth::user()->user_id !== get_int($user_id)) {
            abort(403);
        }

        if (!$channel->hasUser(Auth::user())) {
            $channel->addUser(Auth::user());
        }

        return response([], 204);
    }

    public function part($channel_id, $user_id)
    {
        // FIXME: Update this to proper permission check when public-only restriction is lifted
        $channel = Channel::public()->where('channel_id', $channel_id)->firstOrFail();

        if (Auth::user()->user_id !== get_int($user_id)) {
            abort(403);
        }

        $channel->removeUser(Auth::user());

        return response([], 204);
    }

    public function markAsRead($channel_id, $message_id)
    {
        $userChannelQuery = UserChannel::where(['user_id' => Auth::user()->user_id, 'channel_id' => $channel_id]);
        $userChannel = $userChannelQuery->firstOrFail();
        $message_id = get_int($message_id);

        // this prevents the read marker going backwards
        $userChannelQuery->update(['last_read_id' => DB::raw("GREATEST(COALESCE(last_read_id, 0), $message_id)")]);

        return response([], 204);
    }

    public function send($channel_id)
    {
        $channel = Channel::findOrFail($channel_id);

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
