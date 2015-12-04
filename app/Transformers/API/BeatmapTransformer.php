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
        // die("<pre>:".print_r($beatmap->parent(), true)."</pre>");
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
          //set
          'approved_date' => $beatmap->parent->approved_date,
          'last_update' => $beatmap->parent->last_update,
          'artist' => $beatmap->parent->artist,
          'title' => $beatmap->parent->title,
          'creator' => $beatmap->parent->creator,
          'bpm' => $beatmap->parent->bpm,
          'source' => $beatmap->parent->source,
          'tags' => $beatmap->parent->tags,
          'genre_id' => $beatmap->parent->genre_id,
          'language_id' => $beatmap->parent->language_id,
          'favourite_count' => $beatmap->parent->favourite_count,
          //osu_beatmap_difficulty_attribs.value
          'max_combo' => $beatmap->parent->max_combo,
          //IFNULL(osu_beatmap_difficulty_attribs.diff_unified, 0) AS difficultyrating
          'difficultyrating' => $beatmap->parent->difficultyrating,
        ];
    }
}
