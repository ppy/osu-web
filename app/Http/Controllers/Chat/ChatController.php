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

class ChatController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'messages-';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verify-user');

        return parent::__construct();
    }

    public function updates()
    {
        if (!Request::has('since')) {
            abort(422);
        }

        $since = Request::input('since');

        $channels = UserChannel::where('user_id', Auth::user()->user_id)->pluck('channel_id');
        $messages = self::messages();
        $last_message_id = end($messages)['message_id'];

        if ($since >= $last_message_id) {
            abort(204);
        }

        $response = [
            'presence' => self::presence(),
            'messages' => $messages,
        ];

        return $response;
    }

    public function messages()
    {
        $user_id = Auth::user()->user_id;
        $since = Request::input('since', 0);

        $channels = UserChannel::where('user_id', $user_id)->pluck('channel_id');
        $messages = Message::whereIn('channel_id', $channels);

        $messages = $messages->where('message_id', '>', $since)
            ->orderBy('message_id', 'asc')
            ->limit(50)
            ->get();

        return json_collection(
            $messages,
            'Chat\Message',
            ['sender']
        );
    }

    public function presence()
    {
        $userChannels = UserChannel::where('user_channels.user_id', Auth::user()->user_id)
            ->join('channels', 'channels.channel_id', '=', 'user_channels.channel_id')
            ->join('user_channels as uc2', 'uc2.channel_id', '=', 'user_channels.channel_id')
            ->selectRaw('channels.*')
            ->selectRaw("GROUP_CONCAT(uc2.user_id SEPARATOR ',') as member_ids")
            ->selectRaw('user_channels.last_read_id')
            ->selectRaw('(select max(messages.message_id) from messages where messages.channel_id = user_channels.channel_id) as last_message_id')
            ->groupBy('user_channels.channel_id')
            ->groupBy('user_channels.user_id')
            ->get();

        // TODO: convert to transformer(?)
        return json_collection(
            $userChannels,
            function ($channel) {
                $presence = [
                    'channel_id' => $channel->channel_id,
                    'type' => $channel->type,
                    'name' => $channel->name,
                    'description' => presence($channel->description),
                    'icon' => "/images/layout/artist-noavatar@2x.jpg",
                    'last_read_id' => $channel->last_read_id,
                    'last_message_id' => $channel->last_message_id
                ];

                if ($channel->type != 'PUBLIC') {
                    $channelMembers = array_map('intval', explode(',', $channel->member_ids));
                    $presence['users'] = $channelMembers;
                }

                if ($channel->type == 'PM') {
                    // if this is a pm
                    $users = array_filter($channelMembers, function ($k) {
                        // remove current user, leaving only the other party
                        return $k != Auth::user()->user_id;
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

        if ($targetUser) {
            $canMessage = true;
            if (!$targetUser->user_allow_pm) {
                $canMessage = $targetUser->friends()->pluck('user_id')->contains(Auth::user()->user_id);
            }
            if ($targetUser->isRestricted() || Auth::user()->isRestricted()) {
                $canMessage = false;
            }
        }

        if (!$canMessage) {
            abort(403);
        }

        $ids = [Auth::user()->user_id, $targetUser->user_id];
        sort($ids);
        $channelName = '#pm_'.implode('-', $ids);

        $channel = Channel::where('name', $channelName)->first();

        if (!$channel) {
            DB::transaction(function () use ($ids, $channelName) {
                $channel = new Channel();
                $channel->name = $channelName;
                $channel->type = 'PM';
                $channel->save();
                $channel->fresh();

                foreach ($ids as $id) {
                    $uc = new UserChannel();
                    $uc->user_id = $id;
                    $uc->channel_id = $channel->channel_id;
                    $uc->save();
                }
            });
            $channel = Channel::where('name', $channelName)->first();
        }

        $message = $channel->receiveMessage(
            Auth::user(),
            Request::input('message'),
            get_bool(Request::input('is_action', false))
        );

        $response = [];
        $response['new_channel_id'] = $channel->channel_id;
        $response['message'] = json_item(
            $message,
            'Chat/Message',
            ['sender']
        );
        $response['presence'] = self::presence();

        return $response;
    }

    public function index()
    {
        $presence = self::presence();

        $json = [];

        $targetUser = User::lookup(Request::input('sendto'), 'id');
        if ($targetUser) {
            $sendto = json_item($targetUser, 'UserCompact');
            $canMessage = true;
            if (!$targetUser->user_allow_pm) {
                $canMessage = $targetUser->friends()->pluck('user_id')->contains(Auth::user()->user_id);
            }
            if ($targetUser->isRestricted() || Auth::user()->isRestricted()) {
                $canMessage = false;
            }
            $json['target'] = $sendto;
            $json['can_message'] = $canMessage;
        }

        return view('messages.index', compact('presence', 'messages', 'json'));
    }
}
