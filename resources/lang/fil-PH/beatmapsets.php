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
        'disabled' => 'Ang beatmap na ito ay hindi maaaring i-download sa kasalukuyan.',
        'parts-removed' => 'Tinanggal ang mga bahagi ng beatmap na ito sa kahilingan ng lumikha nito o ng isang ikatlong panig na mayhawak ng karapatan.',
        'more-info' => 'Tignan dito para sa karagdagang impormasyon.',
    ],

    'index' => [
        'title' => 'Listahan ng mga Beatmap',
        'guest_title' => 'Mga Beatmap',
    ],

    'show' => [
        'discussion' => 'Diskusyon',

        'details' => [
            'approved' => 'naaprubahan noong ',
            'favourite' => 'I-paborito ang beatmapset na ito',
            'logged-out' => 'Kailangan mong mag-sign-in bago ka pwedeng mag-download ng mga beatmap!',
            'loved' => 'minahal noong ',
            'mapped_by' => 'minapa ni :mapper',
            'qualified' => 'na-qualify noong ',
            'ranked' => 'na-rank noong ',
            'submitted' => '',
            'unfavourite' => '',
            'updated' => 'huling na-update noong ',
            'updated_timeago' => 'huling na-update sa :timeago',

            'download' => [
                '_' => 'I-download',
                'direct' => '',
                'no-video' => 'walang Video',
                'video' => 'may Video',
            ],

            'login_required' => [
                'bottom' => '',
                'top' => 'Sign in',
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
                    'pending' => 'pending',
                    'qualified' => 'qualified',
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
            'description' => 'Deskripsyon',
            'genre' => 'Dyanre',
            'language' => 'Wika',
            'no_scores' => 'Kinakalkula pa ang mga datos...',
            'points-of-failure' => '',
            'source' => 'Pinagmulan',
            'success-rate' => '',
            'tags' => 'Mga Tag',
            'unranked' => 'Hindi naka-rank na beatmap',
        ],

        'scoreboard' => [
            'achieved' => 'nakamit nang :when',
            'country' => '',
            'friend' => '',
            'global' => '',
            'supporter-link' => '',
            'supporter-only' => '',
            'title' => '',

            'headers' => [
                'accuracy' => '',
                'combo' => '',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Manlalaro',
                'pp' => '',
                'rank' => 'Rank',
                'score_total' => 'Kabuuang Puntos',
                'score' => 'Puntos',
            ],

            'no_scores' => [
                'country' => '',
                'friend' => '',
                'global' => '',
                'loading' => '',
                'unranked' => '',
            ],
            'score' => [
                'first' => '',
                'own' => '',
            ],
        ],

        'stats' => [
            'cs' => 'Laki ng Bilog',
            'cs-mania' => 'Bilang ng Key',
            'drain' => 'Pagubos ng HP',
            'accuracy' => 'Katumpakan',
            'ar' => 'Approach Rate',
            'stars' => 'Star Difficulty',
            'total_length' => 'Haba',
            'bpm' => 'BPM',
            'count_circles' => 'Bilang ng Bilog',
            'count_sliders' => 'Bilang ng Slider',
            'user-rating' => '',
            'rating-spread' => '',
            'nominations' => 'Mga Nominasyon',
            'playcount' => '',
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
