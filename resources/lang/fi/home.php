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
        'download' => 'Lataa nyt',
        'online' => '<strong>:players</strong> juuri nyt online-tilassa <strong>:games</strong> peleissä',
        'peak' => 'Huippu, :count online users',
        'players' => '<strong>:count</strong> rekisteröitynyttä pelaajaa',

        'slogan' => [
            'main' => 'kaikista parhain ilmainen rytmipeli',
            'sub' => 'rytmi on vain klikkauksen päässä',
        ],
    ],

    'search' => [
        'advanced_link' => 'Tarkempi haku',
        'button' => 'Hae',
        'empty_result' => 'Mitään ei löytynyt!',
        'missing_query' => 'Tarvitaan vähintään :n merkin pituinen hakusana',
        'placeholder' => 'kirjoita etsiäksesi',
        'title' => 'Hae',

        'beatmapset' => [
            'more' => ':count lisää hakutulosta',
            'more_simple' => 'Katso lisää hakutuloksia',
            'title' => 'Rytmikartat',
        ],

        'forum_post' => [
            'all' => 'Kaikki foorumit',
            'link' => 'Etsi foorumista',
            'more_simple' => 'Katso lisää foorumien hakutuloksia',
            'title' => 'Foorumi',

            'label' => [
                'forum' => 'etsi foorumeista',
                'forum_children' => 'sisällytä subfoorumit',
                'topic_id' => 'aihe #',
                'username' => 'kirjoittaja',
            ],
        ],

        'mode' => [
            'all' => 'kaikki',
            'beatmapset' => 'rytmikartta',
            'forum_post' => 'foorumi',
            'user' => 'pelaaja',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count lisää pelaaja-hakutulosta',
            'more_simple' => 'Katso lisää pelaaja-hakutuloksia',
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
        'mirror' => 'mirrori',
        'macos-fallback' => 'macOS-käyttäjät',
        'steps' => [
            'register' => [
                'title' => 'luo tili',
                'description' => 'kun käynnistät pelin, seuraa ohjeita sisäänkirjautumiseen tai luo uusi tili',
            ],
            'download' => [
                'title' => 'lataa peli',
                'description' => 'napsauta painiketta ylhäällä ladataksesi asennusohjelma ja suorita se!',
            ],
            'beatmaps' => [
                'title' => 'hanki beatmappeja',
                'description' => [
                    '_' => ':browse laajaa käyttäjien luomaa rytmikarttakirjastoa ja ryhdy pelaamaan!',
                    'browse' => 'selaa',
                ],
            ],
        ],
        'video-guide' => 'video-opas',
    ],

    'user' => [
        'title' => 'hallintapaneeli',
        'news' => [
            'title' => 'Uutiset',
            'error' => 'Virhe ladattaessa uutisia, yritä päivittää sivu?...',
        ],
        'header' => [
            'welcome' => 'Hei, <strong>:username</strong>!',
            'messages' => 'Sinulla on :count uusi viesti|Sinulla on :count uutta viestiä',
            'stats' => [
                'friends' => 'Paikalla olevat ystävät',
                'games' => 'Pelit',
                'online' => 'Käyttäjiä paikalla',
            ],
        ],
        'beatmaps' => [
            'new' => 'Uudet rankatut beatmapit',
            'popular' => 'Suositut rytmikartat',
            'by' => 'luonut',
            'plays' => ':count pelikertaa',
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
            'part-1' => 'Tiesitkö että osu! toimii ilman mainoksia ja turvautuu pelaajien tukeen sen kehitys- ja käyttökustannuksissa?',
            'part-2' => '',
        ],
        'find-out-more' => 'Klikkaa tästä lisätietoja!',
        'download-starting' => "Ai, ja älä huoli - latauksesi on jo aloitettu ;)",
    ],
];
