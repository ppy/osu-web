<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\API;

use App\Models\Beatmap;
use App\Transformers\TransformerAbstract;

class BeatmapTransformer extends TransformerAbstract
{
    public function transform(Beatmap $beatmap)
    {
        $diffAttrib = $beatmap->difficultyAttribs->where('mode', $beatmap->playmode)->where('mods', 0)->where('attrib_id', 9)->first();
        $difficulty = $beatmap->difficulty->where('mode', $beatmap->playmode)->where('mods', 0)->first();

        return [
            //beatmap
            'beatmap_id' => $beatmap->beatmap_id,
            'beatmapset_id' => $beatmap->beatmapset_id,
            'approved' => $beatmap->approved,
            'total_length' => $beatmap->total_length,
            'hit_length' => $beatmap->hit_length,
            'version' => $beatmap->version,
            'checksum' => $beatmap->checksum,
            'diff_size' => $beatmap->diff_size,
            'diff_overall' => $beatmap->diff_overall,
            'diff_approach' => $beatmap->diff_approach,
            'diff_drain' => $beatmap->diff_drain,
            'mode' => $beatmap->playmode,
            'playcount' => $beatmap->playcount,
            'passcount' => $beatmap->passcount,

            //beatmapset
            'approved_date' => json_time($beatmap->beatmapset->approved_date),
            'last_update' => json_time($beatmap->beatmapset->last_update),
            'artist' => $beatmap->beatmapset->artist,
            'title' => $beatmap->beatmapset->title,
            'creator' => $beatmap->beatmapset->creator,
            'bpm' => $beatmap->bpm,
            'source' => $beatmap->beatmapset->source,
            'tags' => $beatmap->beatmapset->tags,
            'genre_id' => $beatmap->beatmapset->genre_id,
            'language_id' => $beatmap->beatmapset->language_id,
            'favourite_count' => $beatmap->beatmapset->favourite_count,

            // beatmap difficulty/difficultyattribs
            'max_combo' => $diffAttrib ? $diffAttrib->value : null,
            'difficultyrating' => $difficulty ? $difficulty->diff_unified : 0,
        ];
    }
}
