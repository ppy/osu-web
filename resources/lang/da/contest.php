<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Konkurrér på flere måder end bare at klikke på cirkler.',
        'large' => 'Fællesskabs-turnerninger',
    ],

    'index' => [
        'nav_title' => 'katalog',
    ],

    'voting' => [
        'login_required' => 'Log venligst ind for at stemme.',
        'over' => 'Afstemning for denne konkurrence er slut',
        'show_voted_only' => 'Vis stemmer',

        'best_of' => [
            'none_played' => "Det ser ikke ud som om, at du har spillet nogle beatmaps, som kvalificerer sig til denne konkurrence!",
        ],

        'button' => [
            'add' => 'Stem',
            'remove' => 'Fjern stemme',
            'used_up' => 'Du har brugt alle dine stemmer',
        ],
    ],
    'entry' => [
        '_' => 'entry',
        'login_required' => 'Log venligst ind for at deltage i denne konkurrence.',
        'silenced_or_restricted' => 'Du kan ikke deltage i konkurrencer, når du er mutet eller begrænset.',
        'preparation' => 'Vi er i gang med at forberede den næste konkurrence. Vær tålmodig!',
        'drop_here' => 'Aflever dit bidrag her',
        'download' => 'Download .osz',
        'wrong_type' => [
            'art' => 'Kun .jpg og .png filer er accepteret i denne konkurrence.',
            'beatmap' => 'Kun .osu filer er accepteret i denne konkurrence.',
            'music' => 'Kun .mp3 filer er accepteret i denne konkurrence.',
        ],
        'too_big' => 'Bidrag til denne konkurrence kan maks være op til :limit.',
    ],
    'beatmaps' => [
        'download' => 'Download Bidrag',
    ],
    'vote' => [
        'list' => 'stemmer',
        'count' => ':count stemme|:count stemmer',
        'points' => ':count point|:count point',
    ],
    'dates' => [
        'ended' => 'Sluttede den :date',
        'ended_no_date' => '',

        'starts' => [
            '_' => 'Starter den :date',
            'soon' => 'snart™',
        ],
    ],
    'states' => [
        'entry' => 'Åbent For Bidrag',
        'voting' => 'Afstemning Begyndt',
        'results' => 'Resultaterne Er Ude',
    ],
];
