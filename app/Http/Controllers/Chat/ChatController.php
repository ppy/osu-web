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

namespace App\Http\Controllers\Chat;

use App\Libraries\Chat;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\UserChannel;
use App\Models\User;
use Auth;
use Request;

/**
 * @group Chat
 */
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    /**
     * Get Updates
     *
     * This endpoint returns new messages since the given `message_id` along with updated channel 'presence' data.
     *
     * ---
     *
     * ### Response Format
     *
     * Field            | Type
     * ---------------- | -----------------
     * presence         | array of [ChatChannel](#chatchannel)
     * messages         | array of [ChatMessage](#chatmessage)
     *
     * <aside class="notice">
     *   Note that this returns messages for all channels the user has joined.
     * </aside>
     *
     * @authenticated
     *
     * @queryParam since required The `message_id` of the last message to retrieve messages since
     * @queryParam channel_id If provided, will only return messages for the given channel
     * @queryParam limit number of messages to return (max of 50)
     *
     * @response {
     *   "presence": [
     *     {
     *       "channel_id": 5,
     *       "name": "#osu",
     *       "description": "The official osu! channel (english only).",
     *       "type": "public",
     *       "last_read_id": 9150005005,
     *       "last_message_id": 9150005005
     *     },
     *     {
     *       "channel_id": 12345,
     *       "type": "PM",
     *       "name": "peppy",
     *       "icon": "https://a.ppy.sh/2?1519081077.png",
     *       "users": [
     *         2,
     *         102
     *       ],
     *       "last_read_id": 9150001235,
     *       "last_message_id": 9150001234
     *     }
     *   ],
     *   "messages": [
     *     {
     *       "message_id": 9150005004,
     *       "sender_id": 2,
     *       "channel_id": 5,
     *       "timestamp": "2018-07-06T06:33:34+00:00",
     *       "content": "i am a lazerface",
     *       "is_action": 0,
     *       "sender": {
     *         "id": 2,
     *         "username": "peppy",
     *         "profile_colour": "#3366FF",
     *         "avatar_url": "https://a.ppy.sh/2?1519081077.png",
     *         "country_code": "AU",
     *         "is_active": true,
     *         "is_bot": false,
     *         "is_online": true,
     *         "is_supporter": true
     *       }
     *     },
     *     {
     *       "message_id": 9150005005,
     *       "sender_id": 102,
     *       "channel_id": 5,
     *       "timestamp": "2018-07-06T06:33:42+00:00",
     *       "content": "uh ok then",
     *       "is_action": 0,
     *       "sender": {
     *         "id": 102,
     *         "username": "nekodex",
     *         "profile_colour": "#333333",
     *         "avatar_url": "https://a.ppy.sh/102?1500537068",
     *         "country_code": "AU",
     *         "is_active": true,
     *         "is_bot": false,
     *         "is_online": true,
     *         "is_supporter": true
     *       }
     *     }
     *   ]
     * }
     */
    public function updates()
    {
        if (!present(Request::input('since'))) {
            abort(422);
        }

        $presence = self::presence();

        $since = Request::input('since');
        $limit = clamp(get_int(Request::input('limit')) ?? 50, 1, 50);

        // this is used to filter out messages from restricted users/etc
        $channelIds = array_map(function ($e) {
            return $e['channel_id'];
        }, $presence);

        $messages = Message::forUser(Auth::user())
            ->with('sender')
            ->whereIn('channel_id', $channelIds)
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
            'presence' => $presence,
            'messages' => json_collection(
                $messages,
                'Chat\Message',
                ['sender']
            ),
        ];

        return $response;
    }

    /**
     * @group Undocumented
     */
    public function presence()
    {
        return UserChannel::presenceForUser(Auth::user());
    }

    /**
     * Create New PM
     *
     * This endpoint allows you to create a new PM channel.
     *
     * ---
     *
     * ### Response Format
     *
     * Field            | Type
     * ---------------- | -----------------
     * new_channel_id   | `channel_id` of newly created [ChatChannel](#chatchannel)
     * presence         | array of [ChatChannel](#chatchannel)
     * message          | the sent [ChatMessage](#chatmessage)
     *
     * <aside class="notice">
     *   This endpoint will only allow the creation of PMs initially, group chat support will come later.
     * </aside>
     *
     * @authenticated
     *
     * @bodyParam target_id integer required `user_id` of user to start PM with
     * @bodyParam message string required message to send
     * @bodyParam is_action boolean required whether the message is an action
     *
     * @response {
     *   "new_channel_id": 1234,
     *   "presence": [
     *     {
     *       "channel_id": 5,
     *       "name": "#osu",
     *       "description": "The official osu! channel (english only).",
     *       "type": "public",
     *       "last_read_id": 9150005005,
     *       "last_message_id": 9150005005
     *     },
     *     {
     *       "channel_id": 1234,
     *       "type": "PM",
     *       "name": "peppy",
     *       "icon": "https://a.ppy.sh/2?1519081077.png",
     *       "users": [
     *         2,
     *         102
     *       ],
     *       "last_read_id": 9150001235,
     *       "last_message_id": 9150001234
     *     }
     *   ],
     *   "message": {
     *     "message_id": 9150005005,
     *     "sender_id": 102,
     *     "channel_id": 1234,
     *     "timestamp": "2018-07-06T06:33:42+00:00",
     *     "content": "i can haz featured artist plz?",
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
     * }
     */
    public function newConversation()
    {
        $params = request()->all();

        $message = Chat::sendPrivateMessage(
            auth()->user(),
            get_int($params['target_id'] ?? null),
            presence($params['message'] ?? null),
            get_bool($params['is_action'] ?? null)
        );

        return [
            'new_channel_id' => $message->channel_id,
            'message' => json_item(
                $message,
                'Chat/Message',
                ['sender']
            ),
            'presence' => self::presence(),
        ];
    }
}
