<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\API;
use App\Models\Chat\Channel;
use App\Models\User;
use ChaseConey\LaravelDatadogHelper\Datadog;

class Chat
{
    // Do the restricted user lookup before calling this.
    public static function sendPrivateMessage(User $sender, User $target, $message, $isAction)
    {
        if ($target->is($sender)) {
            abort(422, "can't send message to same user");
        }

        priv_check_user($sender, 'ChatPmStart', $target)->ensureCan();

        return (new Channel())->getConnection()->transaction(function () use ($sender, $target, $message, $isAction) {
            $channel = Channel::findPM($target, $sender);

            $newChannel = $channel === null;

            if ($newChannel) {
                $channel = Channel::createPM($target, $sender);
            } else {
                $channel->addUser($sender);
            }

            $ret = static::sendMessage($sender, $channel, $message, $isAction);

            if ($newChannel) {
                Datadog::increment('chat.channel.create', 1, ['type' => $channel->type]);
            }

            return $ret;
        });
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
