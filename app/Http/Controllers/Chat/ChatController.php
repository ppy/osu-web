<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Chat;

use App\Libraries\Chat;
use App\Libraries\UserChannelList;
use App\Models\Chat\Message;
use App\Models\User;
use App\Models\UserAccountHistory;
use App\Transformers\Chat\ChannelTransformer;
use App\Transformers\Chat\MessageTransformer;
use App\Transformers\Chat\UserSilenceTransformer;
use Ds\Set;

/**
 * @group Chat
 */
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:chat.write', ['only' => 'newConversation']);
        $this->middleware('auth');

        return parent::__construct();
    }

    public function ack()
    {
        Chat::ack(auth()->user());

        $params = get_params(request()->all(), null, [
            'history_since:int',
            'since:int',
        ], ['null_missing' => true]);

        return [
            'silences' => json_collection($this->getSilences($params['history_since'], $params['since']), new UserSilenceTransformer()),
        ];
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
     * @bodyParam target_id integer required `user_id` of user to start PM with
     * @bodyParam message string required message to send
     * @bodyParam is_action boolean required whether the message is an action
     *
     * @response {
     *   "channel": [
     *     {
     *       "channel_id": 1234,
     *       "current_user_attributes": {
     *         "can_message": true,
     *         "last_read_id": 9150005005
     *       },
     *       "name": "peppy",
     *       "description": "",
     *       "type": "PM",
     *       "last_read_id": 9150005005,
     *       "last_message_id": 9150005005
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
     *   },
     *   "new_channel_id": 1234,
     * }
     */
    public function newConversation()
    {
        $params = get_params(request()->all(), null, [
            'is_action:bool',
            'message',
            'target_id:int',
        ], ['null_missing' => true]);

        $target = User::lookup($params['target_id'], 'id');
        if ($target === null) {
            abort(422, 'target user not found');
        }

        $sender = auth()->user();

        /** @var Message $message */
        $message = Chat::sendPrivateMessage(
            $sender,
            $target,
            $params['message'],
            $params['is_action']
        );

        $channelJson = json_item($message->channel, ChannelTransformer::forUser($sender), ChannelTransformer::CONVERSATION_INCLUDES);

        return [
            'channel' => $channelJson,
            'message' => json_item(
                $message,
                new MessageTransformer(),
                ['sender']
            ),
            'new_channel_id' => $message->channel_id,
        ];
    }

    // TODO: I don't think anything actually calls this?
    /**
     * @group Undocumented
     */
    public function presence()
    {
        return (new UserChannelList(auth()->user()))->get();
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
     * messages         | [ChatMessage](#chatmessage)[]?
     * presence         | [ChatChannel](#chatchannel)[]?
     * silences         | [UserSilence](#usersilence)[]?
     *
     * <aside class="notice">
     *   Note that this returns messages for all channels the user has joined unless specified.
     * </aside>
     *
     * @queryParam channel_id integer If provided, will only return messages for the given channel the user is in.
     * @queryParam history_since integer [UserSilence](#usersilence) after the specified id to return.
     * @queryParam includes string[] List of `presence`, `messages`, `silences` fields to include in the response. Returns all if not specified.
     * @queryParam limit integer Maximum number of messages to return (max of 50).
     * @queryParam since integer required Messages after the specified `message_id` to return.
     *
     * @response {
     *   "presence": [
     *     {
     *       "channel_id": 5,
     *       "current_user_attributes": {
     *         "can_message": true,
     *         "last_read_id": 9150005005
     *       },
     *       "name": "#osu",
     *       "description": "The official osu! channel (english only).",
     *       "type": "public",
     *       "last_read_id": 9150005005,
     *       "last_message_id": 9150005005
     *     },
     *     {
     *       "channel_id": 12345,
     *       "current_user_attributes": {
     *         "can_message": true,
     *         "last_read_id": 9150001235
     *       },
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
     *   ],
     *   "silences": [
     *      {
     *        "id": 1,
     *        "user_id": 2
     *      }
     *   ]
     * }
     */
    public function updates()
    {
        static $availableIncludes;
        $availableIncludes ??= new Set(['messages', 'presence', 'silences']);

        $params = get_params(request()->all(), null, [
            'channel_id:int',
            'history_since:int',
            'includes:array',
            'limit:int',
            'since:int',
        ], ['null_missing' => true]);

        if ($params['since'] === null) {
            abort(422);
        }

        $includes = $params['includes'] !== null
            ? $availableIncludes->intersect(new Set($params['includes']))
            : $availableIncludes;

        $includeMessages = $includes->contains('messages');
        $includePresence = $includes->contains('presence');
        $includeSilences = $includes->contains('silences');

        $since = $params['since'];
        $limit = clamp($params['limit'] ?? 50, 1, 50);

        $response = [];

        // messages need presence
        if ($includeMessages || $includePresence) {
            $presence = $this->presence();
        }

        if ($includeMessages) {
            $channelIds = array_pluck($presence, 'channel_id');
            if ($params['channel_id'] !== null) {
                $channelIds = array_values(array_intersect($channelIds, [$params['channel_id']]));
            }

            $messages = Message
                ::with('sender')
                ->whereIn('channel_id', $channelIds)
                ->since($since)
                ->limit($limit)
                ->orderBy('message_id', 'DESC')
                ->get()
                ->reverse();

            $response['messages'] = json_collection($messages, new MessageTransformer(), ['sender']);
        }

        if ($includeSilences) {
            $silenceQuery = UserAccountHistory::bans()->limit(100);
            $lastHistoryId = $params['history_since'];

            if ($lastHistoryId === null) {
                $previousMessage = Message::where('message_id', '<=', $since)->last();

                if ($previousMessage === null) {
                    $silenceQuery->none();
                } else {
                    $silenceQuery->where('timestamp', '>', $previousMessage->timestamp);
                }
            } else {
                $silenceQuery->where('ban_id', '>', $lastHistoryId)->reorderBy('ban_id', 'DESC');
            }

            $silences = $silenceQuery->get();

            $response['silences'] = json_collection($silences, new UserSilenceTransformer());
        }

        if ($includePresence) {
            // to match old behaviour (204 when no messages and no silences); doesn't apply if messages not requested.
            $response['presence'] = $includeMessages && $messages->isEmpty() && $includeSilences && $silences->isEmpty()
                ? []
                : $presence;
        }

        $hasAny = array_first($response, fn ($val) => count($val) > 0) !== null;

        return $hasAny ? $response : response()->noContent();
    }

    private function getSilences(?int $lastHistoryId, ?int $since)
    {
        $silenceQuery = UserAccountHistory::bans()->limit(100);

        if ($lastHistoryId === null) {
            $previousMessage = Message::where('message_id', '<=', $since)->last();

            if ($previousMessage === null) {
                $silenceQuery->none();
            } else {
                $silenceQuery->where('timestamp', '>', $previousMessage->timestamp);
            }
        } else {
            $silenceQuery->where('ban_id', '>', $lastHistoryId)->reorderBy('ban_id', 'DESC');
        }

        return $silenceQuery->get();
    }
}
