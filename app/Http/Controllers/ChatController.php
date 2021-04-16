<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\UserChannel;
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
            'presence' => UserChannel::presenceForUser($user),
        ];

        $targetUser = User::lookup(Request::input('sendto'), 'id');
        if ($targetUser) {
            $canMessage = priv_check('ChatStart', $targetUser)->can();

            $channel = Channel::findPM($targetUser, $user);
            optional($channel)->addUser($user);

            $json['send_to'] = [
                'can_message' => $canMessage,
                'channel_id' => optional($channel)->getKey(),
                'target' => json_item($targetUser, 'UserCompact'),
            ];
        }

        return ext_view('chat.index', compact('json'));
    }
}
