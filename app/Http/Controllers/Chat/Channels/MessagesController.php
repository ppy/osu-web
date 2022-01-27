<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Chat\Channels;

use App\Http\Controllers\Chat\Controller as BaseController;
use App\Libraries\Chat;
use App\Models\Chat\Channel;
use App\Transformers\Chat\MessageTransformer;
use App\Transformers\UserTransformer;

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
     * @urlParam channel integer required The ID of the channel to retrieve messages for
     * @queryParam limit integer number of messages to return (max of 50)
     * @queryParam since integer messages after the specified message id will be returned
     * @queryParam until integer messages up to but not including the specified message id will be returned
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
        [
            'limit' => $limit,
            'return_object' => $returnObject,
            'since' => $since,
            'until' => $until,
        ] = get_params(request()->all(), null, [
            'limit:int',
            'return_object:bool',
            'since:int',
            'until:int',
        ], ['null_missing' => true]);

        $limit = clamp($limit ?? 50, 1, 50);
        $user = auth()->user();

        $channel = Channel::findOrFail($channelId);
        if (!$channel->hasUser($user)) {
            abort(404);
        }

        if ($channel->isPM()) {
            // restricted users should be treated as if they do not exist
            if (optional($channel->pmTargetFor($user))->isRestricted()) {
                abort(404);
            }
        }

        $messages = $channel
            ->filteredMessages()
            ->with('sender')
            ->limit($limit);

        if (present($since)) {
            $messages = $messages->where('message_id', '>', $since)
                ->orderBy('message_id', 'asc')
                ->get();
        } else {
            if (present($until)) {
                $messages->where('message_id', '<', $until);
            }

            $messages = $messages->orderBy('message_id', 'desc')->get()->reverse();
        }

        if (!$returnObject) {
            return json_collection(
                $messages,
                new MessageTransformer(),
                ['sender']
            );
        }

        return [
            'messages' => json_collection($messages, new MessageTransformer()),
            'users' => json_collection(
                $messages->pluck('sender')->uniqueStrict('user_id')->values(),
                new UserTransformer()
            ),
        ];
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
     * @urlParam channel integer required The `channel_id` of the channel to send message to
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
        $params = get_params(request()->all(), null, [
            'is_action:bool',
            'message',
            'uuid',
        ], ['null_missing' => true]);

        $message = Chat::sendMessage(
            auth()->user(),
            Channel::findOrFail(get_int($channelId)),
            $params['message'],
            $params['is_action'] ?? false,
            $params['uuid']
        );

        return json_item(
            $message,
            new MessageTransformer(),
            ['sender']
        );
    }
}
