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

    'judge' => [
        'comments' => 'komentāri',
        'hide_judged' => 'paslēpt vērtētos ierakstus',
        'nav_title' => 'tiesāt',
        'no_current_vote' => 'tu vēl nebalsoji.',
        'update' => 'atjaunināt',
        'validation' => [
            'missing_score' => 'trūkst rezultāts',
            'contest_vote_judged' => 'nevar balsot vērtētos konkursos',
        ],
        'voted' => 'Tu jau esi balsojis par šo ierakstu.',
    ],

    'judge_results' => [
        '_' => 'Vērtēšanas rezultāti',
        'creator' => 'autors',
        'score' => 'Rezultāts',
        'score_std' => 'Standartizēti Rezultāti',
        'total_score' => 'Kopējais rezultāts',
        'total_score_std' => 'kopējais standartizēto rezultātu skaits',
    ],

    'voting' => [
        'judge_link' => 'Tu esi šī konkursa tiesnesis. Iesniegtos ierakstus vērtē šeit!',
        'judged_notice' => 'Šajā konkursā tiek izmantota vērtēšanas sistēma, vērtētāji pašlaik apstrādā iesniegtos darbus.',
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
        'allowed_extensions' => '',
        'max_size' => '',
        'required_dimensions' => '',
        'download' => 'Lejupielādēt .osz',
        'wrong_file_type' => '',
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
        'points_float' => ':points punkti',
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

    'show' => [
        'admin' => [
            'page' => 'Apskatīt informāciju un ierakstes',
        ],
    ],
];
