<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Cache;
use Exception;
use GuzzleHttp\Client;

class LivestreamCollection
{
    const FEATURED_CACHE_KEY = 'featuredStream:arr:v2';

    private $streams;
    private $token;

    public static function promote($id)
    {
        Cache::forever(static::FEATURED_CACHE_KEY, (string) $id);
    }

    public function all()
    {
        if ($this->streams === null) {
            $this->streams = cache_remember_mutexed('livestreams:arr:v2', 300, [], function () {
                $streams = $this->downloadStreams()['data'] ?? [];

                return array_map(function ($stream) {
                    return new Twitch\Stream($stream);
                }, $streams);
            });
        }

        return $this->streams;
    }

    public function downloadStreams()
    {
        return $this->download('streams?first=40&game_id=21465');
    }

    public function download($api)
    {
        $token = $this->token();

        if (empty($token)) {
            log_error(new Exception('failed getting token'));

            return;
        }

        try {
            $response = (new Client(['base_uri' => 'https://api.twitch.tv/helix/']))
                ->request('GET', $api, ['headers' => [
                    'Client-Id' => config('osu.twitch_client_id'),
                    'Authorization' => "Bearer {$token['access_token']}",
                ]])
                ->getBody()
                ->getContents();
        } catch (Exception $e) {
            log_error($e);

            return;
        }

        return json_decode($response, true);
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

    public function token()
    {
        if ($this->token === null) {
            try {
                $response = (new Client(['base_uri' => 'https://id.twitch.tv']))
                    ->request('POST', '/oauth2/token', ['query' => [
                        'client_id' => config('osu.twitch_client_id'),
                        'client_secret' => config('osu.twitch_client_secret'),
                        'grant_type' => 'client_credentials',
                    ]])
                    ->getBody()
                    ->getContents();

                $this->token = json_decode($response, true);
            } catch (Exception $e) {
                log_error($e);

                $this->token = [];
            }
        }

        return $this->token;
    }
}
