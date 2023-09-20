<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Konkurriere dich auch auf andere Art und Weise, als nur Kreise zu klicken.',
        'large' => 'Community-Wettbewerbe',
    ],

    'index' => [
        'nav_title' => 'Auflistung',
    ],

    'voting' => [
        'login_required' => 'Bitte einloggen, um abzustimmen',
        'over' => 'Die Abstimmung für diesen Wettbewerb ist beendet',
        'show_voted_only' => 'Stimmen anzeigen',

        'best_of' => [
            'none_played' => "Es scheint, als hättest du keine der Beatmaps gespielt, die dich für den Wettbewerb qualifiziert hätten!",
        ],

        'button' => [
            'add' => 'Abstimmen',
            'remove' => 'Stimme entfernen',
            'used_up' => 'Du hast alle deine Stimmen verbraucht',
        ],

        'progress' => [
            '_' => ':used / :max Stimmen vergeben',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Bevor du abstimmen kannst, musst du alle Beatmaps in den angegebenen Playlists gespielt haben',
            ],
        ],
    ],
    'entry' => [
        '_' => 'Einsendung',
        'login_required' => 'Bitte melde dich an, um am Wettbewerb teilzunehmen.',
        'silenced_or_restricted' => 'Du kannst nicht an Wettbewerben teilnehmen, wenn du restricted oder stummgeschaltet bist.',
        'preparation' => 'Wir bereiten diesen Wettbewerb gerade vor. Bitte habe Geduld!',
        'drop_here' => 'Lege deine Einsendung hier ab',
        'download' => '.osz herunterladen',
        'wrong_type' => [
            'art' => 'Nur .jpg und .png-Dateien werden in diesem Wettbewerb akzeptiert.',
            'beatmap' => 'Nur .osu-Dateien werden in diesem Wettbewerb akzeptiert.',
            'music' => 'Nur .mp3-Dateien werden in diesem Wettbewerb akzeptiert.',
        ],
        'wrong_dimensions' => 'Einsendungen für diesen Wettbewerb müssen im Format :widthx:height sein',
        'too_big' => 'Einsendungen in diesem Wettbewerb können nur bis zu :limit groß sein.',
    ],
    'beatmaps' => [
        'download' => 'Einsendung herunterladen',
    ],
    'vote' => [
        'list' => 'Stimmen',
        'count' => ':count_delimited Stimme|:count_delimited Stimmen',
        'points' => ':count_delimited Punkt|:count_delimited Punkte',
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
