<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Chat\Channel;
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
        $json = [];

        $targetUser = User::lookup(Request::input('sendto'), 'id');
        if ($targetUser) {
            $json['target'] = json_item($targetUser, 'UserCompact');
            $json['can_message'] = priv_check('ChatStart', $targetUser)->can();

            $channel = Channel::findPM($targetUser, Auth::user());
            optional($channel)->addUser(Auth::user());
        }

        $presence = UserChannel::presenceForUser(Auth::user());

        return ext_view('chat.index', compact('presence', 'json'));
    }
}
