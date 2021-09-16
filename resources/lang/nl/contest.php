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

    'voting' => [
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
    ],
    'entry' => [
        '_' => 'inzending',
        'login_required' => 'Log in om aan de wedstrijd mee te doen.',
        'silenced_or_restricted' => 'Je kan niet meedoen aan wedstrijden als je restricted of silenced bent.',
        'preparation' => 'We zijn nog bezig met de voorbereidingen van deze wedstrijd. Heb nog even geduld alsjeblieft!',
        'drop_here' => 'Sleep je inzending hier',
        'download' => 'Download .osz',
        'wrong_type' => [
            'art' => 'Alleen .jpg en .png bestanden worden geaccepteerd voor deze wedstrijd.',
            'beatmap' => 'Alleen .osu bestanden worden geaccepteerd voor deze wedstrijd.',
            'music' => 'Alleen .mp3 bestanden worden geaccepteerd voor deze wedstrijd.',
        ],
        'too_big' => 'Inzendingen voor deze wedstrijd kunnen maar :limit zijn.',
    ],
    'beatmaps' => [
        'download' => 'Download Inzending',
    ],
    'vote' => [
        'list' => 'stemmen',
        'count' => ':count stem|:count stemmen',
        'points' => ':count punt|:count punten',
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
];
