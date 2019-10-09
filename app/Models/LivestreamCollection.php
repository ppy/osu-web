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
