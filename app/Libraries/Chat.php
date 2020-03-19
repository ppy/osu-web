<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
