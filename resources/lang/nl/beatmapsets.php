<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
            'favourite' => 'Markeer deze beatmapset als favoriet',
            'logged-out' => 'Je moet ingelogd zijn voordat je beatmaps kan downloaden!',
            'mapped_by' => 'gemapped door :mapper',
            'unfavourite' => 'Verwijder markering als favoriet',
            'updated_timeago' => 'laatst bijgewerkt :timeago',

            'download' => [
                '_' => 'downloaden',
                'direct' => 'osu!direct',
                'no-video' => 'zonder video',
                'video' => 'met Video',
            ],

            'login_required' => [
                'bottom' => 'toegang tot meer functies',
                'top' => 'Inloggen',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Je hebt te veel favoriete beatmaps! Verwijder er een paar voor je het opnieuw probeert.',
        ],

        'hype' => [
            'action' => 'Hype deze map als je het leuk vond om deze te spelen en om het te helpen de status <strong>ranked</strong> te bereiken.',

            'current' => [
                '_' => 'Deze map is momenteel :status.',

                'status' => [
                    'pending' => 'in behandeling',
                    'qualified' => 'gekwalificeerd',
                    'wip' => 'werk in uitvoering',
                ],
            ],

            'disqualify' => [
                '_' => 'Als u een probleem met deze beatmap vindt, alsjeblieft diskwalificeer het :link.',
                'button_title' => 'Diskwalificeer een gekwalificeerde beatmap.',
            ],

            'report' => [
                '_' => 'Als u een probleem met deze beatmap vindt, rapporteer deze dan :link om het team te waarschuwen.',
                'button' => 'Rapporteer Probleem',
                'button_title' => 'Meld een probleem op een gekwalificeerde beatmap.',
                'link' => 'hier',
            ],
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
            'rating-spread' => 'Rating Verspreiding',
            'nominations' => 'Nominaties',
            'playcount' => 'Playcount',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Gekwalificeerd',
            'wip' => 'WIP',
            'pending' => 'In behandelIng',
            'graveyard' => 'Begraafplaats',
        ],
    ],
];
