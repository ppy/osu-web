<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Ladda ner nu',
        'online' => '<strong>:players</strong> spelare online i <strong>:games</strong> matcher',
        'peak' => 'Som högst, :count spelare online',
        'players' => '<strong>:count</strong> registrerade spelare',
        'title' => 'välkommen',
        'see_more_news' => 'se fler nyheter',

        'slogan' => [
            'main' => 'det bästaste gratis-att-vinna-rytmspelet',
            'sub' => 'rytmen är bara ett klick bort',
        ],
    ],

    'search' => [
        'advanced_link' => 'Avancerad sökning',
        'button' => 'Sök',
        'empty_result' => 'Ingenting hittades!',
        'keyword_required' => 'En sökterm krävs',
        'placeholder' => 'skriv för att söka',
        'title' => 'sök',

        'beatmapset' => [
            'login_required' => 'Logga in för att söka efter beatmaps',
            'more' => ':count fler sökresultat på beatmaps',
            'more_simple' => 'Se fler sökresultat på beatmaps',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alla forum',
            'link' => 'Sök på forumet',
            'login_required' => 'Logga in för att söka i forumet',
            'more_simple' => 'Se fler sökresultat på forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'sök i forumen',
                'forum_children' => 'inkludera subforum',
                'include_deleted' => 'inkludera raderade inlägg',
                'topic_id' => 'ämne #',
                'username' => 'författare',
            ],
        ],

        'mode' => [
            'all' => 'alla',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'spelare',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Logga in för att söka efter användare',
            'more' => ':count fler sökresultat på spelare',
            'more_simple' => 'Se fler sökresultat på spelare',
            'more_hidden' => 'Sökning på spelare är begränsad till :max spelare. Försök att förfina sökningen.',
            'title' => 'Spelare',
        ],

        'wiki_page' => [
            'link' => 'Sök på wikin',
            'more_simple' => 'Se fler sökresultat på wikin',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action' => 'Ladda ner osu!',
        'action_lazer' => 'Ladda ner osu!(lazer)',
        'action_lazer_description' => 'den nästa stora uppdateringen till osu!',
        'action_lazer_info' => 'se denna sida för mer information',
        'action_lazer_title' => 'pröva osu!(lazer)',
        'action_title' => 'installera osu!',
        'for_os' => 'för :os',
        'lazer_note' => 'obs. rankningsliståterställningar tillämpas',
        'macos-fallback' => 'macOS-användare',
        'mirror' => 'mirror',
        'or' => 'eller',
        'os_version_or_later' => ':os_version eller senare',
        'other_os' => 'andra plattformar',
        'quick_start_guide' => 'snabbstartsguide',
        'tagline' => "låt oss<br>få dig igång!",
        'video-guide' => 'videoguide',

        'help' => [
            '_' => 'om du har problem med att starta spelet eller registrera ett konto, :help_forum_link eller :support_button.',
            'help_forum_link' => 'se hjälpforumet',
            'support_button' => 'kontakta support',
        ],

        'os' => [
            'windows' => 'för Windows',
            'macos' => 'för macOS',
            'linux' => 'för Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'skaffa ett konto',
                'description' => 'följ instruktionerna när du startar spelet för att logga in eller skapa ett nytt konto',
            ],
            'download' => [
                'title' => 'installera spelet',
                'description' => 'klicka på knappen ovan för att ladda ner installationsprogrammet, sedan kör du det!',
            ],
            'beatmaps' => [
                'title' => 'skaffa beatmaps',
                'description' => [
                    '_' => ':browse det stora biblioteket av beatmaps skapade av användare och börja spela!',
                    'browse' => 'bläddra',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'kontrollpanel',
        'news' => [
            'title' => 'Nyheter',
            'error' => 'Fel med att ladda in nyheter, försök ladda om sidan?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Vänner online',
                'games' => 'Spel',
                'online' => 'Användare online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nya rankade beatmaps',
            'popular' => 'Populära beatmaps',
            'by_user' => 'av :user',
        ],
        'buttons' => [
            'download' => 'Ladda ner osu!',
            'support' => 'Stötta osu!',
            'store' => 'osu!store',
        ],
    ],
];
