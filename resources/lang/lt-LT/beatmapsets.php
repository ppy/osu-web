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
        'disabled' => 'Ši „beatmap“. Šiuo metu nėra galimybės atsiųsti.',
        'parts-removed' => '',
        'more-info' => '',
    ],

    'index' => [
        'title' => '',
        'guest_title' => 'Beatmapai',
    ],

    'show' => [
        'discussion' => '',

        'details' => [
            'approved' => '',
            'favourite' => '',
            'logged-out' => '',
            'loved' => '',
            'mapped_by' => ':title sukūrė :mapper',
            'qualified' => '',
            'ranked' => '',
            'submitted' => 'įkėlimo data ',
            'unfavourite' => '',
            'updated' => 'paskutinį kartą atnaujinta ',
            'updated_timeago' => 'paskiausiai atnaujinta prieš :timeago',

            'download' => [
                '_' => 'Atsisiųsti',
                'direct' => '',
                'no-video' => 'be vaizdo įrašo',
                'video' => 'su vaizdo įrašu',
            ],

            'login_required' => [
                'bottom' => 'kad pasiektum daugiau galimybių',
                'top' => 'Prisijungti',
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
                    'pending' => 'patvirtinamas',
                    'qualified' => 'kvalifikuotas',
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
                'link' => '',
            ],
        ],

        'info' => [
            'description' => 'Aprašymas',
            'genre' => 'Žanras',
            'language' => 'Kalba',
            'no_scores' => '',
            'points-of-failure' => '',
            'source' => 'Šaltinis',
            'success-rate' => 'Sėkmingi kartai',
            'tags' => 'Žymos',
            'unranked' => '',
        ],

        'scoreboard' => [
            'achieved' => 'pasiekta :when',
            'country' => 'Šalies reitingai',
            'friend' => 'Draugų reitingai',
            'global' => 'Pasaulinis Reitingas',
            'supporter-link' => '',
            'supporter-only' => 'Tau reikia turėti osu!supporter, kad pasiektum draugų ir Šalių reitingus!',
            'title' => '',

            'headers' => [
                'accuracy' => 'Taiklumas',
                'combo' => 'Didžiausias combo',
                'miss' => 'Nepataikyti',
                'mods' => 'Modifikacijos',
                'player' => 'Žaidėjas',
                'pp' => '',
                'rank' => 'Reitingas',
                'score_total' => 'Visi taškai',
                'score' => 'Taškai',
            ],

            'no_scores' => [
                'country' => '',
                'friend' => '',
                'global' => '',
                'loading' => 'Įkeliami rezultatai...',
                'unranked' => '',
            ],
            'score' => [
                'first' => 'Pirmauja',
                'own' => 'Tavo geriausias',
            ],
        ],

        'stats' => [
            'cs' => 'Apskritimų dydis',
            'cs-mania' => 'Klavišų kiekis',
            'drain' => 'Gyvybės išsekimas',
            'accuracy' => 'Tikslumas',
            'ar' => 'Artėjimo greitis',
            'stars' => 'Žvaigždžių sunkumas',
            'total_length' => 'Trukmė',
            'bpm' => 'BPM',
            'count_circles' => 'Apskritimų skaičius',
            'count_sliders' => '',
            'user-rating' => 'Narių įvertinimas',
            'rating-spread' => 'Vertimų išsidėstymas',
            'nominations' => '',
            'playcount' => 'Žaidimų skaičius',
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
