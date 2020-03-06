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
    'header' => [
        'small' => 'Makipagkumpetensya sa mas maraming paraan kaysa sa pag-click lang mga bilog.',
        'large' => 'Paligsahan sa Komunidad',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Nagwakas na ang pagboto para sa paligsahang ito',
        'login_required' => 'Paki-sign-in para magboto.',

        'best_of' => [
            'none_played' => "Mukhang hindi ka nakapaglaro ng mga beatmap na kwalipikado sa paligsahan na ito!",
        ],

        'button' => [
            'add' => 'Bumoto',
            'remove' => 'Taggalin ang Boto',
            'used_up' => 'Nagamit na lahat ng boto mo',
        ],
    ],
    'entry' => [
        '_' => 'entrada',
        'login_required' => 'Paki-sign-in para sumali sa paligsahan.',
        'silenced_or_restricted' => 'Hindi ka pwedeng sumali sa mga paligsahan habang naka-restricted o naka-silenced ka.',
        'preparation' => 'Hinahanda pa namin ang pagligsahang ito. Mangyaring maghintay nang matiyaga!',
        'over' => 'Salamat sa iyo para sa iyong mga entrada! Natapos na ang pagsumite para sa ito paligsahan at magsisimula ang pagboto sa lalong madaling panahon.',
        'limit_reached' => 'Narating mo na ang limitasyon ng pagsumite sa paligsahan na ito',
        'drop_here' => 'Ihulog ang iyong entrada dito',
        'download' => 'I-download ang .osz',
        'wrong_type' => [
            'art' => 'Ang mga .jpg at .png na file lamang ang tinatanggap para sa paligsahang ito.',
            'beatmap' => 'Ang mga .osu file lamang ang tinatanggap para sa paligsahang ito.',
            'music' => 'Ang mga .mp3 file lamang ang tinatanggap para sa paligsahang ito.',
        ],
        'too_big' => 'Ang bilang ng pagsumite sa paligsahan na ito ay hanggang :limit.',
    ],
    'beatmaps' => [
        'download' => 'I-download Ang Entrada',
    ],
    'vote' => [
        'list' => 'mga boto',
        'count' => ':count_delimited boto|:count_delimited mga boto',
        'points' => ':count_delimited puntos|:count_delimited mga puntos',
    ],
    'dates' => [
        'ended' => 'Natapos sa :date',

        'starts' => [
            '_' => 'Magsisimula sa :date',
            'soon' => 'malapit na™',
        ],
    ],
    'states' => [
        'entry' => 'Maaaring Magsumite',
        'voting' => 'Nagsimula ang Pagboto',
        'results' => 'Linabas Ang Mga Resulta',
    ],
];
