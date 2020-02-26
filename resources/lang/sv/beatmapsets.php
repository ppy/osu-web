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
            'favourite' => 'Favorisera denna beatmapset',
            'logged-out' => 'Du behöver logga in innan du laddar ner beatmaps!',
            'mapped_by' => 'skapad av :mapper',
            'unfavourite' => 'Ta bort favorisering på denna beatmapset',
            'updated_timeago' => 'senast ändrad :timeago',

            'download' => [
                '_' => 'Ladda Ner',
                'direct' => 'osu!direct',
                'no-video' => 'utan Video',
                'video' => 'med Video',
            ],

            'login_required' => [
                'bottom' => '',
                'top' => '',
            ],
        ],

        'favourites' => [
            'limit_reached' => '',
        ],

        'hype' => [
            'action' => '',

            'current' => [
                '_' => '',

                'status' => [
                    'pending' => '',
                    'qualified' => '',
                    'wip' => '',
                ],
            ],

            'disqualify' => [
                '_' => '',
                'button_title' => '',
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => 'här',
            ],
        ],

        'info' => [
            'description' => 'Beskrivning',
            'genre' => 'Genre',
            'language' => 'Språk',
            'no_scores' => 'Data beräknas...',
            'points-of-failure' => 'Punkter av Misslyckande',
            'source' => 'Källa',
            'success-rate' => 'Genomsnittig Succe',
            'tags' => 'Taggar',
            'unranked' => 'Ej rankad beatmap',
        ],

        'scoreboard' => [
            'achieved' => 'uppnått :when',
            'country' => 'Nationell rankning',
            'friend' => 'Rankning bland vänner',
            'global' => 'Global rankning',
            'supporter-link' => 'Klicka <a href=":link">här</a> för att se alla fina funktioner du kommer få!',
            'supporter-only' => 'Du behöver vara en supporter för att komma åt vän och land rankningar!',
            'title' => 'Resultattavla',

            'headers' => [
                'accuracy' => 'Precision',
                'combo' => 'Högsta Kombo',
                'miss' => 'Missar',
                'mods' => 'Tillägg',
                'player' => 'Spelare',
                'pp' => '',
                'rank' => 'Rank',
                'score_total' => 'Total Poäng',
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
            'nominations' => 'Nomineringar',
            'playcount' => 'Speltid',
        ],

        'status' => [
            'ranked' => '',
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'wip' => '',
            'pending' => '',
            'graveyard' => '',
        ],
    ],
];
