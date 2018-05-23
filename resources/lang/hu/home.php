<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'landing' => [
        'download' => 'Letöltés',
        'online' => 'Jelenleg <strong>:players</strong> játszik <strong>:games</strong> játékban',
        'peak' => 'Csúcsfokon, :count játékos volt elérhető',
        'players' => '<strong>:count</strong> regisztrált játékos',

        'slogan' => [
            'main' => 'a legeslegjobb ingyen játszható ritmusjáték',
            'sub' => 'a ritmus csak egy kattintásra van',
        ],
    ],

    'search' => [
        'advanced_link' => 'Összetett kereső',
        'button' => 'Keresés',
        'empty_result' => 'Nincs találat!',
        'missing_query' => 'Minimum :n karatkerrel keress',
        'placeholder' => 'keresendő szöveg',
        'title' => 'Keresés',

        'beatmapset' => [
            'more' => ':count talált beatmap',
            'more_simple' => 'Több beatmap keresése',
            'title' => 'Beatmap-ek',
        ],

        'forum_post' => [
            'all' => 'Összes forum',
            'link' => 'Forum keresése',
            'more_simple' => 'Több forum keresése',
            'title' => 'Forum',

            'label' => [
                'forum' => 'forumokban keresés',
                'forum_children' => 'alforumok tartalmazása',
                'topic_id' => 'témák #',
                'username' => 'szerző',
            ],
        ],

        'mode' => [
            'all' => 'mind',
            'beatmapset' => 'beatmap',
            'forum_post' => 'fórum',
            'user' => 'játékos',
            'wiki_page' => 'wiki',
        ],

        'user' => [
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
        'tagline' => "kezdjük<br>el!",
        'action' => 'osu! letöltése',
        'os' => [
            'windows' => 'Windows rendszerre',
            'macos' => 'macOS rendszerre',
            'linux' => 'Linux rendszerre',
        ],
        'mirror' => 'tükör',
        'macos-fallback' => 'macOS használók',
        'steps' => [
            'register' => [
                'title' => 'hozz létre fiókot',
                'description' => 'kövesse az utasításokat, amikor kezdődik a játék belépéshez vagy regisztráláshoz',
            ],
            'download' => [
                'title' => 'Játék letöltése',
                'description' => 'nyomja meg a gombot a telepítő letöltéséhez, majd indítsa el!',
            ],
            'beatmaps' => [
                'title' => 'beatmap-ek beszerzése',
                'description' => [
                    '_' => ':browse a beatmap lista hatalmas ajánlatából és kezdj játszani!',
                    'browse' => 'tallóz',
                ],
            ],
        ],
        'video-guide' => 'segitő videó',
    ],

    'user' => [
        'title' => 'áttekintő',
        'news' => [
            'title' => 'Hírek',
            'error' => 'Hiba a hírek betöltése közben, talán próbáld meg újratölteni az oldalt?...',
        ],
        'header' => [
            'welcome' => 'Üdv, <strong>:username</strong>!',
            'messages' => ':count új üzeneted van | :count új üzeneted van',
            'stats' => [
                'friends' => 'Elérhető barátok',
                'games' => 'Játékok',
                'online' => 'Elérhető felhasználók',
            ],
        ],
        'beatmaps' => [
            'new' => 'Új Rangsorolt Beatmap-ek',
            'popular' => 'Felkapott beatmapek',
            'by' => ':user által',
            'plays' => 'játszva :count alkalommal',
        ],
        'buttons' => [
            'download' => 'osu! letöltése',
            'support' => 'osu! támogatása',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Úgy néz ki nagyon jól szórakozol! :D',
        'body' => [
            'part-1' => 'Tudtad-e, hogy az osu! reklámok nélkül van fenntartva, és teljesen a játékosok támogatásán alapul a fejlesztés és a futtatási költség?',
            'part-2' => 'Tudtad-e, hogy az osu! támogatásával olyan hasznos dolgokat kapsz mint például a <strong>játékon belüli letöltés</strong> ami autómatikusan dolgozni kezd nező módban és multiplayer játékokban?',
        ],
        'find-out-more' => 'Kattints ide, hogy többet megtudj!',
        'download-starting' => "Oh, ne aggódj - a letöltésed már elindult ;)",
    ],
];
