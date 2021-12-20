<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Soutěž i jinak, než jen klikáním na kruhy.',
        'large' => 'Komunitní soutěže',
    ],

    'index' => [
        'nav_title' => 'výpis',
    ],

    'voting' => [
        'login_required' => 'Pro hlasování se prosím přihlas.',
        'over' => 'Hlasování pro tuto soutěž bylo ukončeno',
        'show_voted_only' => 'Zobrazit odhlasované',

        'best_of' => [
            'none_played' => "Vypadá to, že nemáš odehrané žádné beatmapy, které jsou kvalifikované na tuto soutěž!",
        ],

        'button' => [
            'add' => 'Hlasovat',
            'remove' => 'Odebrat hlas',
            'used_up' => 'Využil jsi všechny svoje hlasy',
        ],

        'progress' => [
            '_' => '',
        ],
    ],
    'entry' => [
        '_' => 'vstup',
        'login_required' => 'Pro vstup do soutěže se prosím přihlas.',
        'silenced_or_restricted' => 'Nemůžeš se účastnit soutěží, zatímco je tvůj účet omezený nebo ztlumený.',
        'preparation' => 'Tuto soutěž právě připravujeme. Prosím čekej trpělivě!',
        'drop_here' => 'Tvůj vstup přetáhni sem',
        'download' => 'Stáhnout .osz',
        'wrong_type' => [
            'art' => 'Pouze .jpg a .png soubory jsou přijímány pro tuto soutěž.',
            'beatmap' => 'Pouze .osu soubory jsou přijímány pro tuto soutěž.',
            'music' => 'Pouze .mp3 soubory jsou přijímány pro tuto soutěž.',
        ],
        'too_big' => 'Možné vstupy pro tuto soutěž jsou :limit-krát.',
    ],
    'beatmaps' => [
        'download' => 'Stáhnout vstup',
    ],
    'vote' => [
        'list' => 'hlasy',
        'count' => ':count_delimited hlas|:count_delimited hlasy|:count_delimited hlasů',
        'points' => ':count_delimited bod|:count_delimited body|:count_delimited bodů',
    ],
    'dates' => [
        'ended' => 'Ukončeno :date',
        'ended_no_date' => 'Ukončeno',

        'starts' => [
            '_' => 'Začíná :date',
            'soon' => 'brzy™',
        ],
    ],
    'states' => [
        'entry' => 'Vstup otevřen',
        'voting' => 'Hlasování začalo',
        'results' => 'Výsledky vyhlášeny',
    ],
];
