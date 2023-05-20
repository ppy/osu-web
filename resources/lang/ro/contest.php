<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Concurează în mai multe moduri decât doar făcând clic pe cercuri.',
        'large' => 'Concursuri comunitare',
    ],

    'index' => [
        'nav_title' => 'listă',
    ],

    'voting' => [
        'login_required' => 'Te rugăm să te autentifici pentru a vota.',
        'over' => 'Votarea pentru acest concurs s-a încheiat',
        'show_voted_only' => 'Afișare voturi',

        'best_of' => [
            'none_played' => "Nu pare să fi jucat niciun beatmap care se califică pentru acest concurs!",
        ],

        'button' => [
            'add' => 'Votează',
            'remove' => 'Retrage votul',
            'used_up' => 'Ți-ai folosit toate voturile',
        ],

        'progress' => [
            '_' => ':used / :max voturi folosite',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Trebuie să joci toate beatmap-urile din acest playlist înainte de a vota',
            ],
        ],
    ],
    'entry' => [
        '_' => 'intrare',
        'login_required' => 'Te rugăm să te conectezi pentru a intra în concurs.',
        'silenced_or_restricted' => 'Nu poți participa la concursuri în timp ce ești restricționat sau mut.',
        'preparation' => 'Încă pregătim acest concurs. Te rugăm să aștepți cu răbdare!',
        'drop_here' => 'Trage intrarea ta aici',
        'download' => 'Descarcă .osz',
        'wrong_type' => [
            'art' => 'Numai fișierele de tip .jpg și .png sunt acceptate pentru acest concurs.',
            'beatmap' => 'Numai fișierele de tip .osu sunt acceptate pentru acest concurs.',
            'music' => 'Numai fișierele de tip .mp3 sunt acceptate pentru acest concurs.',
        ],
        'wrong_dimensions' => 'Intrările pentru acest concurs trebuie să fie :widthx:height',
        'too_big' => 'Întrările pentru acest concurs pot fi numai până la :limit.',
    ],
    'beatmaps' => [
        'download' => 'Descarcă intrarea',
    ],
    'vote' => [
        'list' => 'voturi',
        'count' => 'un vot|:count_delimited voturi|:count_delimited de voturi',
        'points' => 'un punct|:count_delimited puncte|:count_delimited de puncte',
    ],
    'dates' => [
        'ended' => 'S-a terminat pe :date',
        'ended_no_date' => 'Încheiat',

        'starts' => [
            '_' => 'Începe pe :date',
            'soon' => 'în curând™',
        ],
    ],
    'states' => [
        'entry' => 'Înscriere Deschisă',
        'voting' => 'Votarea a început',
        'results' => 'Rezultate postate',
    ],
];
