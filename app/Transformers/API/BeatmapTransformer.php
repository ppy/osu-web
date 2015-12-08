<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use App\Models\Beatmap;
use League\Fractal;

class BeatmapTransformer extends Fractal\TransformerAbstract
{
    public function transform(Beatmap $beatmap)
    {
        $difficulty = $beatmap->difficultyAttribs->where('mode', $beatmap->playmode)->where('mods', 0)->where('attrib_id', 9)->first();
        $diff_attrib = $beatmap->difficulty->where('mode', $beatmap->playmode)->where('mods', 0)->first();

        return [
          //beatmap
          'beatmapset_id' => $beatmap->beatmapset_id,
          'beatmap_id' => $beatmap->beatmap_id,
          'approved' => $beatmap->approved,
          'total_length' => $beatmap->total_length,
          'hit_length' => $beatmap->hit_length,
          'version' => $beatmap->version,
          'file_md5' => $beatmap->checksum,
          'diff_size' => $beatmap->diff_size,
          'diff_overall' => $beatmap->diff_overall,
          'diff_approach' => $beatmap->diff_approach,
          'diff_drain' => $beatmap->diff_drain,
          'mode' => $beatmap->playmode,
          'playcount' => $beatmap->playcount,
          'passcount' => $beatmap->passcount,

          //beatmapset set
          'approved_date' => $beatmap->set->approved_date,
          'last_update' => $beatmap->set->last_update,
          'artist' => $beatmap->set->artist,
          'title' => $beatmap->set->title,
          'creator' => $beatmap->set->creator,
          'bpm' => $beatmap->set->bpm,
          'source' => $beatmap->set->source,
          'tags' => $beatmap->set->tags,
          'genre_id' => $beatmap->set->genre_id,
          'language_id' => $beatmap->set->language_id,
          'favourite_count' => $beatmap->set->favourite_count,

          // beatmap difficulty/difficultyattribs
          'max_combo' => $difficulty ? $difficulty->value : null,
          'difficultyrating' => $diff_attrib ? $diff_attrib->diff_unified : 0,
        ];
    }
}
