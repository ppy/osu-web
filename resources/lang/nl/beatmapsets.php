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
        'disabled' => 'This beatmap is currently not available for download.',
        'parts-removed' => 'Portions of this beatmap have been removed at the request of the creator or a third-party rights holder.',
        'more-info' => 'Check here for more information.',
    ],

    'index' => [
        'title' => 'Beatmaps Listing',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discussion',

        'details' => [
            'made-by' => 'gemaakt door ',
            'submitted' => 'ingezonden op ',
            'updated' => 'last updated on ',
            'ranked' => 'gerankt op ',
            'approved' => 'approved on ',
            'qualified' => 'qualified on ',
            'loved' => 'loved on ',
            'logged-out' => 'Je moet ingelogd zijn voordat je beatmaps kan downloaden!',
            'download' => [
                '_' => 'downloaden',
                'video' => 'with Video',
                'no-video' => 'zonder video',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Favourite this beatmapset',
            'unfavourite' => 'Unfavourite this beatmapset',
            'favourited_count' => '+ 1 other!|+ :count others!',
        ],
        'stats' => [
            'cs' => 'Cirkelgrootte',
            'cs-mania' => 'Key Amount',
            'drain' => 'HP Drain',
            'accuracy' => 'Precisie',
            'ar' => 'Benaderingssnelheid',
            'stars' => 'Sterrenmoeilijkheid',
            'total_length' => 'Lengte',
            'bpm' => 'BPM',
            'count_circles' => 'Circle Count',
            'count_sliders' => 'Slider Count',
            'user-rating' => 'User Rating',
            'rating-spread' => 'Rating Spread',
            'nominations' => 'Nominations',
            'playcount' => 'Playcount',
        ],
        'info' => [
            'description' => 'Beschrijving',
            'genre' => 'Genre',
            'language' => 'Language',
            'no_scores' => 'Data still being calculated...',
            'points-of-failure' => 'Faalpunten',
            'source' => 'Bron',
            'success-rate' => 'Slagingspercentage',
            'tags' => 'Labels',
            'unranked' => 'Unranked beatmap',
        ],
        'scoreboard' => [
            'achieved' => 'achieved :when',
            'country' => 'Landranking',
            'friend' => 'Vriendenranking',
            'global' => 'Globale Ranking',
            'supporter-link' => 'Klik <a href=":link">hier</a> om alle chique functies die je krijgt te zien!',
            'supporter-only' => 'Je moet supporter zijn om land- en vriendenrankings te zien!',
            'title' => 'Scorebord',

            'headers' => [
                'accuracy' => 'Accuracy',
                'combo' => 'Max Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Player',
                'pp' => 'pp',
                'rank' => 'Rank',
                'score_total' => 'Total Score',
                'score' => 'Score',
            ],

            'no_scores' => [
                'country' => 'Niemand uit jouw land heeft nog een score behaald op deze map!',
                'friend' => 'Niemand van jouw vrienden heeft nog een score behaald op deze map!',
                'global' => 'Nog geen scores. Probeer er een paar te halen?',
                'loading' => 'Scoren aan het laden...',
                'unranked' => 'Unranked beatmap.',
            ],
            'score' => [
                'first' => 'In the Lead',
                'own' => 'Your Best',
            ],
        ],
    ],
];
