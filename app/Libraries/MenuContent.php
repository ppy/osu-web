<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;

class MenuContent
{
    /**
     * Get all active menu content images.
     *
     * @return array<string, mixed>[]
     */
    public static function activeImages(): array
    {
        return cache_remember_mutexed('menu-content-active-images', 60, [], function () {
            $images = self::parse(self::fetch());
            $now = Carbon::now();

            return array_values(array_filter($images, fn ($image) => (
                ($image['started_at']?->lessThanOrEqualTo($now) ?? true)
                    && ($image['ended_at']?->greaterThan($now) ?? true)
            )));
        });
    }

    private static function fetch(): array
    {
        $response = (new Client())
            ->get(osu_url('menu_content'))
            ->getBody()
            ->getContents();

        return json_decode($response, true);
    }

    private static function parse(array $data): array
    {
        if (!is_array($data['images'] ?? null)) {
            throw new Exception('Invalid "images" key in menu-content response');
        }

        $parsedImages = [];

        foreach ($data['images'] as $image) {
            if (!is_string($image['image']) || !is_string($image['url'])) {
                throw new Exception('Invalid "image" or "url" key in menu-content image');
            }

            $parsedImages[] = [
                'ended_at' => parse_time_to_carbon($image['expires']),
                'image_url' => $image['image'],
                'started_at' => parse_time_to_carbon($image['begins']),
                'url' => $image['url'],
            ];
        }

        return $parsedImages;
    }
}
