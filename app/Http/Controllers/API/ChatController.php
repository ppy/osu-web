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
use Response;
use Redirect;
use Carbon\Carbon;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Http\Controllers\Controller as Controller;
use DB;
use App\Transformers\API\Chat\MessageTransformer;
use App\Transformers\API\Chat\ChannelTransformer;

class ChatController extends Controller
{
    public function __construct()
    {
    }

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
        $channels = array_map('intval', explode(',', Request::input('channels')));
        $since = intval(Request::input('since'));

        $messages = Message::whereIn('channel_id', $channels)
            ->with('user')
            ->where('message_id', '>', $since)
            ->orderBy('message_id', 'desc')
            ->limit(50)
            ->get();

        return fractal_api_serialize_collection(
            $messages,
            new MessageTransformer()
        );
    }
}
