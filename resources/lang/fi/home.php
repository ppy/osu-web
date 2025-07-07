<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Lataa nyt',
        'online' => '<strong>:players</strong> tällä hetkellä paikalla <strong>:games</strong> pelissä',
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
        'advanced_link' => 'Edistynyt haku',
        'button' => 'Hae',
        'empty_result' => 'Mitään ei löytynyt!',
        'keyword_required' => 'Syötä hakusana',
        'placeholder' => 'kirjoita hakeaksesi',
        'title' => 'Hae',

        'artist_track' => [
            'more_simple' => '',
        ],
        'beatmapset' => [
            'login_required' => 'Kirjaudu sisään hakeaksesi rytmikarttoja',
            'more' => ':count lisää hakutulosta',
            'more_simple' => 'Katso lisää rytmikarttojen hakutuloksia',
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
                'include_deleted' => 'sisällytä poistetut viestit',
                'topic_id' => 'aihe #',
                'username' => 'tekijä',
            ],
        ],

        'mode' => [
            'all' => 'kaikki',
            'artist_track' => '',
            'beatmapset' => 'beatmap',
            'forum_post' => 'foorumi',
            'team' => '',
            'user' => 'pelaaja',
            'wiki_page' => 'wiki',
        ],

        'team' => [
            'more_simple' => '',
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
        'action' => 'Lataa osu!',
        'action_lazer' => 'Lataa osu!(lazer)',
        'action_lazer_description' => 'seuraava suuri päivitys osu!un',
        'action_lazer_info' => 'lisätietoja saat täältä',
        'action_lazer_title' => 'kokeile osu!(lazer)ia',
        'action_title' => 'lataa osu!',
        'for_os' => 'käyttöjärjestelmälle: :os',
        'macos-fallback' => 'macOS-käyttäjät',
        'mirror' => 'vaihtoehtoinen lataus',
        'or' => 'tai',
        'os_version_or_later' => ':os_version tai uudempi',
        'other_os' => 'muut alustat',
        'quick_start_guide' => 'pikakäyttöohjeet',
        'tagline' => "laitetaan sinut<br>liikkeelle!",
        'video-guide' => 'video-opas',

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
        'steps' => [
            'register' => [
                'title' => 'luo tili',
                'description' => 'käynnistäessäsi pelin, seuraa ohjeita kirjautuaksesi sisään tai luo uusi tili',
            ],
            'download' => [
                'title' => 'lataa peli',
                'description' => 'napsauta yllä olevaa painiketta ladataksesi asennusohjelman ja käynnistä se!',
            ],
            'beatmaps' => [
                'title' => 'hanki beatmappeja',
                'description' => [
                    '_' => ':browse käyttäjien luomaa laajaa rytmikarttakokoelmaa ja ryhdy pelaamaan!',
                    'browse' => 'selaa',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'yleiskatsaus',
        'news' => [
            'title' => 'Uutiset',
            'error' => 'Virhe uutisten lataamisessa, kokeile päivittää sivu?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Kavereita paikalla',
                'games' => 'Pelejä',
                'online' => 'Käyttäjiä paikalla',
            ],
        ],
        'beatmaps' => [
            'daily_challenge' => '',
            'new' => 'Uudet rankatut rytmikartat',
            'popular' => 'Suositut Beatmapit',
            'by_user' => 'tehnyt :user',
            'resets' => '',
        ],
        'buttons' => [
            'download' => 'Lataa osu!',
            'support' => 'Tue osu!a',
            'store' => 'osu!kauppa',
        ],
    ],
];
