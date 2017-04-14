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

namespace App\Http\Controllers\API;

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\PrivateMessage;
use App\Models\User;
use App\Transformers\API\Chat\ChannelTransformer;
use App\Transformers\API\Chat\MessageTransformer;
use App\Transformers\API\Chat\PrivateMessageTransformer;
use Auth;
use Carbon\Carbon;
use Request;

class ChatController extends Controller
{
    // Limits for chatting, throttles after CHAT_LIMIT_MESSAGES messages in CHAT_LIMIT_WINDOW seconds
    const PUBLIC_CHAT_LIMIT_MESSAGES = 5;
    const PUBLIC_CHAT_LIMIT_WINDOW = 4;
    // const PRIVATE_CHAT_LIMIT_MESSAGES = 10;
    // const PRIVATE_CHAT_LIMIT_WINDOW = 5;

    public function channels()
    {
        $channels = Channel::where('type', 'Public')->get();

        return json_collection(
            $channels,
            new ChannelTransformer()
        );
    }

    public function messages()
    {
        $channel_ids = array_map('intval', explode(',', Request::input('channels')));
        $since = intval(Request::input('since'));
        $limit = min(50, intval(Request::input('limit', 50)));

        $channels = Channel::whereIn('channel_id', $channel_ids)
            ->get()
            ->filter(function ($channel) {
                return priv_check('ChatChannelRead', $channel)->can();
            });

        $messages = Message::whereIn('channel_id', $channel_ids)->with('user');

        if ($since) {
            $messages = $messages->where('message_id', '>', $since);
        }

        $collection = json_collection(
            $messages->orderBy('message_id', $since ? 'asc' : 'desc')
                ->limit($limit)
                ->get(),
            new MessageTransformer()
        );

        return $since ? $collection : array_reverse($collection);
    }

    public function privateMessages()
    {
        $since = intval(Request::input('since'));
        $limit = min(50, intval(Request::input('limit', 50)));

        $messages = PrivateMessage::toOrFrom(Auth::user()->user_id)
            ->with('sender')
            ->with('receiver');

        if ($since) {
            $messages = $messages->where('message_id', '>', $since);
        }

        $collection = json_collection(
            $messages->orderBy('message_id', $since ? 'asc' : 'desc')
                ->limit($limit)
                ->get(),
            new PrivateMessageTransformer()
        );

        return $since ? $collection : array_reverse($collection);
    }

    public function postMessage()
    {
        if (mb_strlen(Request::input('message'), 'UTF-8') >= 1024) {
            abort(422);
        }

        switch (Request::input('target_type')) {
            case 'channel':
                $target = Channel::findOrFail(Request::input('target_id'));
                break;
            // case 'user':
            //     $target = User::findOrFail(Request::input('target_id'));
            //     break;
            default:
                abort(422);
        }

        priv_check('ChatMessageSend', $target)->ensureCan();

        $sent = Message::where('user_id', Auth::user()->user_id)
            ->where('timestamp', '>=', Carbon::now()->subSecond(self::PUBLIC_CHAT_LIMIT_WINDOW))
            ->count();

        if ($sent > self::PUBLIC_CHAT_LIMIT_MESSAGES) {
            return response(['error' => trans('api.error.chat.limit_exceeded')], 429);
        }

        $message = $target->receiveMessage(Auth::user(), Request::input('message'));

        return json_item($message, 'API\Chat\Message');
    }
}
