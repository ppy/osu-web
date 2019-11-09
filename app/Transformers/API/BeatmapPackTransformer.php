<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
