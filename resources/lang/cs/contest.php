<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Soutěž i jinak, než jen klikáním kruhů.',
        'large' => 'Komunitní soutěže',
    ],

    'index' => [
        'nav_title' => 'výpis',
    ],

    'voting' => [
        'login_required' => 'Pro hlasování se prosím přihlaš.',
        'over' => 'Hlasování pro tuto soutěž bylo ukončeno',
        'show_voted_only' => '',

        'best_of' => [
            'none_played' => "Vypadá to, že nemáš zahranou žádnou mapu, která je kvalifikovaná na tuto soutěž!",
        ],

        'button' => [
            'add' => 'Hlasovat',
            'remove' => 'Odebrat hlas',
            'used_up' => 'Využil jsi všechny svoje hlasy',
        ],
    ],
    'entry' => [
        '_' => 'vstup',
        'login_required' => 'Přihlaš se prosím pro vstup do soutěže.',
        'silenced_or_restricted' => 'Nemůžeš se zůčastnit soutěže, když je tvůj účet v omezeném režimu nebo ztlumený.',
        'preparation' => 'Tuto soutěž právě připravujeme. Prosím čekej trpělivě!',
        'drop_here' => 'Tvůj vstup přetáhni sem',
        'download' => 'Stáhnout .osz',
        'wrong_type' => [
            'art' => 'Pouze .jpg a ,png soubory jsou přijímány pro tuto soutěž.',
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
        'count' => ':count hlas|:count hlasů',
        'points' => ':count bod|:count bodů',
    ],
    'dates' => [
        'ended' => 'Ukončeno :date',
        'ended_no_date' => '',

        'starts' => [
            '_' => 'Začíná :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => 'Vstup Otevřen',
        'voting' => 'Hlasování Začalo',
        'results' => 'Výsledky Vyhlášeny',
    ],
];
