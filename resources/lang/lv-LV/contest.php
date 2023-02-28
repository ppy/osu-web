<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Sacensties ne tikai klikšķinot apļus, bet arī citos veidos.',
        'large' => 'Kopienas Konkursi',
    ],

    'index' => [
        'nav_title' => 'saraksts',
    ],

    'voting' => [
        'login_required' => 'Lūdzu, pierakstieties, lai balsotu.',
        'over' => 'Balsošana par šo konkursu ir beigusies',
        'show_voted_only' => 'Rādīt balsotos',

        'best_of' => [
            'none_played' => "Neizskatās, ka jūs spēlējāt kādu no bītmapēm, kas atbilst šim konkursam!",
        ],

        'button' => [
            'add' => 'Balsot',
            'remove' => 'Noņemt balsojumu',
            'used_up' => 'Jūs esat izlietojis visas savas balsis',
        ],

        'progress' => [
            '_' => ':used / :max balsis izmantotas',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Pirms balsošanas ir jāspēlē visas bītmapes norādītajos sarakstos',
            ],
        ],
    ],
    'entry' => [
        '_' => 'pieteikums',
        'login_required' => 'Lūdzu, pierakstieties, lai piedalītos konkursā.',
        'silenced_or_restricted' => 'Jūs nevarat piedalīties konkursos, kamēr esat ierobežots vai apklusināts.',
        'preparation' => 'Mēs pašlaik gatavojam šo konkursu. Lūdzu, pacietīgi gaidiet!',
        'drop_here' => 'Iemetiet savu pieteikumu šeit',
        'download' => 'Lejupielādēt .osz',
        'wrong_type' => [
            'art' => 'Šajā konkursā pieņem tikai .jpg un .png failus.',
            'beatmap' => 'Šajā konkursā tiek pieņemti tikai .osu faili.',
            'music' => 'Šajā konkursā tiek pieņemti tikai .mp3 faili.',
        ],
        'wrong_dimensions' => 'Šajā konkursā pieteikumiem jābūt :widthx:height',
        'too_big' => 'Dalība šajā konkursā var būt tikai līdz :limit.',
    ],
    'beatmaps' => [
        'download' => 'Lejupielādēt Pieteikumu',
    ],
    'vote' => [
        'list' => 'balsis',
        'count' => ':count_delimited balss|:count_delimited balsis',
        'points' => ':count_delimited punkts|:count_delimited punkti',
    ],
    'dates' => [
        'ended' => 'Beidzās :date',
        'ended_no_date' => 'Beidzās',

        'starts' => [
            '_' => 'Sākas :date',
            'soon' => 'drīz™',
        ],
    ],
    'states' => [
        'entry' => 'Pieteikums Atvērts',
        'voting' => 'Balsošana Sākās',
        'results' => 'Rezultāti Pieejami',
    ],
];
