<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Lejupielādēt tagad',
        'online' => '<strong>:players</strong> pašlaik tiešsaistē
<strong>:games</strong> spēles',
        'peak' => 'Visvairāk, :count lietotāji tiešsaistē',
        'players' => '<strong>:count</strong> reģistrētie spēlētāji',
        'title' => 'esi sveicināts',
        'see_more_news' => 'skatīt vairāk jaunumus',

        'slogan' => [
            'main' => 'vislabākā brīvā ritma spēle',
            'sub' => 'ritms ir tikai klikšķa attālumā',
        ],
    ],

    'search' => [
        'advanced_link' => 'Izvērstā meklēšana',
        'button' => 'Meklēt',
        'empty_result' => 'Nekas nav atrasts!',
        'keyword_required' => 'Meklēšanas atslēgvārds ir nepieciešams',
        'placeholder' => 'rakstiet, lai meklētu',
        'title' => 'meklēt',

        'artist_track' => [
            'more_simple' => 'Apskatīt vēl kontraktētā mākslinieka dziesmas meklēšanas rezultātus',
        ],
        'beatmapset' => [
            'login_required' => 'Ielogojieties, lai meklētu bītmapes',
            'more' => ':count vairāk ritma-mapju meklēšanas rezultāti',
            'more_simple' => 'Redzēt vairāk ritma-mapju meklēšanas rezultātus',
            'title' => 'Bītmapes',
        ],

        'forum_post' => [
            'all' => 'Visi forumi',
            'link' => 'Meklēt forumā',
            'login_required' => 'Ieiet, lai meklētu forumā',
            'more_simple' => 'Redzēt vairāk foruma meklēšanas rezultātus',
            'title' => 'Forums',

            'label' => [
                'forum' => 'meklēšana Forumos',
                'forum_children' => 'iekļaut apakšforumus',
                'include_deleted' => 'iekļaut dzēstos rakstus',
                'topic_id' => 'temats #',
                'username' => 'autors',
            ],
        ],

        'mode' => [
            'all' => 'visi',
            'artist_track' => 'kontraktētā mākslinieka dziesmas',
            'beatmapset' => 'bītmape',
            'forum_post' => 'forums',
            'team' => 'komanda',
            'user' => 'spēlētājs',
            'wiki_page' => 'wiki',
        ],

        'team' => [
            'login_required' => '',
            'more_simple' => 'Apskatīt vēl komandas meklēšanas rezultātus',
        ],

        'user' => [
            'login_required' => 'Ieiet, lai meklētu',
            'more' => ':count vairāki spēlētāji meklēšanas rezultātā',
            'more_simple' => 'Rādīt vairāk spēlētāju meklēšanas rezultātus',
            'more_hidden' => 'Spēlētāju meklētājs ir limitēts līdz :max spēlētājiem. Pamēģini precizēt meklējamo. ',
            'title' => 'Spēlētāji',
        ],

        'wiki_page' => [
            'link' => 'Meklēt vikipēdijā',
            'more_simple' => 'Rādīt vairāk wiki meklēšanas rezultātus',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action_lazer_info' => 'apskatīt šo lapu priekš vairāk informācijas',
        'download' => 'Lejupielādēt',
        'for_os' => 'priekš :os',
        'macos-fallback' => 'macOS lietotāji',
        'mirror' => 'instalācija',
        'or' => 'vai',
        'os_version_or_later' => ':os_version vai jaunāku ',
        'other_os' => 'citas platformas',
        'quick_start_guide' => 'ātra sākuma pamācība',
        'stable_text' => 'ja meklē vecāko versiju',
        'tagline_1' => 'sāksim',
        'tagline_2' => 'darbu!',
        'video-guide' => 'video pamācība',

        'help' => [
            '_' => 'ja tev ir problēma ar spēles uzsākšanu vai konta reģistrēšanu, :help_forum_link vai :support_button.',
            'help_forum_link' => 'apskatīt palīdzības forumu',
            'support_button' => 'kontaktēt atbalstu',
        ],

        'os' => [
            'windows' => 'priekš Windows',
            'macos' => 'priekš macOS',
            'linux' => 'priekš Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'izveido profilu',
                'description' => 'seko norādēm, kad palaidīsi spēli, lai varētu ielogoties vai izveidot jaunu kontu',
            ],
            'download' => [
                'title' => 'lejupielādēt spēli',
                'description' => 'spiediet uz augšējās pogas, lai lejupielādētu instalācijas failu, tad palaidiet to!',
            ],
            'beatmaps' => [
                'title' => 'paņemt bītmapi',
                'description' => [
                    '_' => ':browse lietotāju veidoto bītmapju klāstu un sāciet spēlēt!',
                    'browse' => 'pārlūkot',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'ziņojumu dēlis',
        'news' => [
            'title' => 'Jaunumi',
            'error' => 'Kļūda lādējot ziņas, mēģiniet atsvaidzināt lapu?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Draugi Tiešsaistē',
                'games' => 'Spēles',
                'online' => 'Lietotāji Tiešsaistē',
            ],
        ],
        'beatmaps' => [
            'daily_challenge' => 'Dienas Izaicinājuma Ritma-Karte',
            'new' => 'Jaunās Rankotās Bītmapes',
            'popular' => 'Populārās Bītmapes',
            'by_user' => 'pēc :user',
            'resets' => 'restartējās :ends',
        ],
        'buttons' => [
            'download' => 'Lejupielādēt osu!',
            'support' => 'Atbalstīt osu!',
            'store' => 'osu!veikals',
        ],
        'livestream' => [
            'title' => '',
        ],
        'show' => [
            'admin' => [
                'page' => 'Avērt adminu konsoli',
            ],
        ],
    ],
];
