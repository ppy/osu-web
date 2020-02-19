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
        'small' => 'Versenyezz kör kattintgatáson kívüli módokban.',
        'large' => 'Közösségi Versenyek',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Erre a versenyre már véget ért a szavazás',
        'login_required' => 'Kérlek jelentkezz be a szavazáshoz.',

        'best_of' => [
            'none_played' => "Úgy tűnik, hogy egyetlen beatmap-et sem játszottál ami megfelelne ennek a versenynek!",
        ],

        'button' => [
            'add' => 'Szavazás',
            'remove' => 'Szavazat eltávolítása',
            'used_up' => 'Felhasználtad az összes szavazatodat',
        ],
    ],
    'entry' => [
        '_' => 'jelentkezés',
        'login_required' => 'Kérlek jelentkezz be a versenyhez való csatlakozáshoz.',
        'silenced_or_restricted' => 'Felfüggesztve illetve némítva nem jelentkezhetsz versenyekre.',
        'preparation' => 'Ez a verseny előkészítés alatt áll. Kérjük várj türelmesen!',
        'over' => 'Köszönjük a jelentkezéseidet! A beküldési lehetőség lezárult erre a versenyre és a szavazás hamarosan indul.',
        'limit_reached' => 'Elérted a jelentkezési limited erre a versenyre',
        'drop_here' => 'Húzd a jelentkezésedet ide',
        'download' => '.osz letöltése',
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
        'count' => ':count szavazat|:count szavazatok',
        'points' => ':count pont|:count pontok',
    ],
    'dates' => [
        'ended' => 'Vége: :date',

        'starts' => [
            '_' => 'Kezdete: :date',
            'soon' => 'hamarosan™',
        ],
    ],
    'states' => [
        'entry' => 'Nyitott Jelentkezés',
        'voting' => 'Szavazás Folyamatban',
        'results' => 'Kihirdetett Eredmény',
    ],
];
