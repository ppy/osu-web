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
        'small' => 'Tävla i andra sätt än att bara klicka cirklar.',
        'large' => 'Gemenskapstävlingar',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Möjligheten att rösta i denna tävling har avslutats',
        'login_required' => 'Var vänlig logga in för att rösta.',

        'best_of' => [
            'none_played' => "Det ser inte ut som att du har spelat någon av beatmapsen som kvalificerar för denna tävling!",
        ],

        'button' => [
            'add' => 'Rösta',
            'remove' => 'Ta bort röstning',
            'used_up' => '',
        ],
    ],
    'entry' => [
        '_' => 'bidrag',
        'login_required' => 'Var vänlig logga in för att gå med i tävlingen.',
        'silenced_or_restricted' => 'Du kan inte gå med i en tävling när du är begränsad eller tystad.',
        'preparation' => 'Vi håller på att förbereda denna tävling. Var god vänta med tålamod!',
        'over' => 'Tack för era bidrag! Möjligheten att lägga till bidrag har stängt och röstning kommer öppnas snart.',
        'limit_reached' => 'Du har uppnått max antal bidrag i denna tävling',
        'drop_here' => 'Släpp ditt bidrag här',
        'download' => 'Ladda ner .osz',
        'wrong_type' => [
            'art' => 'Endast .jpg och .png filer är tillåtna i denna tävling.',
            'beatmap' => 'Endast .osu filer är tillåtna i denna tävling.',
            'music' => 'Endast .mp3 filer är tillåtna i denna tävling.',
        ],
        'too_big' => 'Bidrag till denna tävling får vara högst :limit.',
    ],
    'beatmaps' => [
        'download' => 'Ladda Ner Bidrag',
    ],
    'vote' => [
        'list' => 'röster',
        'count' => '',
        'points' => '',
    ],
    'dates' => [
        'ended' => 'Avlutad :date',

        'starts' => [
            '_' => 'Startar :date',
            'soon' => 'snart™',
        ],
    ],
    'states' => [
        'entry' => 'Öppen För Bidrag',
        'voting' => 'Röstning Startad',
        'results' => 'Resultat Ute',
    ],
];
