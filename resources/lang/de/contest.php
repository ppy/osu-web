<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Tritt gegen mehr als nur Kreise an.',
        'large' => 'Community Wettbewerbe',
    ],

    'index' => [
        'nav_title' => 'liste',
    ],

    'voting' => [
        'login_required' => 'Zum Abstimmen bitte einloggen.',
        'over' => 'Die Abstimmung für diesen Wettbewerb ist beendet',
        'show_voted_only' => 'Stimmen anzeigen',

        'best_of' => [
            'none_played' => "Es scheint, als hättest du keine der Beatmaps gespielt, die dich für den Wettbewerb qualifiziert hätten!",
        ],

        'button' => [
            'add' => 'Abstimmen',
            'remove' => 'Vote entfernen',
            'used_up' => 'Du hast alle deine Votes verwendet',
        ],
    ],
    'entry' => [
        '_' => 'entry',
        'login_required' => 'Zum Beitreten bitte einloggen.',
        'silenced_or_restricted' => 'Man kann restricted oder stummgeschaltet nicht an Wettbewerben teilnehmen.',
        'preparation' => 'Wir bereiten diesen Wettbewerb gerade vor. Bitte habe Geduld!',
        'drop_here' => 'Lege deine Einsendung hier ab',
        'download' => '.osz herunterladen',
        'wrong_type' => [
            'art' => 'Nur .jpg und .png-Dateien werden in diesem Wettbewerb akzeptiert.',
            'beatmap' => 'Nur .osu-Dateien werden in diesem Wettbewerb akzeptiert.',
            'music' => 'Nur .mp3-Dateien werden in diesem Wettbewerb akzeptiert.',
        ],
        'too_big' => 'Einsendungen in diesem Wettbewerb können nur bis zu :limit groß sein.',
    ],
    'beatmaps' => [
        'download' => 'Einsendung herunterladen',
    ],
    'vote' => [
        'list' => 'stimmen',
        'count' => ':count Vote |:count Votes',
        'points' => ':count Punkt |:count Punkte',
    ],
    'dates' => [
        'ended' => 'Endete am :date',
        'ended_no_date' => 'Beendet',

        'starts' => [
            '_' => 'Startet am :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => 'Einsendungen offen',
        'voting' => 'Abstimmung gestartet',
        'results' => 'Ergebnisse bekanntgegeben',
    ],
];
