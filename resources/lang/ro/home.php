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
        'download' => 'Descarcă acum',
        'online' => '<strong>:players</strong> momentan online în <strong>:games</strong> jocuri',
        'peak' => 'Maxim, :count utilizatori online',
        'players' => '<strong>:count</strong> jucători înregistrați',
        'title' => '',

        'slogan' => [
            'main' => 'cel mai bun joc de ritm free-to-win',
            'sub' => 'ritmul este doar la un clic distanță',
        ],
    ],

    'search' => [
        'advanced_link' => 'Căutare avansată',
        'button' => 'Căutare',
        'empty_result' => 'Nimic găsit!',
        'missing_query' => 'Cuvintele cheie trebuie să fie de minim :n caracatere',
        'placeholder' => 'tastează pentru a căuta',
        'title' => 'Caută',

        'beatmapset' => [
            'more' => ':count mai multe rezultate de căutare pentru acest beatmap',
            'more_simple' => 'Vezi mai multe rezultate de căutare pentru acest beatmap',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Toate forumurile',
            'link' => 'Caută pe forum',
            'more_simple' => 'Vezi mai multe rezultate de căutare pe forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'căutare în forumuri',
                'forum_children' => 'include subforumuri',
                'topic_id' => 'subiect #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'tot',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'jucător',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count mai multe rezultate de căutare pentru acest jucător',
            'more_simple' => 'Vezi mai multe rezultate de căutare pentru acest jucător',
            'more_hidden' => 'Căutarea jucătorului este limitată la :max jucători. Încearcă să îți redefinești căutarea.',
            'title' => 'Jucători',
        ],

        'wiki_page' => [
            'link' => 'Caută în wiki',
            'more_simple' => 'Vezi mai multe rezultate de căutare pe wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "să<br>începem!",
        'action' => 'Descarcă osu!',
        'os' => [
            'windows' => 'pentru Windows',
            'macos' => 'pentru macOS',
            'linux' => 'pentru Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'utilizatori macOS',
        'steps' => [
            'register' => [
                'title' => 'obține un cont',
                'description' => 'urmează instrucțiunile când începi jocul pentru a te conecta sau pentru a-ți crea un cont nou',
            ],
            'download' => [
                'title' => 'descarcă jocul',
                'description' => 'dă clic pe butonul de mai sus pentru a descărca programul de instalare, apoi rulează-l!',
            ],
            'beatmaps' => [
                'title' => 'obține beatmaps',
                'description' => [
                    '_' => ':browse vasta bibliotecă de beatmaps create de utilizatori și începe să joci!',
                    'browse' => 'răsfoiește',
                ],
            ],
        ],
        'video-guide' => 'ghid video',
    ],

    'user' => [
        'title' => 'tablou de bord',
        'news' => [
            'title' => 'Știri',
            'error' => 'Eroare la încărcarea știrilor, încearcă să reîmrospătezi pagina?...',
        ],
        'header' => [
            'welcome' => 'Salut, <strong>:username</strong>!',
            'messages' => 'Tu ai :count mesaj nou|Tu ai :count mesaje noi',
            'stats' => [
                'friends' => 'Prieteni online',
                'games' => 'Jocuri',
                'online' => 'Utilizatori online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Noi beatmaps clasate',
            'popular' => 'Beatmaps populare',
            'by' => 'de',
            'plays' => 'jucat de :count de ori',
        ],
        'buttons' => [
            'download' => 'Descarcă osu!',
            'support' => 'Sprijină osu!',
            'store' => 'magazinul osu!',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Se pare că ai un timp plăcut! :D',
        'body' => [
            'part-1' => 'Știai că osu! rulează fără nicio publicitate și se bazează pe jucători pentru a-și susține dezvoltarea și funcționarea?',
            'part-2' => 'De asemenea, știai că prin sprijinirea osu! primești o mulțime de avantaje utile, cum ar fi <strong>descărcarea în joc a beatmapurilor</strong> care se declanșează automat în modul de spectator și jocurile multiplayer?',
        ],
        'find-out-more' => 'Apasă aici pentru a afla mai multe!',
        'download-starting' => "Oh, și nu-ți face griji - descărcarea ta a început deja pentru tine ;)",
    ],
];
