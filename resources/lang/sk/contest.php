<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Súťaž aj inak, než klikaním kruhov.',
        'large' => 'Súťaže Komunity',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'login_required' => 'Pre hlasovanie sa prosím prihlás.',
        'over' => 'Hlasovanie pre túto súťaź bolo ukončené',
        'show_voted_only' => '',

        'best_of' => [
            'none_played' => "Vypadá to, že nemáš zahratú žiadnu mapu, ktorá je kvalifikovaná pre túto súťaž!",
        ],

        'button' => [
            'add' => 'Hlasovať',
            'remove' => '',
            'used_up' => '',
        ],
    ],
    'entry' => [
        '_' => 'vstup',
        'login_required' => 'Prosím, prihlás sa pre vstup do súťaźe.',
        'silenced_or_restricted' => 'Nemôžeš sa zúčastniť súťaže, keď je tvoj účet v obmedzenom režime alebo umlčaný.',
        'preparation' => 'Momentálne pripravujeme túto súťaž. Prosím čakaj trpezlivo!',
        'drop_here' => 'Tvoj vstup pretiahni sem',
        'download' => 'Stiahnuť .osz',
        'wrong_type' => [
            'art' => 'Iba .jpg a .png súbory sú akceptované pre túto súťaž.',
            'beatmap' => 'Iba .osu súbory su akceptované pre túto súťaž.',
            'music' => 'Iba .mp3 súbory sú akceptované pre túto súťaž.',
        ],
        'too_big' => 'Možné vstupy pre túto súťaž sú :limit-krát.',
    ],
    'beatmaps' => [
        'download' => 'Stiahnuť vstup',
    ],
    'vote' => [
        'list' => 'hlasy',
        'count' => ':count hlas|:count hlasov',
        'points' => ':count bod|:count body',
    ],
    'dates' => [
        'ended' => 'Ukončené :date',
        'ended_no_date' => '',

        'starts' => [
            '_' => 'Začína :date',
            'soon' => 'čoskoro™',
        ],
    ],
    'states' => [
        'entry' => 'Vstup Otvorený',
        'voting' => 'Hlasovanie Začalo',
        'results' => 'Výsledky',
    ],
];
