<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class QuickSearch extends MultiSearch
{
    const MODES = [
        'beatmapset' => [
            'type' => BeatmapsetSearch::class,
            'paramsType' => BeatmapsetSearchRequestParams::class,
            'size' => 5,
        ],
        'forum_post' => [
            'type' => ForumSearch::class,
            'paramsType' => ForumSearchRequestParams::class,
            'size' => 0,
        ],
        'user' => [
            'type' => UserSearch::class,
            'paramsType' => UserSearchRequestParams::class,
            'size' => 5,
        ],
        'wiki_page' => [
            'type' => WikiSearch::class,
            'paramsType' => WikiSearchRequestParams::class,
            'size' => 0,
        ],
    ];
}
