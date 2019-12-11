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

namespace App\Http\Controllers\Chat\Channels;

use App\Http\Controllers\Chat\Controller as BaseController;
use App\Libraries\Chat;
use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use Auth;
use Request;

/**
 * @group Chat
 */
class MessagesController extends BaseController
{
    /**
     * Get Channel Messages
     *
     * This endpoint returns the chat messages for a specific channel.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns an array of [ChatMessage](#chatmessage)
     *
     * @authenticated
     *
     * @queryParam channel_id required The ID of the channel to retrieve messages for
     * @queryParam limit number of messages to return (max of 50)
     *
     * @response [
     *   {
     *     "message_id": 9150005004,
     *     "sender_id": 2,
     *     "channel_id": 5,
     *     "timestamp": "2018-07-06T06:33:34+00:00",
     *     "content": "i am a lazerface",
     *     "is_action": 0,
     *     "sender": {
     *       "id": 2,
     *       "username": "peppy",
     *       "profile_colour": "#3366FF",
     *       "avatar_url": "https://a.ppy.sh/2?1519081077.png",
     *       "country_code": "AU",
     *       "is_active": true,
     *       "is_bot": false,
     *       "is_online": true,
     *       "is_supporter": true
     *     }
     *   },
     *   {
     *     "message_id": 9150005005,
     *     "sender_id": 102,
     *     "channel_id": 5,
     *     "timestamp": "2018-07-06T06:33:42+00:00",
     *     "content": "uh ok then",
     *     "is_action": 0,
     *     "sender": {
     *       "id": 102,
     *       "username": "nekodex",
     *       "profile_colour": "#333333",
     *       "avatar_url": "https://a.ppy.sh/102?1500537068",
     *       "country_code": "AU",
     *       "is_active": true,
     *       "is_bot": false,
     *       "is_online": true,
     *       "is_supporter": true
     *     }
     *   }
     * ]
     */
    public function index($channelId)
    {
        $userId = Auth::user()->user_id;
        $since = Request::input('since');
        $limit = clamp(Request::input('limit', 50), 1, 50);

        $userChannel = UserChannel::where([
            'user_id' => $userId,
            'channel_id' => $channelId,
            'hidden' => false,
        ])->firstOrFail();

        if ($userChannel->channel->isPM()) {
            // restricted users should be treated as if they do not exist
            if (optional($userChannel->channel->pmTargetFor(Auth::user()))->isRestricted()) {
                abort(404);
            }
        }

        $messages = $userChannel->channel
            ->filteredMessages()
            ->with('sender');

        if (presence($since)) {
            $messages = $messages->where('message_id', '>', $since)
                ->orderBy('message_id', 'asc')
                ->limit($limit)
                ->get();
        } else {
            $messages = $messages->orderBy('message_id', 'desc')
                ->limit($limit)
                ->get()
                ->reverse();
        }

        return json_collection(
            $messages,
            'Chat\Message',
            ['sender']
        );
    }

    /**
     * Send Message to Channel
     *
     * This endpoint returns the chat messages for a specific channel.
     *
     * ---
     *
     * ### Response Format
     *
     * The sent [ChatMessage](#chatmessage)
     *
     * <aside class="notice">
     *   When sending a message, the <code>last_read_id</code> for the <a href='#chatchannel'>ChatChannel</a> is also updated to mark the new message as read.
     * </aside>
     *
     * @authenticated
     *
     * @queryParam channel_id required The `channel_id` of the channel to send message to
     *
     * @bodyParam message string required message to send
     * @bodyParam is_action boolean required whether the message is an action
     *
     * @response {
     *   "message_id": 9150005004,
     *   "sender_id": 2,
     *   "channel_id": 5,
     *   "timestamp": "2018-07-06T06:33:34+00:00",
     *   "content": "i am a lazerface",
     *   "is_action": 0,
     *   "sender": {
     *     "id": 2,
     *     "username": "peppy",
     *     "profile_colour": "#3366FF",
     *     "avatar_url": "https://a.ppy.sh/2?1519081077.png",
     *     "country_code": "AU",
     *     "is_active": true,
     *     "is_bot": false,
     *     "is_online": true,
     *     "is_supporter": true
     *   }
     * }
     */
    public function store($channelId)
    {
        $params = request()->all();

        $message = Chat::sendMessage(
            auth()->user(),
            get_int($channelId),
            presence($params['message'] ?? null),
            get_bool($params['is_action'] ?? null) ?? false
        );

        return json_item(
            $message,
            'Chat/Message',
            ['sender']
        );
    }
}
