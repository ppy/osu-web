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
        'disabled' => 'Deze beatmap kan momenteel niet gedownload worden.',
        'parts-removed' => 'Delen van deze beatmap zijn verwijderd op verzoek van de maker of de houder van de rechten van een derde partij.',
        'more-info' => 'Klik hier voor meer informatie.',
    ],

    'index' => [
        'title' => 'Beatmap Lijst',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discussie',

        'details' => [
            'made-by' => 'gemaakt door ',
            'submitted' => 'ingezonden op ',
            'updated' => 'laatst geüpdatet op ',
            'ranked' => 'gerankt op ',
            'approved' => 'goedgekeurd op ',
            'qualified' => 'gekwalificeerd op ',
            'loved' => 'loved op ',
            'logged-out' => 'Je moet ingelogd zijn voordat je beatmaps kan downloaden!',
            'download' => [
                '_' => 'downloaden',
                'video' => 'met Video',
                'no-video' => 'zonder video',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Markeer deze beatmapset als favoriet',
            'unfavourite' => 'Verwijder markering als favoriet',
            'favourited_count' => '+1 andere!|+ :count anderen!',
        ],
        'stats' => [
            'cs' => 'Cirkelgrootte',
            'cs-mania' => 'Aantal Lanen',
            'drain' => 'HP Drain',
            'accuracy' => 'Precisie',
            'ar' => 'Benaderingssnelheid',
            'stars' => 'Sterrenmoeilijkheid',
            'total_length' => 'Lengte',
            'bpm' => 'BPM',
            'count_circles' => 'Aantal Cirkels',
            'count_sliders' => 'Aantal Sliders',
            'user-rating' => 'Gebruikersbeoordelingen',
            'rating-spread' => '',
            'nominations' => 'Nominaties',
            'playcount' => 'Playcount',
        ],
        'info' => [
            'description' => 'Beschrijving',
            'genre' => 'Genre',
            'language' => 'Taal',
            'no_scores' => 'Data nog aan het berekenen...',
            'points-of-failure' => 'Faalpunten',
            'source' => 'Bron',
            'success-rate' => 'Slagingspercentage',
            'tags' => 'Labels',
            'unranked' => 'Unranked beatmap',
        ],
        'scoreboard' => [
            'achieved' => 'bereikt op :when',
            'country' => 'Landranking',
            'friend' => 'Vriendenranking',
            'global' => 'Globale Ranking',
            'supporter-link' => 'Klik <a href=":link">hier</a> om alle chique functies die je krijgt te zien!',
            'supporter-only' => 'Je moet supporter zijn om land- en vriendenrankings te zien!',
            'title' => 'Scorebord',

            'headers' => [
                'accuracy' => 'Nauwkeurigheid',
                'combo' => 'Max. Combo',
                'miss' => 'Mis',
                'mods' => 'Mods',
                'player' => 'Speler',
                'pp' => '',
                'rank' => 'Rank',
                'score_total' => 'Totale Score',
                'score' => 'Score',
            ],

            'no_scores' => [
                'country' => 'Niemand uit jouw land heeft nog een score behaald op deze map!',
                'friend' => 'Niemand van jouw vrienden heeft nog een score behaald op deze map!',
                'global' => 'Nog geen scores. Probeer er een paar te halen?',
                'loading' => 'Scoren aan het laden...',
                'unranked' => 'Ongerankte beatmap.',
            ],
            'score' => [
                'first' => 'Aan de Leiding',
                'own' => 'Jouw beste Rang',
            ],
        ],
    ],
];
