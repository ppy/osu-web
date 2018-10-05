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
        'small' => 'Versenyezz másképp mint csak kör klikkelésben.',
        'large' => 'Közösségi Versenyek',
    ],
    'voting' => [
        'over' => 'Az adott versenyre való szavazás véget ért',
        'login_required' => 'Kérlek jelentkezz be a szavazáshoz.',
        'best_of' => [
            'none_played' => "Úgy tünik, hogy egyetlen beatmapet sem játszottál ami megfelelne ennek a versenynek!",
        ],
    ],
    'entry' => [
        '_' => 'jelentkezés',
        'login_required' => 'Kérlek jelentkezz be a versenyhez való csatlakozáshoz.',
        'silenced_or_restricted' => 'Felfügesztve illetve némítva nem jelentkezhetsz versenyekre.',
        'preparation' => 'Jelenleg előkészitkük ezt a versenyt. Kérjük, hogy várj türelmesen!',
        'over' => 'Köszönjük a jelentkezéseiteket! A beküldési lehetőség zárult erre a versenyre és a szavazást hamarosan indul.',
        'limit_reached' => 'Elérted a jelentkezési limitet erre a versenyre',
        'drop_here' => 'Húzd a jeletkezésed ide',
        'wrong_type' => [
            'art' => 'Csak .jpg és .png kiterjesztésű fájlok engedélyezettek erre a versenyre.',
            'beatmap' => 'Csak .osu kiterjesztésű fájlok engedélyezettek erre a versenyre.',
            'music' => 'Csak .mp3 kiterjesztésű fájlok engedélyezettek erre a versenyre.',
        ],
        'too_big' => 'A jelentkezések száma erre a versenyre csak :limit lehet.',
    ],
    'beatmaps' => [
        'download' => 'Jelentkezés letöltése',
    ],
    'vote' => [
        'list' => 'szavazatok',
        'count' => '1 szavazat|:count szavazat',
    ],
    'dates' => [
        'ended' => 'Vége: :date',

        'starts' => [
            '_' => 'Kezdete: :dare',
            'soon' => 'hamarosan™',
        ],
    ],
    'states' => [
        'entry' => 'A jelentkezések nyitottak',
        'voting' => 'A szavazás megkezdődött',
        'results' => 'Az eredmények megvannak',
    ],
];
