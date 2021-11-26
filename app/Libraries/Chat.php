<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Events\ChatChannelEvent;
use App\Exceptions\API;
use App\Exceptions\InvariantException;
use App\Models\Chat\Channel;
use App\Models\User;
use ChaseConey\LaravelDatadogHelper\Datadog;
use Illuminate\Support\Collection;
use LaravelRedis as Redis;

class Chat
{
    public static function ack(User $user)
    {
        $channelIds = $user->channels()->public()->pluck((new Channel())->qualifyColumn('channel_id'));
        $timestamp = time();
        $transaction = Redis::transaction();

        foreach ($channelIds as $channelId) {
            $key = Channel::getAckKey($channelId);
            $transaction->zadd($key, $timestamp, $user->getKey());
            $transaction->expire($key, Channel::CHAT_ACTIVITY_TIMEOUT * 10);
        }

        $transaction->exec();
    }

    /**
     * Creates a chat broadcast Channel and associated UserChannels.
     *
     * @param Collection $users
     * @param array $rawParams
     * @return Channel
     */
    public static function createBroadcastChannel(Collection $users, array $rawParams): Channel
    {
        $params = get_params($rawParams, 'channel', [
            'description:string',
            'name:string',
        ], ['null_missing' => true]);

        $params['moderated'] = true;
        $params['type'] = 'BROADCAST';

        $channel = new Channel($params);
        $channel->getConnection()->transaction(function () use ($channel, $users) {
            $channel->save();
            $userChannels = $channel->userChannels()->createMany($users->map(fn ($user) => ['user_id' => $user->getKey()]));
            foreach ($userChannels as $userChannel) {
                // preset to avoid extra queries during permission check.
                $userChannel->setRelation('channel', $channel);
                $userChannel->channel->setUserChannel($userChannel);
            }
        });

        return $channel;
    }

    public static function createBroadcast(User $sender, array $rawParams, ?string $uuid = null)
    {
        priv_check_user($sender, 'ChatBroadcast')->ensureCan();

        $params = get_params($rawParams, null, [
            'channel:any',
            'message:string',
            'target_ids:int[]',
        ], ['null_missing' => true]);

        if (!isset($params['target_ids'])) {
            throw new InvariantException('missing target_ids parameter');
        }

        if (!isset($rawParams['channel'])) {
            throw new InvariantException('missing channel parameter');
        }

        $users = User::whereIn('user_id', $params['target_ids'])->get();
        if ($users->isEmpty()) {
            throw new InvariantException('Nobody to broadcast to!');
        }

        $users = $users->push($sender)->uniqueStrict('user_id');

        $channel = (new Channel())->getConnection()->transaction(function () use ($sender, $params, $users, $uuid) {
            $channel = static::createBroadcastChannel($users, $params['channel']);
            static::sendMessage($sender, $channel, $params['message'], false, $uuid);

            return $channel;
        });

        // TODO: this event should be sent before the message.
        foreach ($users as $user) {
            event(new ChatChannelEvent($channel, $user, 'join'));
        }

        Datadog::increment('chat.channel.create', 1, ['type' => $channel->type]);

        return $channel;
    }

    // Do the restricted user lookup before calling this.
    public static function sendPrivateMessage(User $sender, User $target, ?string $message, ?bool $isAction, ?string $uuid = null)
    {
        if ($target->is($sender)) {
            abort(422, "can't send message to same user");
        }

        priv_check_user($sender, 'ChatPmStart', $target)->ensureCan();

        return (new Channel())->getConnection()->transaction(function () use ($sender, $target, $message, $isAction, $uuid) {
            $channel = Channel::findPM($target, $sender);

            $newChannel = $channel === null;

            if ($newChannel) {
                $channel = Channel::createPM($target, $sender);
            } else {
                $channel->addUser($sender);
            }

            $ret = static::sendMessage($sender, $channel, $message, $isAction, $uuid);

            if ($newChannel) {
                Datadog::increment('chat.channel.create', 1, ['type' => $channel->type]);
            }

            return $ret;
        });
    }

    public static function sendMessage(User $sender, Channel $channel, ?string $message, ?bool $isAction, ?string $uuid = null)
    {
        if ($channel->isPM()) {
            // restricted users should be treated as if they do not exist
            if (optional($channel->pmTargetFor($sender))->isRestricted()) {
                abort(404, 'target user not found');
            }
        }

        priv_check_user($sender, 'ChatChannelSend', $channel)->ensureCan();

        try {
            return $channel->receiveMessage($sender, $message, $isAction ?? false, $uuid);
        } catch (API\ChatMessageEmptyException $e) {
            abort(422, $e->getMessage());
        } catch (API\ChatMessageTooLongException $e) {
            abort(422, $e->getMessage());
        } catch (API\ExcessiveChatMessagesException $e) {
            abort(429, $e->getMessage());
        }
    }
}
