<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Cache;

class LivestreamCollection
{
    const FEATURED_CACHE_KEY = 'featuredStream:arr:v2';

    private $streams;

    public static function promote($id)
    {
        Cache::forever(static::FEATURED_CACHE_KEY, (string) $id);
    }

    public function all()
    {
        if ($this->streams === null) {
            $this->streams = Cache::remember('livestreams:arr:v2', 300, function () {
                $streams = $this->downloadStreams()['data'] ?? [];

                $userIds = array_map(function ($stream) {
                    return $stream['user_id'];
                }, $streams);

                $users = [];

                foreach ($this->downloadUsers($userIds)['data'] ?? [] as $user) {
                    $users[$user['id']] = $user;
                }

                return array_map(function ($stream) use ($users) {
                    return new Twitch\Stream($stream, $users[$stream['user_id']]);
                }, $streams);
            });
        }

        return $this->streams;
    }

    public function downloadStreams()
    {
        return $this->download('streams?first=40&game_id=21465');
    }

    public function downloadUsers($userIds)
    {
        if (count($userIds) === 0) {
            return;
        }

        return $this->download('users?id='.implode('&id=', $userIds));
    }

    public function download($api)
    {
        $url = "https://api.twitch.tv/helix/{$api}";
        $clientId = config('osu.twitch_client_id');
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => [
                "Client-ID: {$clientId}",
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_FAILONERROR => true,
        ]);

        // TODO: error handling
        $response = curl_exec($ch);

        if (curl_errno($ch) === CURLE_OK) {
            $return = json_decode($response, true);
        } else {
            $return = null;
        }

        curl_close($ch);

        return $return;
    }

    public function featured()
    {
        $featuredStreamId = presence((string) Cache::get(static::FEATURED_CACHE_KEY));

        if ($featuredStreamId !== null) {
            foreach ($this->all() as $stream) {
                if ($stream->data['id'] === $featuredStreamId) {
                    return $stream;
                }
            }
        }
    }
}
