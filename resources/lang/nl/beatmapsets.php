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
        'title' => '',
        'guest_title' => '',
    ],

    'show' => [
        'discussion' => '',

        'details' => [
            'made-by' => 'gemaakt door ',
            'submitted' => 'ingezonden op ',
            'updated' => '',
            'ranked' => 'gerankt op ',
            'approved' => '',
            'qualified' => '',
            'loved' => '',
            'logged-out' => 'Je moet ingelogd zijn voordat je beatmaps kan downloaden!',
            'download' => [
                '_' => 'downloaden',
                'video' => '',
                'no-video' => 'zonder video',
                'direct' => '',
            ],
            'favourite' => '',
            'unfavourite' => '',
            'favourited_count' => '',
        ],
        'stats' => [
            'cs' => 'Cirkelgrootte',
            'cs-mania' => '',
            'drain' => '',
            'accuracy' => 'Precisie',
            'ar' => 'Benaderingssnelheid',
            'stars' => 'Sterrenmoeilijkheid',
            'total_length' => 'Lengte',
            'bpm' => '',
            'count_circles' => '',
            'count_sliders' => '',
            'user-rating' => '',
            'rating-spread' => '',
            'nominations' => '',
            'playcount' => '',
        ],
        'info' => [
            'description' => 'Beschrijving',
            'genre' => '',
            'language' => '',
            'no_scores' => '',
            'points-of-failure' => 'Faalpunten',
            'source' => 'Bron',
            'success-rate' => 'Slagingspercentage',
            'tags' => 'Labels',
            'unranked' => '',
        ],
        'scoreboard' => [
            'achieved' => '',
            'country' => 'Landranking',
            'friend' => 'Vriendenranking',
            'global' => 'Globale Ranking',
            'supporter-link' => 'Klik <a href=":link">hier</a> om alle chique functies die je krijgt te zien!',
            'supporter-only' => 'Je moet supporter zijn om land- en vriendenrankings te zien!',
            'title' => 'Scorebord',

            'headers' => [
                'accuracy' => '',
                'combo' => '',
                'miss' => '',
                'mods' => '',
                'player' => '',
                'pp' => '',
                'rank' => '',
                'score_total' => '',
                'score' => '',
            ],

            'no_scores' => [
                'country' => 'Niemand uit jouw land heeft nog een score behaald op deze map!',
                'friend' => 'Niemand van jouw vrienden heeft nog een score behaald op deze map!',
                'global' => 'Nog geen scores. Probeer er een paar te halen?',
                'loading' => 'Scoren aan het laden...',
                'unranked' => '',
            ],
            'score' => [
                'first' => '',
                'own' => '',
            ],
        ],
    ],
];
