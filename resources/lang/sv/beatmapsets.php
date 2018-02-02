<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'disabled' => 'Denna beatmap är för närvarande inte tillgänglig för nedladdning.',
        'parts-removed' => 'Portioner av denna beatmap har blivit borttagna på förfrågan av skaparen eller en tredje-parts rättighets hållare.',
        'more-info' => 'Klicka här för mer information.',
    ],

    'index' => [
        'title' => 'Beatmaps Listning',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'made-by' => 'gjord av ',
            'submitted' => 'inkommen den ',
            'updated' => 'senast uppdaterad den ',
            'ranked' => 'rankad den ',
            'approved' => 'godkänd den ',
            'qualified' => 'kvalificerad den ',
            'loved' => 'älskad den ',
            'logged-out' => 'Du behöver logga in innan du laddar ner beatmaps!',
            'download' => [
                '_' => 'Ladda Ner',
                'video' => 'med Video',
                'no-video' => 'utan Video',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Favorisera denna beatmapset',
            'unfavourite' => 'Ta bort favorisering på denna beatmapset',
            'favourited_count' => '+ 1 annan!|+ :count andra!',
        ],
        'stats' => [
            'cs' => 'Cirkel Storlek',
            'cs-mania' => 'Antal Tangenter',
            'drain' => 'HP Tömning',
            'accuracy' => 'Precision',
            'ar' => 'Approach Hastighet',
            'stars' => 'Stjärn Svårighetsgrad',
            'total_length' => 'Längd',
            'bpm' => 'BPM',
            'count_circles' => 'Antal Cirklar',
            'count_sliders' => 'Antal Sliders',
            'user-rating' => 'Användar Betyg',
            'rating-spread' => 'Betyg Spridning',
        ],
        'info' => [
            'no_scores' => 'Ej rankad beatmap',
            'points-of-failure' => 'Punkter av Misslyckande',
            'success-rate' => 'Genomsnittig Succe',

            'description' => 'Beskrivning',

            'source' => 'Källa',
            'tags' => 'Taggar',
        ],
        'scoreboard' => [
            'achieved' => 'uppnått :when',
            'country' => 'Land Ranking',
            'friend' => 'Vän Ranking',
            'global' => 'Global Ranking',
            'supporter-link' => 'Klicka <a href=":link">här</a> för att se alla fina funktioner du kommer få!',
            'supporter-only' => 'Du behöver vara en supporter för att komma åt vän och land rankningar!',
            'title' => 'Resultattavla',

            'list' => [
                'accuracy' => 'Precision',
                'player-header' => 'Spelare',
                'rank-header' => 'Rank',
                'score' => 'Poäng',
            ],
            'no_scores' => [
                'country' => 'Ingen från ditt land har satt ett poäng på denna map än!',
                'friend' => 'Ingen av dina vänner har satt ett poäng på denna map än!',
                'global' => 'Inga poäng än. Du kanske ska försöka sätta några?',
                'loading' => 'Laddar poäng...',
                'unranked' => 'Ej rankad beatmap.',
            ],
            'score' => [
                'first' => 'Leder',
                'own' => 'Ditt Bästa',
            ],
        ],
    ],
];
