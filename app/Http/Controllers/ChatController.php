<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\UserChannelList;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\User;
use Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function index()
    {
        $user = auth()->user();

        $json = [
            'last_message_id' => optional(Message::last())->getKey(),
            'presence' => (new UserChannelList($user))->get(),
        ];

        $targetUser = User::lookup(Request::input('sendto'), 'id');
        if ($targetUser) {
            $channel = Channel::findPM($targetUser, $user);
            $channel?->addUser($user);

            $json['send_to'] = [
                'can_message' => $channel?->canMessage($user) ?? false,
                'channel_id' => $channel?->getKey(),
                'target' => json_item($targetUser, 'UserCompact'),
            ];
        }

        return ext_view('chat.index', compact('json'));
    }
}
