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
use App\Models\UserRelation;
use Auth;
use DB;
use Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function updates()
    {
        if (!present(Request::input('since'))) {
            abort(422);
        }

        $since = Request::input('since');
        $limit = clamp(get_int(Request::input('limit')) ?? 50, 1, 50);

        $messages = Message::forUser(Auth::user())
            ->with('sender')
            ->since($since)
            ->limit($limit);

        if (present(Request::input('channel_id'))) {
            $messages->where('channel_id', get_int(Request::input('channel_id')));
        }

        $messages = $messages->get()->reverse();

        if ($messages->isEmpty() || $since >= $messages->last()->message_id) {
            return response([], 204);
        }

        $response = [
            'presence' => self::presence(),
            'messages' => json_collection(
                $messages,
                'Chat\Message',
                ['sender']
            ),
        ];

        return $response;
    }

    public function presence()
    {
        return UserChannel::presenceForUser(Auth::user());
    }

    public function newConversation()
    {
        if (!present(Request::input('target_id')) || !present(Request::input('message')) || get_int(Request::input('target_id')) === Auth::user()->user_id) {
            abort(422);
        }

        $targetUser = User::lookup(Request::input('target_id'), 'id');
        if (!$targetUser) {
            // restricted users should be treated as if they do not exist
            abort(404);
        }

        priv_check('ChatStart', $targetUser)->ensureCan();

        $userIds = [Auth::user()->user_id, $targetUser->user_id];
        sort($userIds);
        $channelName = '#pm_'.implode('-', $userIds);
        $channel = Channel::where('name', $channelName)->first();

        if (!$channel) {
            $channel = DB::transaction(function () use ($userIds, $channelName) {
                $channel = new Channel();
                $channel->name = $channelName;
                $channel->type = Channel::TYPES['pm'];
                $channel->description = ''; // description is not nullable
                $channel->save();

                foreach ($userIds as $id) {
                    $userChannel = new UserChannel();
                    $userChannel->user_id = $id;
                    $userChannel->channel_id = $channel->channel_id;
                    $userChannel->save();
                }

                return $channel;
            });
        }

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

        return [
            'new_channel_id' => $channel->channel_id,
            'message' => json_item(
                $message,
                'Chat/Message',
                ['sender']
            ),
            'presence' => self::presence(),
        ];
    }
}
