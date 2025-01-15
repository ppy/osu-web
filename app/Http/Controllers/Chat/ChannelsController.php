<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Chat;

use App\Libraries\Chat;
use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;
use App\Transformers\Chat\ChannelTransformer;
use App\Transformers\UserCompactTransformer;
use Auth;

/**
 * @group Chat
 */
class ChannelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:chat.read', ['only' => ['index', 'markAsRead', 'show']]);
        $this->middleware('require-scopes:chat.write_manage', ['only' => ['part', 'join', 'store']]);

        parent::__construct();
    }

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
     *     "description": "The official osu! channel (english only).",
     *     "icon": "https://a.ppy.sh/2?1519081077.png",
     *     "moderated": false,
     *     "name": "#osu",
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
     * This endpoint allows you to join a public or multiplayer channel.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns the joined [ChatChannel](#chatchannel).
     *
     * @response {
     *   "channel_id": 5,
     *   "current_user_attributes": {
     *     "can_message": true,
     *     "can_message_error": null
     *   },
     *   "description": "The official osu! channel (english only).",
     *   "icon": "https://a.ppy.sh/2?1519081077.png",
     *   "last_message_id": 1029,
     *   "moderated": false,
     *   "name": "#osu",
     *   "type": "public"
     *   "users": []
     * }
     */
    public function join($channelId, $userId)
    {
        $channel = Channel::where('channel_id', $channelId)->firstOrFail();
        $currentUser = auth()->user();

        priv_check('ChatChannelJoin', $channel)->ensureCan();

        if ($currentUser->getKey() !== get_int($userId)) {
            abort(403);
        }

        $channel->addUser($currentUser);

        return json_item($channel, ChannelTransformer::forUser($currentUser), ChannelTransformer::LISTING_INCLUDES);
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
     * @urlParam channel integer required `channel_id` of the [ChatChannel](#chatchannel) to leave.
     * @urlParam user integer required `id` of the [User](#user) to leave the channel.
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
     * users   | [User](#user)               | Users are only visible for PM channels.
     *
     * @urlParam channel integer required `channel_id` of the [ChatChannel](#chatchannel) to get.
     *
     * @response {
     *   "channel": {
     *     "channel_id": 1337,
     *     "current_user_attributes": {
     *       "can_message": true,
     *       "can_message_error": null
     *     },
     *     "name": "test channel",
     *     "description": "wheeeee",
     *     "icon": "/images/layout/avatar-guest@2x.png",
     *     "type": "PM",
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
     *
     */
    public function show($channelId)
    {
        $channel = Channel::where('channel_id', $channelId)->firstOrFail();
        $user = auth()->user();

        if (!$channel->hasUser($user)) {
            abort(404);
        }

        return [
            'channel' => json_item($channel, ChannelTransformer::forUser($user), ChannelTransformer::LISTING_INCLUDES),
            // TODO: probably going to need a better way to list/fetch/update users on larger channels without sending user on every message.
            'users' => json_collection(
                $channel->visibleUsers()->loadMissing(UserCompactTransformer::CARD_INCLUDES_PRELOAD),
                new UserCompactTransformer(),
                UserCompactTransformer::CARD_INCLUDES
            ),
        ];
    }

    /**
     * Create Channel
     *
     * Creates a new PM or announcement channel.
     * Rejoins the PM channel if it already exists.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [ChatChannel](#chatchannel) with `recent_messages` attribute; `recent_messages` is deprecated and should not be used.
     *
     * @bodyParam channel object channel details; required if `type` is `ANNOUNCE`. No-example
     * @bodyParam channel.name string the channel name; required if `type` is `ANNOUNCE`. No-example
     * @bodyParam channel.description string the channel description; required if `type` is `ANNOUNCE`. No-example
     * @bodyParam message string message to send with the announcement; required if `type` is `ANNOUNCE`. No-example
     * @bodyParam target_id integer target user id; required if `type` is `PM`; ignored, otherwise. Example: 2
     * @bodyParam target_ids integer[] target user ids; required if `type` is `ANNOUNCE`; ignored, otherwise. No-example
     * @bodyParam type string required channel type (currently only supports `PM` and `ANNOUNCE`) Example: PM
     *
     * @response {
     *   "channel_id": 1,
     *   "description": "best channel",
     *   "icon": "https://a.ppy.sh/2?1519081077.png",
     *   "moderated": false,
     *   "name": "#pm_1-2",
     *   "type": "PM",
     *   "recent_messages": [
     *     {
     *       "message_id": 1,
     *       "sender_id": 1,
     *       "channel_id": 1,
     *       "timestamp": "2020-01-01T00:00:00+00:00",
     *       "content": "Happy new year",
     *       "is_action": false,
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
     *     }
     *   ]
     * }
     */
    public function store()
    {
        $params = get_params(request()->all(), null, [
            'channel:any',
            'message:string',
            'target_id:int',
            'target_ids:int[]',
            'type:string',
            'uuid',
        ], ['null_missing' => true]);

        $sender = auth()->user();

        if ($params['type'] === Channel::TYPES['pm']) {
            abort_if($params['target_id'] === null, 422, 'missing target_id parameter');

            $target = User::findOrFail($params['target_id']);

            priv_check('ChatPmStart', $target)->ensureCan();

            $channel = Channel::findPM($sender, $target) ?? new Channel();

            if ($channel->exists) {
                $channel->addUser($sender);
            }
        } else if ($params['type'] === Channel::TYPES['announce']) {
            $channel = Chat::createAnnouncement($sender, $params);
        }

        if (isset($channel)) {
            // TODO: recent_messages deprecated.
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
     * @urlParam channel integer required The `channel_id` of the [ChatChannel](#chatchannel) to mark as read.
     * @urlParam message integer required The `message_id` of the [ChatMessage](#chatmessage) to mark as read up to.
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
