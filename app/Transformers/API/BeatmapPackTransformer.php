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

namespace App\Transformers\API;

use App\Models\BeatmapPack;
use League\Fractal;

class BeatmapPackTransformer extends Fractal\TransformerAbstract
{
    public function transform(BeatmapPack $pack)
    {
        return [
            'pack_id' => $pack->pack_id,
            'url' => $pack->url,
            'name' => $pack->name,
            'author' => $pack->author,
            'tag' => $pack->tag,
            'date' => $pack->date->tz('Australia/Perth')->toDateTimeString(),
        ];
    }
}
