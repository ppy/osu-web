<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries\Search;

class QuickSearch extends MultiSearch
{
    const MODES = [
        'user' => [
            'type' => UserSearch::class,
            'paramsType' => UserSearchParams::class,
            'size' => 5,
            'options' => ['recentOnly' => true],
        ],
        'beatmapset' => [
            'type' => BeatmapsetSearch::class,
            'paramsType' => BeatmapsetSearchParams::class,
            'size' => 5,
        ],
    ];
}
