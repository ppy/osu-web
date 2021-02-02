<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\UserChannel;
use App\Models\User;
use Auth;
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
        $json = [
            'presence' => UserChannel::presenceForUser(Auth::user()),
        ];

        $targetUser = User::lookup(Request::input('sendto'), 'id');
        if ($targetUser) {
            $sendTo = [
                'target' => json_item($targetUser, 'UserCompact'),
                'can_message' => priv_check('ChatStart', $targetUser)->can(),
            ];

            $channel = Channel::findPM($targetUser, Auth::user());
            optional($channel)->addUser(Auth::user());

            $json['send_to'] = $sendTo;
        }

        return ext_view('chat.index', compact('json'));
    }
}
