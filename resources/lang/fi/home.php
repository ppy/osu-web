<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Lataa nyt',
        'online' => '<strong>:players</strong> online-tilassa <strong>:games</strong> pelaamassa',
        'peak' => 'Huipussaan :count käyttäjää paikalla',
        'players' => '<strong>:count</strong> rekisteröitynyttä pelaajaa',
        'title' => 'tervetuloa',
        'see_more_news' => 'näytä lisää uutisia',

        'slogan' => [
            'main' => 'parastakin parempi ilmainen rytmipeli',
            'sub' => 'rytmi on vain klikkauksen päässä',
        ],
    ],

    'search' => [
        'advanced_link' => 'Tarkempi haku',
        'button' => 'Hae',
        'empty_result' => 'Mitään ei löytynyt!',
        'keyword_required' => 'Syötä hakusana',
        'placeholder' => 'kirjoita hakeaksesi',
        'title' => 'Hae',

        'beatmapset' => [
            'login_required' => 'Kirjaudu sisään käyttääksesi beatmap-hakua',
            'more' => ':count lisää hakutulosta',
            'more_simple' => 'Katso lisää hakutuloksia',
            'title' => 'Beatmapit',
        ],

        'forum_post' => [
            'all' => 'Kaikki foorumit',
            'link' => 'Etsi foorumilta',
            'login_required' => 'Kirjaudu sisään käyttääksesi foorumihakua',
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
            'login_required' => 'Kirjaudu sisään käyttääksesi käyttäjähakua',
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

        'help' => [
            '_' => 'jos sinulla on ongelmia pelin käynnistämisessä tai tilin rekisteröinnissä, :help_forum_link tai :support_button.',
            'help_forum_link' => 'katso apufoorumia',
            'support_button' => 'ota yhteyttä tukeen',
        ],

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
            'by_user' => 'tehnyt :user',
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
