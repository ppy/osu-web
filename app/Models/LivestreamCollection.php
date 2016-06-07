<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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
    const FEATURED_CACHE_KEY = 'featuredStream';

    private $streams;

    public static function promote($id)
    {
        Cache::forever(static::FEATURED_CACHE_KEY, (string) $id);
    }

    public function all()
    {
        if ($this->streams === null) {
            $this->streams = Cache::remember('livestreams', 5, function () {
                return $this->download()->streams;
            });
        }

        return $this->streams;
    }

    public function download()
    {
        $streamsApi = 'https://api.twitch.tv/kraken/streams?on_site=1&limit=40&offset=0&game=Osu!';
        $clientId = config('osu.twitch_client_id');
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => [
                "Client-ID: {$clientId}",
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $streamsApi,
        ]);

        // TODO: error handling
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function featured()
    {
        $featuredStreamId = presence((string) Cache::get(static::FEATURED_CACHE_KEY));

        if ($featuredStreamId !== null) {
            foreach ($this->all() as $stream) {
                if ((string) $stream->_id !== $featuredStreamId) {
                    continue;
                }

                $featuredStream = $stream;
                break;
            }
        }

        return $featuredStream ?? null;
    }
}
