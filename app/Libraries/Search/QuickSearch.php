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
