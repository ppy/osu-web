<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use Request;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\PrivateMessage;
use App\Transformers\API\Chat\MessageTransformer;
use App\Transformers\API\Chat\PrivateMessageTransformer;
use App\Transformers\API\Chat\ChannelTransformer;
use Authorizer;
use App\Models\User;

class ChatController extends Controller
{
    public function channels()
    {
        $channels = Channel::where('type', 'Public')->get();

        return fractal_api_serialize_collection(
            $channels,
            new ChannelTransformer()
        );
    }

    public function messages()
    {
        $current_user = User::find(Authorizer::getResourceOwnerId());

        $channel_ids = array_map('intval', explode(',', Request::input('channels')));
        $since = intval(Request::input('since'));
        $limit = intval(Request::input('limit', 50));

        $channels = Channel::whereIn('channel_id', $channel_ids)->get();
        foreach ($channels as $channel) {
            if (!$channel->canBeMessagedBy($current_user)) {
                array_splice($channel_ids, array_search($channel->channel_id, $channel_ids, true), 1);
            }
        }

        $messages = Message::whereIn('channel_id', $channel_ids)
            ->with('user')
            ->where('message_id', '>', $since)
            ->orderBy('message_id', 'asc')
            ->limit(min(abs($limit), 50))
            ->get();

        return fractal_api_serialize_collection(
            $messages,
            new MessageTransformer()
        );
    }

    public function privateMessages()
    {
        $current_user = User::find(Authorizer::getResourceOwnerId());

        $since = intval(Request::input('since'));
        $limit = intval(Request::input('limit', 50));

        $messages = PrivateMessage::where('user_id', $current_user->user_id)
            ->orWhere('target_id', $current_user->user_id)
            ->where('message_id', '>', $since)
            ->with('sender')
            ->with('receiver')
            ->orderBy('message_id', 'asc')
            ->limit(min(abs($limit), 50))
            ->get();

        return fractal_api_serialize_collection(
            $messages,
            new PrivateMessageTransformer()
        );
    }

    public function postMessage()
    {
        $current_user = User::find(Authorizer::getResourceOwnerId());

        $target_type = Request::input('target_type');
        switch ($target_type) {
            case 'channel':
                $target = Channel::findOrFail(Request::input('channel_id'));
                break;
            case 'user':
                $target = User::findOrFail(Request::input('user_id'));
                break;
        }

        if (!$target || !$target->sendMessage($current_user, Request::input('message'))) {
            abort(401);
        }
    }
}
