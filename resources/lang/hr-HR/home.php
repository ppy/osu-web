<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Preuzmi',
        'online' => '<strong>:players</strong> trenutno na mreži u <strong>:games</strong> igrama ',
        'peak' => 'Vrhunac, :count korisnika na mreži',
        'players' => '<strong>:count</strong> registriranih igrača',
        'title' => 'dobro došli',
        'see_more_news' => 'pogledaj još vijesti',

        'slogan' => [
            'main' => 'najbolja besplatna ritamska igra',
            'sub' => 'ritam je samo jedan klik od tebe',
        ],
    ],

    'search' => [
        'advanced_link' => 'Napradna pretraga',
        'button' => 'Pretraži',
        'empty_result' => 'Nije pronađeno!',
        'keyword_required' => 'Potrebna je ključna riječ za pretraživanje',
        'placeholder' => 'unesite za pretraživanje',
        'title' => 'pretraži',

        'artist_track' => [
            'more_simple' => 'Vidi još rezultata pretraživanja za pjesme istaknutih izvođača',
        ],
        'beatmapset' => [
            'login_required' => 'Prijavi se kako bi pretražio beatmape',
            'more' => 'Još :count rezultata u pretraživanju beatmapa',
            'more_simple' => 'Vidi još rezultata pretraživanja beatmapa',
            'title' => 'Beatmape',
        ],

        'forum_post' => [
            'all' => 'Svi forumi',
            'link' => 'Pretraga foruma',
            'login_required' => 'Prijavi se kako bi pretražio forum',
            'more_simple' => 'Pogledaj još rezultata pretraživanja foruma',
            'title' => 'Forum',

            'label' => [
                'forum' => 'pretrži u forumima',
                'forum_children' => 'uključi podforume',
                'include_deleted' => 'uključi izbrisane objave',
                'topic_id' => 'tema #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'svi',
            'artist_track' => 'pjesma istaknutog izvođača',
            'beatmapset' => 'beatmapa',
            'forum_post' => 'forum',
            'team' => 'tim',
            'user' => 'igrač',
            'wiki_page' => 'wiki',
        ],

        'team' => [
            'login_required' => '',
            'more_simple' => 'Vidi više rezultata pretraživanja za timove',
        ],

        'user' => [
            'login_required' => 'Prijavi se kako bi pretražio korisnike',
            'more' => 'Još :count rezultata u pretraživanju igrača',
            'more_simple' => 'Još rezultata u pretraživanju igrača',
            'more_hidden' => 'Pretraživanje igrača ograničeno je na :max igrača.  Pokušajte precizirati upit za pretraživanje.',
            'title' => 'Igrači',
        ],

        'wiki_page' => [
            'link' => 'Pretraži wiki',
            'more_simple' => 'Pogledaj još rezultata pretraživanja wikia',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action_lazer_info' => 'provjeri ovu stranicu za više informacija',
        'download' => '',
        'for_os' => 'za :os',
        'macos-fallback' => 'macOS korisnici',
        'mirror' => 'mirror',
        'or' => 'ili',
        'os_version_or_later' => ':os_version ili slično',
        'other_os' => 'druge platforme',
        'quick_start_guide' => 'vodič za brzi početak',
        'stable_text' => '',
        'tagline_1' => '',
        'tagline_2' => '',
        'video-guide' => 'video vodič',

        'help' => [
            '_' => 'ako imaš problema s pokretanjem igre ili registracijom računa, :help_forum_link ili :support_button.',
            'help_forum_link' => 'provjeri forum za pomoć',
            'support_button' => 'kontaktiraj podršku',
        ],

        'os' => [
            'windows' => 'za Windows',
            'macos' => 'za macOS',
            'linux' => 'za Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'nabavi račun',
                'description' => 'slijedite upute prilikom pokretanja igre da se prijavite ili napravite novi račun',
            ],
            'download' => [
                'title' => 'instaliraj igricu',
                'description' => 'klikni gornji gumb za preuzimanje instalacijskog programa, a zatim ga pokreni!',
            ],
            'beatmaps' => [
                'title' => 'nabavi beatmape',
                'description' => [
                    '_' => ':browse golemu knjižnicu beatmapa koje su kreirali korisnici i kreni igrati!',
                    'browse' => 'pretraži',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'kontrolna ploča',
        'news' => [
            'title' => 'Vijesti',
            'error' => 'Pogreška pri učitavanju vijesti, pokušaj osvježiti stranicu?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Prijatelji na mreži',
                'games' => 'Igre',
                'online' => 'Korisnici na mreži ',
            ],
        ],
        'beatmaps' => [
            'daily_challenge' => 'Beatmap dana',
            'new' => 'Nove rangirane beatmape',
            'popular' => 'Popularne beatmape',
            'by_user' => 'od :user',
            'resets' => 'se resetira za :ends',
        ],
        'buttons' => [
            'download' => 'Preuzmi osu!',
            'support' => 'Podrži osu!',
            'store' => 'osu!trgovina',
        ],
        'livestream' => [
            'title' => '',
        ],
        'show' => [
            'admin' => [
                'page' => 'Otvori admin konzolu',
            ],
        ],
    ],
];
