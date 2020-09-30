<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Descarcă acum',
        'online' => '<strong>:players</strong> momentan online în <strong>:games</strong> jocuri',
        'peak' => 'Maxim, :count utilizatori online',
        'players' => '<strong>:count</strong> jucători înregistrați',
        'title' => 'bine ai venit',
        'see_more_news' => 'vezi mai multe noutăți',

        'slogan' => [
            'main' => 'cel mai bun joc de ritm free-to-win',
            'sub' => 'ritmul este doar la un clic distanță',
        ],
    ],

    'search' => [
        'advanced_link' => 'Căutare avansată',
        'button' => 'Căutare',
        'empty_result' => 'Nimic găsit!',
        'keyword_required' => 'Un cuvânt cheie este necesar',
        'placeholder' => 'tastează pentru a căuta',
        'title' => 'Caută',

        'beatmapset' => [
            'login_required' => 'Conectați-vă pentru a căuta beatmaps',
            'more' => ':count mai multe rezultate de căutare pentru acest beatmap',
            'more_simple' => 'Vezi mai multe rezultate de căutare pentru acest beatmap',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Toate forumurile',
            'link' => 'Caută pe forum',
            'login_required' => 'Conectați-vă pentru a căuta forumul',
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
            'login_required' => 'Conectați-vă pentru a căuta utilizatori',
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

        'help' => [
            '_' => 'dacă ai o problemă la pornirea jocului pentru înregistrarea contului, :help_forum_link sau :support_button.',
            'help_forum_link' => 'verifică forumul de ajutor',
            'support_button' => 'contactează asistență',
        ],

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
            'stats' => [
                'friends' => 'Prieteni online',
                'games' => 'Jocuri',
                'online' => 'Utilizatori online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Noi beatmaps clasate',
            'popular' => 'Beatmaps populare',
            'by_user' => 'de :user',
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
