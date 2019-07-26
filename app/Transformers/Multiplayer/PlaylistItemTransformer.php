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

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\PlaylistItem;
use App\Transformers\BeatmapCompactTransformer;
use League\Fractal;

class PlaylistItemTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
    ];

    public function transform(PlaylistItem $item)
    {
        return [
            'id' => $item->id,
            'room_id' => $item->room_id,
            'beatmap_id' => $item->beatmap_id,
            'ruleset_id' => $item->ruleset_id,
            'allowed_mods' => $item->allowed_mods,
            'required_mods' => $item->required_mods,
        ];
    }

    public function includeBeatmap(PlaylistItem $item)
    {
        return $this->item(
            $item->beatmap,
            new BeatmapCompactTransformer
        );
    }
}
