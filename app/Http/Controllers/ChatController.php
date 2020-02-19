<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Http\Controllers;

use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;
use Auth;
use Request;

class ChatController extends Controller
{
    protected $section = 'community';
    protected $actionPrefix = 'chat-';

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

            $channel = Channel::where('name', Channel::getPMChannelName($targetUser, Auth::user()))->first();

            if ($channel !== null && !$channel->hasUser(Auth::user())) {
                $channel->addUser(Auth::user());
            }
        }

        $presence = UserChannel::presenceForUser(Auth::user());

        return ext_view('chat.index', compact('presence', 'messages', 'json'));
    }
}
