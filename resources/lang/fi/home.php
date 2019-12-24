<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'download' => 'Lataa nyt',
        'online' => '<strong>:players</strong> online-tilassa <strong>:games</strong> pelaamassa',
        'peak' => 'Huipussaan :count käyttäjää paikalla',
        'players' => '<strong>:count</strong> rekisteröitynyttä pelaajaa',
        'title' => 'tervetuloa',
        'see_more_news' => '',

        'slogan' => [
            'main' => 'parastakin parempi ilmainen rytmipeli',
            'sub' => 'rytmi on vain klikkauksen päässä',
        ],
    ],

    'search' => [
        'advanced_link' => 'Tarkempi haku',
        'button' => 'Hae',
        'empty_result' => 'Mitään ei löytynyt!',
        'keyword_required' => '',
        'placeholder' => 'kirjoita hakeaksesi',
        'title' => 'Hae',

        'beatmapset' => [
            'more' => ':count lisää hakutulosta',
            'more_simple' => 'Katso lisää hakutuloksia',
            'title' => 'Beatmapit',
        ],

        'forum_post' => [
            'all' => 'Kaikki foorumit',
            'link' => 'Etsi foorumilta',
            'more_simple' => 'Katso lisää foorumien hakutuloksia',
            'title' => 'Foorumi',

            'label' => [
                'forum' => 'etsi foorumeista',
                'forum_children' => 'etsi myös alafoorumeilta',
                'topic_id' => 'aihe #',
                'username' => 'tekijä',
            ],
        ],

        'mode' => [
            'all' => 'kaikki',
            'beatmapset' => 'beatmap',
            'forum_post' => 'foorumi',
            'user' => 'pelaaja',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count hakutulosta lisää',
            'more_simple' => 'Näytä enemmän pelaajia hakutuloksista',
            'more_hidden' => 'Pelaajien etsintä on rajoitettu :max pelaajalle. Kokeile tarkentaa hakua.',
            'title' => 'Pelaajat',
        ],

        'wiki_page' => [
            'link' => 'Etsi wikistä',
            'more_simple' => 'Katso lisää wiki-hakutuloksia',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "laitetaan sinut<br>liikkeelle!",
        'action' => 'Lataa osu!',
        'os' => [
            'windows' => 'Windowsille',
            'macos' => 'macOS:lle',
            'linux' => 'Linuxille',
        ],
        'mirror' => 'vaihtoehtoinen lataus',
        'macos-fallback' => 'macOS-käyttäjät',
        'steps' => [
            'register' => [
                'title' => 'luo tili',
                'description' => 'käynnistäessäsi pelin, seuraa ohjeita kirjautuaksesi sisään tai luo uusi tili',
            ],
            'download' => [
                'title' => 'lataa peli',
                'description' => 'klikkaa ylläolevaa painiketta ladataksesi asennusohjelman ja suorita se!',
            ],
            'beatmaps' => [
                'title' => 'hanki beatmappeja',
                'description' => [
                    '_' => ':browse käyttäjien luomaa laajaa beatmapkokoelmaa ja ryhdy pelaamaan!',
                    'browse' => 'selaa',
                ],
            ],
        ],
        'video-guide' => 'video-opas',
    ],

    'user' => [
        'title' => 'yleiskatsaus',
        'news' => [
            'title' => 'Uutiset',
            'error' => 'Virhe ladattaessa uutisia. Kokeile sivun päivittämistä.',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Kavereita paikalla',
                'games' => 'Pelejä',
                'online' => 'Käyttäjiä paikalla',
            ],
        ],
        'beatmaps' => [
            'new' => 'Uudet Hyväksytyt Beatmapit',
            'popular' => 'Suositut Beatmapit',
            'by_user' => '',
        ],
        'buttons' => [
            'download' => 'Lataa osu!',
            'support' => 'Tue osua!',
            'store' => 'osu!kauppa',
        ],
    ],

    'support-osu' => [
        'title' => 'Vau!',
        'subtitle' => 'Sinulla taitaa olla hauskaa! :D',
        'body' => [
            'part-1' => 'Tiesitkö että osu!a pidetään yllä ilman mainoksia ja turvautuu pelaajien tukeen sen kehitys- ja käyttökustannuksissa?',
            'part-2' => 'Tiesitkö myös että osua! tukemalla saat kasan hyödyllisiä ominaisuuksia, kuten <strong>pelinsisäisen beatmappien lataamisen</strong> joka aktivoituu automaattisesti moninpelissä ja katsojatilassa?',
        ],
        'find-out-more' => 'Klikkaa tästä lisätietoja!',
        'download-starting' => "Niin, ja älä huoli - latauksesi on jo aloitettu ;)",
    ],
];
