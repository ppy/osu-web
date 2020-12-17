<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Illuminate\Broadcasting\Broadcasters\RedisBroadcaster as LaravelRedisBroadcaster;
use Illuminate\Support\Arr;

/**
 * This is basically
 * https://github.com/laravel/framework/blob/e113e14c3f6880b523379c0bba09a474785c36b2/src/Illuminate/Broadcasting/Broadcasters/RedisBroadcaster.php#L102-L150
 * and can be removed after our Laravel version is updated.
 */
class RedisBroadcaster extends LaravelRedisBroadcaster
{
    /**
     * {@inheritdoc}
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
        if (empty($channels)) {
            return;
        }

        $connection = $this->redis->connection($this->connection);

        $payload = json_encode([
            'event' => $event,
            'data' => $payload,
            'socket' => Arr::pull($payload, 'socket'),
        ]);

        $connection->eval(
            $this->broadcastMultipleChannelsScript(),
            0,
            $payload,
            ...$this->formatChannels($channels)
        );
    }

    /**
     * Get the Lua script for broadcasting to multiple channels.
     *
     * ARGV[1] - The payload
     * ARGV[2...] - The channels
     *
     * @return string
     */
    protected function broadcastMultipleChannelsScript()
    {
        return <<<'LUA'
for i = 2, #ARGV do
  redis.call('publish', ARGV[i], ARGV[1])
end
LUA;
    }

    /**
     * Format the channel array into an array of strings.
     *
     * @param  array  $channels
     * @return array
     */
    protected function formatChannels(array $channels)
    {
        return array_map(function ($channel) {
            return $this->prefix.$channel;
        }, parent::formatChannels($channels));
    }
}
