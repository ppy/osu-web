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
    'header' => [
        'small' => '',
        'large' => 'osu!-yhteisön kilpailut',
    ],
    'voting' => [
        'over' => 'Äänestäminen tälle kilpailulle on loppunut',
        'login_required' => 'Kirjaudu sisään äänestääksesi.',
        'best_of' => [
            'none_played' => "",
        ],
    ],
    'entry' => [
        '_' => '',
        'login_required' => 'Kirjaudu sisään osallistuaksesi kilpailuun.',
        'silenced_or_restricted' => '',
        'preparation' => '',
        'over' => '',
        'limit_reached' => '',
        'drop_here' => '',
        'wrong_type' => [
            'art' => 'Kilpailuun hyväksytään vain .jpg tai .png tiedostoja.',
            'beatmap' => 'Kilpailuun hyväksytään vain .osu tiedostoja.',
            'music' => 'Kilpailuun hyväksytään vain .mp3 tiedostoja.',
        ],
        'too_big' => '',
    ],
    'beatmaps' => [
        'download' => '',
    ],
    'vote' => [
        'list' => 'äänet',
        'count' => '',
    ],
    'dates' => [
        'ended' => 'Loppui :date',

        'starts' => [
            '_' => 'Alkoi :date',
            'soon' => 'pian™',
        ],
    ],
    'states' => [
        'entry' => '',
        'voting' => 'Äänestys on alkanut',
        'results' => '',
    ],
];
