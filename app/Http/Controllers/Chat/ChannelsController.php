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

use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
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
     * @authenticated
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
            'Chat/Channel'
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
     * @authenticated
     *
     * @response {
     *   "channel_id": 5,
     *   "name": "#osu",
     *   "description": "The official osu! channel (english only).",
     *   "type": "public"
     * }
     */
    public function join($channel_id, $user_id)
    {
        $channel = Channel::where('channel_id', $channel_id)->firstOrFail();

        priv_check('ChatChannelJoin', $channel)->ensureCan();

        if (Auth::user()->user_id !== get_int($user_id)) {
            abort(403);
        }

        if (!$channel->hasUser(Auth::user())) {
            $channel->addUser(Auth::user());
        }

        return response([], 204);
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
     * @authenticated
     *
     * @response 204
     */
    public function part($channel_id, $user_id)
    {
        $channel = Channel::where('channel_id', $channel_id)->firstOrFail();

        // TODO: the order of these check seems wrong?
        // FIXME: doesn't seem right authorizing leaving channel
        priv_check('ChatChannelPart', $channel)->ensureCan();

        if (Auth::user()->user_id !== get_int($user_id)) {
            abort(403);
        }

        $channel->removeUser(Auth::user());

        return response([], 204);
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
     * @authenticated
     *
     * @queryParam channel_id required The `channel_id` of the channel to mark as read
     * @queryParam message_id required The `message_id` of the message to mark as read up to
     *
     * @response 204
     */
    public function markAsRead($channel_id, $message_id)
    {
        UserChannel::where([
            'user_id' => Auth::user()->user_id,
            'channel_id' => $channel_id
        ])
        ->firstOrFail()
        ->markAsRead(get_int($message_id));

        return response([], 204);
    }
}
