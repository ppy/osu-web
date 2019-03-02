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

namespace App\Transformers;

use App\Libraries\Search;
use League\Fractal;

class AllSearchTransformer extends Fractal\TransformerAbstract
{
    public function transform(Search\AllSearch $search)
    {
        $transformed = [];

        foreach ($search->visibleSearches() as $mode => $search) {
            if ($search instanceof Search\WikiSearch) {
                $transformer = 'WikiPage';
            } elseif ($search instanceof Search\UserSearch) {
                $transformer = 'User';
            } elseif ($search instanceof Search\BeatmapsetSearch) {
                $transformer = 'Beatmapset';
            } elseif ($search instanceof Search\ForumSearch) {
                // i don't think we'll use forum stuffs in javascript
                // anytime soon, so i'll leave this unimplemented for now
                continue;
            }

            $transformed[$mode] = json_collection($search->records(), $transformer);
        }

        return $transformed;
    }
}
