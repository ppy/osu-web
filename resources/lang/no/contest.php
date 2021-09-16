<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Konkurrer i flere måter enn bare å trykke på sirkler.',
        'large' => 'Fellesskapskonkurranser',
    ],

    'index' => [
        'nav_title' => 'liste',
    ],

    'voting' => [
        'login_required' => 'Vennligst logg inn for å stemme.',
        'over' => 'Avstemmingen for denne konkurransen har avsluttet',
        'show_voted_only' => '',

        'best_of' => [
            'none_played' => "Det ser ikke ut som du har spilt noen av beatmappene som kvaliseres for denne konkurransen!",
        ],

        'button' => [
            'add' => 'Stem',
            'remove' => 'Fjern stemme',
            'used_up' => 'Du har brukt opp alle stemmene dine',
        ],

        'progress' => [
            '_' => '',
        ],
    ],
    'entry' => [
        '_' => 'deltager',
        'login_required' => 'Vennligst logg inn for å delta i konkurransen.',
        'silenced_or_restricted' => 'Du kan ikke bli med i konkurranser mens du er begrenset eller stum.',
        'preparation' => 'Vi driver for tiden å forbereder denne konkurransen. Vennligst vent tålmodig!',
        'drop_here' => 'Slipp bidraget ditt her',
        'download' => 'Last ned .osz',
        'wrong_type' => [
            'art' => 'Bare .jpg og .png filer er akseptert for denne konkurransen.',
            'beatmap' => 'Bare .osu filer er akseptert for denne konkurransen.',
            'music' => 'Bare .mp3 filer er akseptert for denne konkurransen.',
        ],
        'too_big' => 'Bidrag til denne konkurransen kan maks være :limit.',
    ],
    'beatmaps' => [
        'download' => 'Last ned bidraget',
    ],
    'vote' => [
        'list' => 'stemmer',
        'count' => ':count_delimited stemme|:count_delimited stemmer',
        'points' => ':count_delimited poeng|:count_delimited poeng',
    ],
    'dates' => [
        'ended' => 'Avsluttet :date',
        'ended_no_date' => 'Avsluttet',

        'starts' => [
            '_' => 'Starter :date',
            'soon' => 'snart™',
        ],
    ],
    'states' => [
        'entry' => 'Påmelding åpen',
        'voting' => 'Avstemningen har begynt',
        'results' => 'Resultat er ute',
    ],
];
