<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Transformers\BeatmapsetCompactTransformer;
use App\Transformers\TeamTransformer;
use App\Transformers\UserCompactTransformer;

class QuickSearch extends MultiSearch
{
    const MODES = [
        'artist_track' => [
            'paramsType' => ArtistTrackSearchRequestParams::class,
            'size' => 0,
            'type' => ArtistTrackSearch::class,
        ],
        'beatmapset' => [
            'paramsType' => BeatmapsetSearchRequestParams::class,
            'size' => 5,
            'transformer' => [
                'class' => BeatmapsetCompactTransformer::class,
                'includes' => [],
            ],
            'type' => BeatmapsetSearch::class,
        ],
        'forum_post' => [
            'paramsType' => ForumSearchRequestParams::class,
            'size' => 0,
            'type' => ForumSearch::class,
        ],
        'team' => [
            'paramsType' => TeamSearchRequestParams::class,
            'size' => 5,
            'transformer' => [
                'class' => TeamTransformer::class,
                'includes' => [],
            ],
            'type' => TeamSearch::class,
        ],
        'user' => [
            'paramsType' => UserSearchRequestParams::class,
            'size' => 5,
            'transformer' => [
                'class' => UserCompactTransformer::class,
                'includes' => [...UserCompactTransformer::CARD_INCLUDES, 'support_level'],
            ],
            'type' => UserSearch::class,
        ],
        'wiki_page' => [
            'paramsType' => WikiSearchRequestParams::class,
            'size' => 0,
            'type' => WikiSearch::class,
        ],
    ];
}
