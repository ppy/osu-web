<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Concurreer op meer manieren dan enkel het klikken van cirkels.',
        'large' => 'Community Wedstrijden',
    ],

    'index' => [
        'nav_title' => 'lijst',
    ],

    'judge' => [
        'comments' => '',
        'hide_judged' => 'verberg beoordeelde items',
        'nav_title' => 'beoordeel',
        'no_current_vote' => 'je hebt nog niet gestemd.',
        'update' => 'werk bij',
        'validation' => [
            'missing_score' => 'ontbrekende score',
            'contest_vote_judged' => 'kan niet stemmen in beoordeelde wedstrijden',
        ],
        'voted' => 'Je hebt al een stem ingediend voor dit item.',
    ],

    'judge_results' => [
        '_' => 'Beoordelingsresultaten',
        'creator' => 'maker',
        'score' => 'Score',
        'score_std' => '',
        'total_score' => 'totale score',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => 'Jij bent een jurylid voor deze wedstrijd. Beoordeel de inzendingen hier!',
        'judged_notice' => 'Deze wedstrijd maakt gebruik van het jurysysteem, de jury verwerkt momenteel de inzendingen.',
        'login_required' => 'Log in om te kunnen stemmen.',
        'over' => 'Je kan niet meer stemmen in deze wedstrijd',
        'show_voted_only' => 'Toon gestemde stemmen',

        'best_of' => [
            'none_played' => "Het lijkt erop dat je geen van de beatmaps in deze wedstrijd hebt gespeeld!",
        ],

        'button' => [
            'add' => 'Stem',
            'remove' => 'Verwijder stem',
            'used_up' => 'Je hebt al je stemmen opgebruikt',
        ],

        'progress' => [
            '_' => ':used / :max stemmen',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Moet alle beatmaps spelen in de opgegeven afspeellijsten voor stemmen',
            ],
        ],
    ],

    'entry' => [
        '_' => 'inzending',
        'login_required' => 'Log in om aan de wedstrijd mee te doen.',
        'silenced_or_restricted' => 'Je kan niet meedoen aan wedstrijden als je restricted of silenced bent.',
        'preparation' => 'We zijn nog bezig met de voorbereidingen van deze wedstrijd. Heb nog even geduld alsjeblieft!',
        'drop_here' => 'Sleep je inzending hier',
        'allowed_extensions' => '',
        'max_size' => '',
        'required_dimensions' => '',
        'download' => 'Download .osz',
        'wrong_file_type' => '',
        'wrong_dimensions' => 'Inzendingen voor deze wedstrijd moeten :widthx:height zijn',
        'too_big' => 'Inzendingen voor deze wedstrijd kunnen maar :limit zijn.',
    ],

    'beatmaps' => [
        'download' => 'Download Inzending',
    ],

    'vote' => [
        'list' => 'stemmen',
        'count' => ':count_delimited stem|:count_delimited stemmen',
        'points' => ':count_delimited punt|:count_delimited punten',
        'points_float' => '',
    ],

    'dates' => [
        'ended' => 'Gesloten :date',
        'ended_no_date' => 'Afgelopen',

        'starts' => [
            '_' => 'Gestart :date',
            'soon' => 'binnenkort™',
        ],
    ],

    'states' => [
        'entry' => 'Inzendingen Open',
        'voting' => 'Stemmen Gestard',
        'results' => 'Resultaten uit',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
