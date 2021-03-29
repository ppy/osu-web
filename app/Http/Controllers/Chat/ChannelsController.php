<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Chat;

use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;
use App\Transformers\Chat\ChannelTransformer;
use Auth;

/**
 * @group Chat
 */
class ChannelsController extends Controller
{
    /**
     * Get Channel List
     *
     * This endpoint returns a list of all joinable public channels.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns an array of [ChatChannel](#chatchannel)
     *
     * @response [
     *   {
     *     "channel_id": 5,
     *     "name": "#osu",
     *     "description": "The official osu! channel (english only).",
     *     "type": "public"
     *   }
     * ]
     */
    public function index()
    {
        return json_collection(
            Channel::public()->get(),
            ChannelTransformer::forUser(auth()->user())
        );
    }

    /**
     * Join Channel
     *
     * This endpoint allows you to join a public channel.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns the joined [ChatChannel](#chatchannel).
     *
     * <aside class="notice">
     *   This endpoint will only allow the joining of public channels initially.
     * </aside>
     *
     * @response {
     *   "channel_id": 5,
     *   "name": "#osu",
     *   "description": "The official osu! channel (english only).",
     *   "type": "public"
     * }
     */
    public function join($channelId, $userId)
    {
        $channel = Channel::where('channel_id', $channelId)->firstOrFail();
        $user = auth()->user();

        priv_check('ChatChannelJoin', $channel)->ensureCan();

        if ($user->user_id !== get_int($userId)) {
            abort(403);
        }

        if (!$channel->hasUser($user)) {
            $channel->addUser($user);
        }

        return json_item($channel, ChannelTransformer::forUser($user), ['first_message_id', 'last_message_id', 'users']);
    }

    /**
     * Leave Channel
     *
     * This endpoint allows you to leave a public channel.
     *
     * ---
     *
     * ### Response Format
     *
     * _empty response_
     *
     * <aside class="notice">
     *   This endpoint will only allow the leaving of public channels initially.
     * </aside>
     *
     * @response 204
     */
    public function part($channelId, $userId)
    {
        $channel = Channel::where('channel_id', $channelId)->firstOrFail();

        // TODO: the order of these check seems wrong?
        // FIXME: doesn't seem right authorizing leaving channel
        priv_check('ChatChannelPart', $channel)->ensureCan();

        if (Auth::user()->user_id !== get_int($userId)) {
            abort(403);
        }

        $channel->removeUser(Auth::user());

        return response([], 204);
    }

    /**
     * Get Channel
     *
     * Gets details of a chat channel.
     *
     * ---
     *
     * ### Response Format
     *
     * Field   | Type                        | Description
     * ------- | --------------------------- | -----------
     * channel | [ChatChannel](#chatchannel) | |
     * users   | [UserCompact](#usercompact) | Users are only visible for PM channels.
     *
     * @response {
     *   "channel": {
     *     "channel_id": 1337,
     *     "name": "test channel",
     *     "description": "wheeeee",
     *     "icon": "/images/layout/avatar-guest@2x.png",
     *     "type": "PM",
     *     "first_message_id": 10,
     *     "last_read_id": 9150005005,
     *     "last_message_id": 9150005005,
     *     "moderated": false,
     *     "users": [
     *       2,
     *       102
     *     ]
     *   },
     *   "users": [
     *     {
     *       "id": 2,
     *       "username": "peppy",
     *       "profile_colour": "#3366FF",
     *       "avatar_url": "https://a.ppy.sh/2?1519081077.png",
     *       "country_code": "AU",
     *       "is_active": true,
     *       "is_bot": false,
     *       "is_deleted": false,
     *       "is_online": true,
     *       "is_supporter": true
     *     },
     *     {
     *       "id": 102,
     *       "username": "lambchop",
     *       "profile_colour": "#3366FF",
     *       "icon": "/images/layout/avatar-guest@2x.png",
     *       "country_code": "NZ",
     *       "is_active": true,
     *       "is_bot": false,
     *       "is_deleted": false,
     *       "is_online": false,
     *       "is_supporter": false
     *     }
     *   ]
     * }
     */
    public function show($channelId)
    {
        $channel = Channel::where('channel_id', $channelId)->firstOrFail();

        priv_check('ChatChannelRead', $channel)->ensureCan();

        return [
            'channel' => json_item($channel, ChannelTransformer::forUser(auth()->user()), ['first_message_id', 'last_message_id', 'users']),
            // TODO: probably going to need a better way to list/fetch/update users on larger channels without sending user on every message.
            'users' => json_collection($channel->visibleUsers(), 'UserCompact'),
        ];
    }

    /**
     * Create Channel
     *
     * This endpoint creates a new channel if doesn't exist and joins it.
     * Currently only for rejoining existing PM channels which the user has left.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [ChatChannel](#chatchannel) with `recent_messages` attribute.
     * Note that if there's no existing PM channel, most of the fields will be blank.
     * In that case, [send a message](#create-new-pm) instead to create the channel.
     *
     * @bodyParam type string required channel type (currently only supports "PM")
     * @bodyParam target_id integer target user id for type PM
     *
     * @response {
     *   "channel_id": 1,
     *   "name": "#pm_1-2",
     *   "description": "",
     *   "type": "PM",
     *   "recent_messages": [
     *     {
     *       "message_id": 1,
     *       "sender_id": 1,
     *       "channel_id": 1,
     *       "timestamp": "2020-01-01T00:00:00+00:00",
     *       "content": "Happy new year",
     *       "is_action": false
     *     }
     *   ]
     * }
     */
    public function store()
    {
        $params = get_params(request()->all(), null, [
            'target_id:number',
            'type:string',
        ], ['null_missing' => true]);

        $sender = auth()->user();

        if ($params['type'] === Channel::TYPES['pm']) {
            if ($params['target_id'] === null) {
                abort(422, 'missing target_id parameter');
            }

            $target = User::findOrFail($params['target_id']);

            priv_check('ChatStart', $target)->ensureCan();

            $channel = Channel::findPM($sender, $target) ?? new Channel();

            if ($channel->exists) {
                $channel->addUser($sender);
            }
        }

        if (isset($channel)) {
            return json_item($channel, ChannelTransformer::forUser($sender), ['recent_messages.sender']);
        } else {
            abort(422, 'unknown or missing type parameter');
        }
    }

    /**
     * Mark Channel as Read
     *
     * This endpoint marks the channel as having being read up to the given `message_id`.
     *
     * ---
     *
     * ### Response Format
     *
     * _empty response_
     *
     * <aside class="notice">
     *   Note that the read marker cannot be moved backwards - i.e. if a channel has been marked as read up to <code>message_id = 12</code>, you cannot then set it backwards to <code>message_id = 10</code>. It will be rejected.
     * </aside>
     *
     * @queryParam channel_id required The `channel_id` of the channel to mark as read
     * @queryParam message_id required The `message_id` of the message to mark as read up to
     *
     * @response 204
     */
    public function markAsRead($channelId, $messageId)
    {
        UserChannel::where([
            'user_id' => Auth::user()->user_id,
            'channel_id' => $channelId,
        ])
        ->firstOrFail()
        ->markAsRead(get_int($messageId));

        return response([], 204);
    }
}
