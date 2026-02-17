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

    'judge' => [
        'comments' => '',
        'hide_judged' => '',
        'nav_title' => '',
        'no_current_vote' => '',
        'update' => '',
        'validation' => [
            'missing_score' => '',
            'contest_vote_judged' => '',
        ],
        'voted' => '',
    ],

    'judge_results' => [
        '_' => '',
        'creator' => '',
        'score' => '',
        'score_std' => '',
        'total_score' => '',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => '',
        'judged_notice' => '',
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

        'progress' => [
            '_' => '',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => '',
            ],
        ],
    ],

    'entry' => [
        '_' => 'vstup',
        'login_required' => 'Prosím, prihlás sa pre vstup do súťaźe.',
        'silenced_or_restricted' => 'Nemôžeš sa zúčastniť súťaže, keď je tvoj účet v obmedzenom režime alebo umlčaný.',
        'preparation' => 'Momentálne pripravujeme túto súťaž. Prosím čakaj trpezlivo!',
        'drop_here' => 'Tvoj vstup pretiahni sem',
        'allowed_extensions' => '',
        'max_size' => '',
        'required_dimensions' => '',
        'download' => 'Stiahnuť .osz',
        'wrong_file_type' => '',
        'wrong_dimensions' => '',
        'too_big' => 'Možné vstupy pre túto súťaž sú :limit-krát.',
    ],

    'beatmaps' => [
        'download' => 'Stiahnuť vstup',
    ],

    'vote' => [
        'list' => 'hlasy',
        'count' => ':count hlas|:count hlasov',
        'points' => ':count bod|:count body',
        'points_float' => '',
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

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
