<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Transformers;

use League\Fractal;

class BeatmapTransformer extends Fractal\TransformerAbstract
{
    // beatmap difficulty grouping (for beatmap card display)

    private function groupDifficulties(array &$beatmap)
    {
        $difficulty_data = $beatmap['difficulties'];
        $difficulties = [];

        if (!is_array($difficulty_data['version'])) {
            $fields_to_convert = [
                'beatmap_id',
                'version',
                'hit_length',
                'diff_drain',
                'diff_size',
                'diff_overall',
                'diff_approach',
                'playmode',
                'difficultyrating',
            ];

            foreach ($fields_to_convert as $field) {
                $difficulty_data[$field] = [$difficulty_data[$field]];
            }
        }

        foreach ($difficulty_data['version'] as $key => $difficulty) {
            $difficulties[$key]['name'] = $difficulty;
            $difficulties[$key]['rating'] = $difficulty_data['difficultyrating'][min(count($difficulty_data['difficultyrating']) - 1, $key)];

            if (is_array($difficulty_data['playmode'])) {
                $difficulties[$key]['mode'] = $difficulty_data['playmode'][0];
            } else {
                $difficulties[$key]['mode'] = $difficulty_data['playmode'];
            }
        }

        usort($difficulties, function ($a, $b) {
            if ($a['mode'] == $b['mode']) {
                return $a['rating'] - $b['rating'];
            } else {
                $a['mode'] - $b['mode'];
            }
        });

        return $difficulties;
    }

    public function transform(array $beatmap)
    {
        return [
            'beatmapset_id' => $beatmap['beatmapset_id'],
            'title' => $beatmap['title'],
            'artist' => $beatmap['artist'],
            'play_count' => number_format($beatmap['play_count']),
            'favourite_count' => number_format($beatmap['favourite_count']),
            'creator' => $beatmap['creator'],
            'user_id' => $beatmap['user_id'],
            'source' => $beatmap['source'],
            'difficulties' => self::groupDifficulties($beatmap),
        ];
    }
}
