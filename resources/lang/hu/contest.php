<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Versenyezz kör kattintgatáson kívüli módokban.',
        'large' => 'Közösségi Versenyek',
    ],

    'index' => [
        'nav_title' => 'lista',
    ],

    'voting' => [
        'login_required' => 'Kérlek jelentkezz be a szavazáshoz.',
        'over' => 'Erre a versenyre már véget ért a szavazás',
        'show_voted_only' => '',

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
        'ended_no_date' => 'Befejezve',

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
