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

use App\Models\BeatmapPlaycount;
use League\Fractal;

class BeatmapPlaycountTransformer extends Fractal\TransformerAbstract
{
    protected $defaultIncludes = [
        'beatmap',
        'beatmapset',
    ];

    protected $availableIncludes = [
        'beatmap',
        'beatmapset',
    ];

    public function transform(BeatmapPlaycount $playcount)
    {
        return [
            'beatmap_id' => $playcount->beatmap_id,
            'count' => $playcount->playcount,
        ];
    }

    public function includeBeatmap(BeatmapPlaycount $playcount)
    {
        if ($playcount->beatmap === null) {
            return;
        }

        return $this->item(
            $playcount->beatmap,
            new BeatmapCompactTransformer()
        );
    }

    public function includeBeatmapset(BeatmapPlaycount $playcount)
    {
        if ($playcount->beatmap === null) {
            return;
        }

        return $this->item(
            $playcount->beatmap->beatmapset,
            new BeatmapsetCompactTransformer()
        );
    }
}
