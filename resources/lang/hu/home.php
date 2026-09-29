<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Letöltés most',
        'online' => 'Jelenleg <strong>:players</strong> játszik <strong>:games</strong> játékban',
        'peak' => 'Csúcsfokon, :count játékos volt elérhető',
        'players' => '<strong>:count</strong> regisztrált játékos',
        'title' => 'üdv',
        'see_more_news' => 'további hírek',

        'slogan' => [
            'main' => 'a legeslegjobb ingyen játszható ritmusjáték',
            'sub' => 'a ritmus csak egy kattintásra van',
        ],
    ],

    'search' => [
        'advanced_link' => 'Részletes keresés',
        'button' => 'Keresés',
        'empty_result' => 'Nincs találat!',
        'keyword_required' => 'Adj meg egy kulcsszót',
        'placeholder' => 'keresendő szöveg',
        'title' => 'Keresés',

        'artist_track' => [
            'more_simple' => 'További kiemelt előadók dalainak keresési eredményei',
        ],
        'beatmapset' => [
            'login_required' => 'Beatmapek kereséséhez jelentkezz be',
            'more' => ':count talált beatmap',
            'more_simple' => 'Több beatmap keresése',
            'title' => 'Beatmapek',
        ],

        'forum_post' => [
            'all' => 'Összes Fórum',
            'link' => 'Forum keresése',
            'login_required' => 'Jelentkezz be, hogy keresni tudj a fórumon',
            'more_simple' => 'Több fórum keresése',
            'title' => 'Fórum',

            'label' => [
                'forum' => 'fórumokban keresés',
                'forum_children' => 'alfórumok tartalmazása',
                'include_deleted' => 'törölt hozzászólásokat tartalmaz',
                'topic_id' => 'téma #',
                'username' => 'szerző',
            ],
        ],

        'mode' => [
            'all' => 'mind',
            'artist_track' => 'kiemelt előadó zenéje',
            'beatmapset' => 'beatmap',
            'forum_post' => 'fórum',
            'team' => 'csapat',
            'user' => 'játékos',
            'wiki_page' => 'wiki',
        ],

        'team' => [
            'login_required' => 'Jelentkezz be csapatok kereséséhez',
            'more_simple' => 'További csapatkeresési eredmények megtekintése',
        ],

        'user' => [
            'login_required' => 'Jelentkezz be, hogy felhasználokat tudj keresni',
            'more' => ':count talált játékos',
            'more_simple' => 'Több játékos mutatása keresésben',
            'more_hidden' => 'Játékos kereső limitálva van :max játékosra. Próbálj pontosabb lenni.',
            'title' => 'Játékosok',
        ],

        'wiki_page' => [
            'link' => 'Wikin keresés',
            'more_simple' => 'Több wiki keresési eredmény megtekintése',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action_lazer_info' => 'lásd ezt az oldalt több információért',
        'download' => 'Letöltés',
        'for_os' => ':os operációs rendszerhez',
        'macos-fallback' => 'macOS használók',
        'mirror' => 'tükör',
        'or' => 'vagy',
        'os_version_or_later' => ':os_version vagy újabb',
        'other_os' => 'egyéb platoformok',
        'quick_start_guide' => 'gyors útmutató',
        'stable_text' => 'ha a régebbit keresed',
        'tagline_1' => 'hát akkor,',
        'tagline_2' => 'kezdjük!',
        'video-guide' => 'videó útmutató',

        'help' => [
            '_' => 'ha meccs indításakor vagy fiók létrehozásánál problémába ütközöl, :help_forum_link vagy :support_button.',
            'help_forum_link' => 'súgófórum megtekintése',
            'support_button' => 'kapcsolatfelvétel',
        ],

        'os' => [
            'windows' => 'Windows rendszerre',
            'macos' => 'macOS rendszerre',
            'linux' => 'Linux rendszerre',
        ],
        'steps' => [
            'register' => [
                'title' => 'hozz létre fiókot',
                'description' => 'kövesd a játék indításakor felugró utasításokat belépéshez vagy regisztráláshoz',
            ],
            'download' => [
                'title' => 'játék letöltése',
                'description' => 'nyomd meg a fenti gombot a telepítő letöltéséhez, majd indítsd el!',
            ],
            'beatmaps' => [
                'title' => 'beatmapek beszerzése',
                'description' => [
                    '_' => ':browse felhasználók által létrehozott hatalmas beatmap könyvtárban és kezd játszani!',
                    'browse' => 'böngéssz',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'áttekintés',
        'news' => [
            'title' => 'Hírek',
            'error' => 'Hiba a hírek betöltése közben, talán próbáld meg újratölteni az oldalt?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Elérhető barátok',
                'games' => 'Játékok',
                'online' => 'Elérhető felhasználók',
            ],
        ],
        'beatmaps' => [
            'daily_challenge' => 'Napi Kihívás Beatmap',
            'new' => 'Új rangsorolt beatmapek',
            'popular' => 'Népszerű beatmapek',
            'by_user' => ':user által',
            'resets' => 'visszaáll :ends',
        ],
        'buttons' => [
            'download' => 'osu! letöltése',
            'support' => 'osu! támogatása',
            'store' => 'osu!bolt',
        ],
        'livestream' => [
            'title' => 'Kiemelt Élő Adás',
        ],
        'show' => [
            'admin' => [
                'page' => 'Admin konzol megnyitása',
            ],
        ],
    ],
];
