<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

return [
    'availability' => [
        'disabled' => '',
        'parts-removed' => '',
        'more-info' => '',
    ],

    'index' => [
        'title' => 'Beatmaps Liste',
        'guest_title' => '',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'made-by' => 'lavet af ',
            'submitted' => 'indsendt den ',
            'updated' => 'sidst opdateret den ',
            'ranked' => 'ranked den ',
            'approved' => 'godkendt den ',
            'qualified' => 'kvalificeret den ',
            'loved' => 'loved den ',
            'logged-out' => 'Du skal være logget ind for at kunne downloade beatmaps!',
            'download' => [
                '_' => '',
                'video' => 'med Video',
                'no-video' => 'uden Video',
                'direct' => '',
            ],
            'favourite' => 'Markér dette beatmapset som favorit',
            'unfavourite' => 'Fjern markering af dette beatmapset som favorit',
            'favourited_count' => '+ 1 andre!|+ :count andre!',
        ],
        'stats' => [
            'cs' => 'Circle Størrelse',
            'cs-mania' => 'Key Antal',
            'drain' => 'HP Dræn',
            'accuracy' => 'Præcision',
            'ar' => '',
            'stars' => 'Stjerne Sværhedsgrad',
            'total_length' => 'Længde',
            'bpm' => '',
            'count_circles' => 'Cirkel Antal',
            'count_sliders' => 'Slider Antal',
            'user-rating' => 'Brugerbedømmelse',
            'rating-spread' => 'Rating Fordeling',
            'nominations' => '',
            'playcount' => '',
        ],
        'info' => [
            'description' => 'Beskrivelse',
            'genre' => '',
            'language' => 'Sprog',
            'no_scores' => 'Dataen er ved at blive beregnet...',
            'points-of-failure' => 'Fejlpoints',
            'source' => 'Kilde',
            'success-rate' => 'Succes Rate',
            'tags' => '',
            'unranked' => 'Ikke-ranked beatmap',
        ],
        'scoreboard' => [
            'achieved' => 'opnået :when',
            'country' => 'Landerangering',
            'friend' => 'Vennerangering',
            'global' => 'Global Rangering',
            'supporter-link' => 'Klik <a href=":link">here</a> for at se alle de smarte fordele du får!',
            'supporter-only' => 'Du skal være supporter for at få adgang til venne- og landerangering!',
            'title' => '',

            'headers' => [
                'accuracy' => 'Præcision',
                'combo' => '',
                'miss' => '',
                'mods' => '',
                'player' => 'Spiller',
                'pp' => '',
                'rank' => '',
                'score_total' => 'Samlet Score',
                'score' => '',
            ],

            'no_scores' => [
                'country' => 'Ingen fra dit land har sat en score på dette map endnu!',
                'friend' => 'Ingen af dine venner har sat en score på dette map endnu!',
                'global' => 'Ingen scores endnu. Måske skulle du prøve at lave en?',
                'loading' => 'Indlæser scores...',
                'unranked' => 'Ikke-ranked beatmap.',
            ],
            'score' => [
                'first' => 'I førerpositionen',
                'own' => 'Dit bedste',
            ],
        ],
    ],
];
