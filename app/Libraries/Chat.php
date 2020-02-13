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

namespace App\Libraries;

use App\Exceptions\API;
use App\Models\Chat\Channel;
use App\Models\User;
use ChaseConey\LaravelDatadogHelper\Datadog;
use DB;

class Chat
{
    public static function sendPrivateMessage($sender, $target, $message, $isAction)
    {
        if ($sender === null || $target === null) {
            abort(422);
        }

        if (!($sender instanceof User)) {
            $sender = User::findOrFail($sender);
        }

        if (!($target instanceof User)) {
            $target = User::lookup($target, 'id');

            if ($target === null) {
                // restricted users should be treated as if they do not exist
                abort(404, 'target user not found');
            }
        }

        if ($target->is($sender)) {
            abort(422, "can't send message to same user");
        }

        priv_check_user($sender, 'ChatStart', $target)->ensureCan();

        $channelName = Channel::getPMChannelName($target, $sender);
        $channel = Channel::where('name', $channelName)->first();

        if ($channel === null) {
            $channel = DB::transaction(function () use ($sender, $target, $channelName) {
                $channel = new Channel();
                $channel->name = $channelName;
                $channel->type = Channel::TYPES['pm'];
                $channel->description = ''; // description is not nullable
                $channel->save();

                $channel->addUser($sender);
                $channel->addUser($target);

                return $channel;
            });

            Datadog::increment('chat.channel.create', 1, ['type' => $channel->type]);
        }

        return static::sendMessage($sender, $channel, $message, $isAction);
    }

    public static function sendMessage($sender, $channel, $message, $isAction)
    {
        $isAction = $isAction ?? false;

        if (!($sender instanceof User)) {
            $sender = User::findOrFail($sender);
        }

        if (!($channel instanceof Channel)) {
            $channel = Channel::findOrFail($channel);
        }

        if (!present($message) || !is_string($message)) {
            abort(422, "can't send empty message");
        }

        if ($channel->isPM()) {
            // restricted users should be treated as if they do not exist
            if (optional($channel->pmTargetFor($sender))->isRestricted()) {
                abort(404, 'target user not found');
            }
        }

        priv_check_user($sender, 'ChatChannelSend', $channel)->ensureCan();

        try {
            return $channel->receiveMessage($sender, $message, $isAction);
        } catch (API\ChatMessageEmptyException $e) {
            abort(422, $e->getMessage());
        } catch (API\ChatMessageTooLongException $e) {
            abort(422, $e->getMessage());
        } catch (API\ExcessiveChatMessagesException $e) {
            abort(429, $e->getMessage());
        }
    }
}
