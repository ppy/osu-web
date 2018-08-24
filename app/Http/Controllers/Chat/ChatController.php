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
use Auth;
use DB;
use Request;

class ChatController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'messages-';

    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function updates()
    {
        if (!Request::has('since')) {
            abort(422);
        }

        $since = Request::input('since');
        $limit = clamp(get_int(Request::input('limit', 50)), 1, 50);

        $messages = Message::forUser(Auth::user())
            ->with('sender')
            ->since($since)
            ->limit($limit);

        if (Request::has('channel_id')) {
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
        $userChannels = UserChannel::where('user_channels.user_id', Auth::user()->user_id)
            ->join('channels', 'channels.channel_id', '=', 'user_channels.channel_id')
            ->join('user_channels as uc2', 'uc2.channel_id', '=', 'user_channels.channel_id')
            ->selectRaw('channels.*')
            ->selectRaw("group_concat(uc2.user_id SEPARATOR ',') as member_ids")
            ->selectRaw('user_channels.last_read_id')
            ->selectRaw('(select max(messages.message_id) from messages where messages.channel_id = user_channels.channel_id) as last_message_id')
            ->groupBy('user_channels.channel_id')
            ->groupBy('user_channels.user_id')
            ->get();

        return json_collection(
            $userChannels,
            function ($channel) {
                $presence = [
                    'channel_id' => $channel->channel_id,
                    'type' => $channel->type,
                    'name' => $channel->name,
                    'description' => presence($channel->description),
                    'last_read_id' => $channel->last_read_id,
                    'last_message_id' => $channel->last_message_id,
                ];

                if ($channel->type !== Channel::TYPES['public']) {
                    $channelMembers = array_map('intval', explode(',', $channel->member_ids));
                    $presence['users'] = $channelMembers;
                }

                if ($channel->type === Channel::TYPES['pm']) {
                    // if this is a pm
                    $users = array_filter($channelMembers, function ($k) {
                        // remove current user, leaving only the other party
                        return $k !== Auth::user()->user_id;
                    });
                    $targetUser = User::find(array_shift($users));

                    $presence['icon'] = $targetUser->user_avatar;
                    $presence['name'] = $targetUser->username;
                }

                return $presence;
            }
        );
    }

    public function newConversation()
    {
        if (!Request::has('target_id') || !Request::has('message')) {
            abort(422);
        }

        $targetUser = User::lookup(Request::input('target_id'), 'id');
        if (!$targetUser) {
            abort(422);
        }

        priv_check('ChatStart', $targetUser)->ensureCan();

        $userIds = [Auth::user()->user_id, $targetUser->user_id];
        sort($userIds);
        $channelName = '#pm_'.implode('-', $userIds);
        $channel = Channel::where('name', $channelName)->first();

        if (!$channel) {
            DB::transaction(function () use ($userIds, $channelName) {
                $channel = new Channel();
                $channel->name = $channelName;
                $channel->type = Channel::TYPES['pm'];
                $channel->description = ''; // description is not nullable
                $channel->save();
                $channel->fresh();

                foreach ($userIds as $id) {
                    $userChannel = new UserChannel();
                    $userChannel->user_id = $id;
                    $userChannel->channel_id = $channel->channel_id;
                    $userChannel->save();
                }
            });
            $channel = Channel::where('name', $channelName)->first();
        }

        try {
            $message = $channel->receiveMessage(
                Auth::user(),
                Request::input('message'),
                get_bool(Request::input('is_action', false))
            );
        } catch (ChatMessageTooLongException $e) {
            return error_popup($e->getMessage(), 422);
        } catch (ExcessiveChatMessagesException $e) {
            return error_popup($e->getMessage(), 429);
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
