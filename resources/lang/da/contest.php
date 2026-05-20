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

    'judge' => [
        'comments' => 'kommentarer',
        'hide_judged' => 'skjul bedømte indlæg',
        'nav_title' => 'bedøm',
        'no_current_vote' => 'du har ikke stemt endnu.',
        'update' => 'opdatér',
        'validation' => [
            'missing_score' => 'mangler score',
            'contest_vote_judged' => 'kan ikke stemme i bedømte konkurrencer',
        ],
        'voted' => 'Du har allerede stemt på dette indlæg.',
    ],

    'judge_results' => [
        '_' => 'Bedømmer resultater',
        'creator' => 'kreatør',
        'score' => 'Score',
        'score_std' => 'Standardiseret Score',
        'total_score' => 'samlet score',
        'total_score_std' => 'total samlet score',
    ],

    'voting' => [
        'judge_link' => 'Du er dommeren af denne konkurrence. Bedøm indlæg her!',
        'judged_notice' => 'Denne konkurrence benytter bedømmelsessystemet, dommerne behandler i øjeblikket indlæggene.',
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

        'progress' => [
            '_' => ':used / :max stemmer brugt',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Du skal spile alle beatmaps i denne specifikke playliste før du kan stemme',
            ],
        ],
    ],

    'entry' => [
        '_' => 'entry',
        'login_required' => 'Log venligst ind for at deltage i denne konkurrence.',
        'silenced_or_restricted' => 'Du kan ikke deltage i konkurrencer, når du er mutet eller begrænset.',
        'preparation' => 'Vi er i gang med at forberede den næste konkurrence. Vær tålmodig!',
        'drop_here' => 'Aflever dit bidrag her',
        'allowed_extensions' => ':types filer er accepteret',
        'max_size' => 'Maks. størrelse. :limit',
        'required_dimensions' => 'Dimensioner skal være :widthx:height',
        'download' => 'Download .osz',
        'wrong_file_type' => 'Kun :types filer er accepteret i denne konkurrence.',
        'wrong_dimensions' => 'Indlæg i denne konkurrence skal være :widthx:height',
        'too_big' => 'Bidrag til denne konkurrence kan maks være op til :limit.',
    ],

    'beatmaps' => [
        'download' => 'Download Bidrag',
    ],

    'vote' => [
        'list' => 'stemmer',
        'count' => ':count stemme|:count stemmer',
        'points' => ':count point|:count point',
        'points_float' => ':points point',
    ],

    'dates' => [
        'ended' => 'Sluttede den :date',
        'ended_no_date' => 'Afsluttet',

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

    'show' => [
        'admin' => [
            'page' => 'Vis info og indlæg',
        ],
    ],
];
