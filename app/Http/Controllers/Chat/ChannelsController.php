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

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\UserChannel;
use App\Models\User;
use App\Models\UserRelation;
use Auth;
use Carbon\Carbon;
use DB;
use Request;

class ChannelsController extends Controller
{
    // Limits for chatting, throttles after CHAT_LIMIT_MESSAGES messages in CHAT_LIMIT_WINDOW seconds
    const PUBLIC_CHAT_LIMIT_MESSAGES = 5;
    const PUBLIC_CHAT_LIMIT_WINDOW = 4;
    const PRIVATE_CHAT_LIMIT_MESSAGES = 10;
    const PRIVATE_CHAT_LIMIT_WINDOW = 5;
    const MESSAGE_LENGTH_LIMIT = 1024;

    public function index()
    {
        return json_collection(
            Channel::where('type', 'public')->get(),
            'Chat/Channel'
        );
    }

    public function show($channel_id)
    {
        $user_id = Auth::user()->user_id;
        $since = Request::input('since');

        $channel = UserChannel::where(['user_id' => $user_id, 'channel_id' => $channel_id])->firstOrFail();
        $messages = $channel->messages();

        if (presence($since)) {
            $messages = $messages->where('message_id', '>', $since)
                ->orderBy('message_id', 'asc')
                ->limit(50)
                ->get();
        } else {
            $messages = $messages->orderBy('message_id', 'desc')
                ->limit(50)
                ->get()
                ->reverse();
        }

        return json_collection(
            $messages,
            'Chat\Message',
            ['sender']
        );
    }

    public function markAsRead($channel_id)
    {
        $userChannelQuery = UserChannel::where(['user_id' => Auth::user()->user_id, 'channel_id' => $channel_id]);
        $userChannel = $userChannelQuery->firstOrFail();

        if (!Request::has('message_id')) {
            abort(422);
        }

        $marker = intval(Request::input('message_id'));
        // this prevents the read marker going backwards
        $userChannelQuery->update(['last_read_id' => DB::raw("GREATEST(COALESCE(last_read_id, 0), $marker)")]);

        abort(204);
    }

    public function send($channel_id)
    {
        if (mb_strlen(Request::input('message'), 'UTF-8') >= MESSAGE_LENGTH_LIMIT) {
            abort(422);
        }

        $channel = Channel::findOrFail($channel_id);

        priv_check('ChatChannelSend', $channel)->ensureCan();

        $query = Message::where('user_id', Auth::user()->user_id)
            ->join('channels', 'channels.channel_id', '=', 'messages.channel_id');

        if ($channel->type == 'PM') {
            $limit = self::PRIVATE_CHAT_LIMIT_MESSAGES;
            $window = self::PRIVATE_CHAT_LIMIT_WINDOW;
            $query->where('type', 'PM');
        } else {
            $limit = self::PUBLIC_CHAT_LIMIT_MESSAGES;
            $window = self::PUBLIC_CHAT_LIMIT_WINDOW;
            $query->where('type', '!=', 'PM');
        }

        $query->where('timestamp', '>=', Carbon::now()->subSecond($window));

        if ($query->count() > $limit) {
            return error_popup(trans('api.error.chat.limit_exceeded'), 429);
        }

        $message = $channel->receiveMessage(
            Auth::user(),
            Request::input('message'),
            get_bool(Request::input('is_action', false))
        );

        return json_item(
            $message,
            'Chat/Message',
            ['sender']
        );
    }
}
