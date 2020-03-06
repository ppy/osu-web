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
        'disabled' => 'Šīs bītkartes lejupielāde šobrīd nav iespējama.',
        'parts-removed' => '',
        'more-info' => 'Lai iegūtu papildu informāciju, noklikšķiniet šeit.',
    ],

    'index' => [
        'title' => 'Bītkaršu saraksts',
        'guest_title' => 'Bītkartes',
    ],

    'show' => [
        'discussion' => 'Diskusija',

        'details' => [
            'approved' => 'apstiprināta ',
            'favourite' => '',
            'logged-out' => 'Jums nepieciešams pierakstīties pirms lejupielādēt jebkuru bītkarti!',
            'loved' => 'mīlēta ',
            'mapped_by' => 'kartēja :mapper',
            'qualified' => 'kvalificēta ',
            'ranked' => 'ranžēta ',
            'submitted' => 'iesniedza ',
            'unfavourite' => '',
            'updated' => 'pēdējās izmaiņas veiktas ',
            'updated_timeago' => 'pēdējo reizi atjaonots :timeago',

            'download' => [
                '_' => 'Lejuplādēt',
                'direct' => '',
                'no-video' => 'bez Video',
                'video' => 'ar Video',
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
                'link' => '',
            ],
        ],

        'info' => [
            'description' => 'Apraksts',
            'genre' => 'Žanrs',
            'language' => 'Valoda',
            'no_scores' => 'Rezultāti joprojām tiek aprēķināti...',
            'points-of-failure' => 'Izkrišanas punkti',
            'source' => 'Avots',
            'success-rate' => 'Izdošanās līmenis',
            'tags' => 'Birkas',
            'unranked' => 'Neranžēta bītkarte',
        ],

        'scoreboard' => [
            'achieved' => 'sasniegts :when',
            'country' => 'Valsts rangi',
            'friend' => 'Draugu rangi',
            'global' => 'Pasaules rangi',
            'supporter-link' => '',
            'supporter-only' => 'Jums nepieciešams būt atbalstītājam, lai redzētu draugu un valsts rangus!',
            'title' => 'Rezultātu apkopojums',

            'headers' => [
                'accuracy' => 'Precizitāte',
                'combo' => '',
                'miss' => 'Netrāpījumi',
                'mods' => 'Modifikācijas',
                'player' => 'Spēlētājs',
                'pp' => '',
                'rank' => 'Rangs',
                'score_total' => 'Kopējais punktu skaits',
                'score' => 'Rezultāts',
            ],

            'no_scores' => [
                'country' => 'Neviens no jūsu valsts vēl nav ieguvuši rezultātu šajā bītkartē!',
                'friend' => 'Neviens no jūsu draugiem vēl nav ieguvuši rezultātu šajā bītkartē!',
                'global' => 'Vēl neviena rezultāta. varbūt pamēģini kādu uztaisīt?',
                'loading' => '',
                'unranked' => 'Neranžēta bītkarte.',
            ],
            'score' => [
                'first' => 'Vadībā',
                'own' => 'Tavs labākais',
            ],
        ],

        'stats' => [
            'cs' => 'Apļu lielums',
            'cs-mania' => 'Taustiņu skaits',
            'drain' => 'HP notece',
            'accuracy' => 'Precizināte',
            'ar' => 'Tuvošanās ātrums',
            'stars' => 'Grūtība zvaigznēs',
            'total_length' => 'Garums',
            'bpm' => 'BPM',
            'count_circles' => 'Apļu skaits',
            'count_sliders' => 'Slīdņu skaits',
            'user-rating' => 'Lietotāju vērtējums',
            'rating-spread' => 'Vērtējumu izplatījums',
            'nominations' => 'Nominācijas',
            'playcount' => 'Reizes spēlēts',
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
