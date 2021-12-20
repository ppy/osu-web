<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Spela nästa låt automatiskt',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rytmen är bara ett *klick* bort!  Med Ouendan/EBA, Taiko och originella spellägen, dessutom med en fullt funktionell nivåredigerare.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'beatmapset-omslag',
            'contest' => 'tävling',
            'contests' => 'tävlingar',
            'root' => 'konsol',
        ],

        'artists' => [
            'index' => 'listning',
        ],

        'changelog' => [
            'index' => 'listning',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Sitemap',
        ],

        'store' => [
            'cart' => 'varukorg',
            'orders' => 'orderhistorik',
            'products' => 'produkter',
        ],

        'tournaments' => [
            'index' => 'listning',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => 'flerspelarläge',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Stäng (Esc)',
        'fullscreen' => 'Fullskärm på/av',
        'zoom' => 'Zooma in/ut',
        'previous' => 'Föregående (vänsterpil)',
        'next' => 'Nästa (högerpil)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => 'gemenskap',
            'dev' => 'utveckling',
        ],
        'help' => [
            '_' => 'hjälp',
            'getAbuse' => 'rapportera missbruk',
            'getFaq' => 'faq',
            'getRules' => 'regler',
            'getSupport' => 'nej, på riktigt, jag behöver hjälp!',
        ],
        'home' => [
            '_' => 'hem',
            'team' => 'lag',
        ],
        'rankings' => [
            '_' => 'rankning',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'butik',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Allmänt',
            'home' => 'Hem',
            'changelog-index' => 'Ändringslogg',
            'beatmaps' => 'Beatmap-listningar',
            'download' => 'Ladda ner osu!',
        ],
        'help' => [
            '_' => 'Hjälp & gemenskap',
            'faq' => 'Vanliga frågor',
            'forum' => 'Gemenskaps-forum',
            'livestreams' => 'Livestreams',
            'report' => 'Rapportera ett problem',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Juridik & status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Sekretess',
            'server_status' => 'Serverstatus',
            'source_code' => 'Källkod',
            'terms' => 'Användarvillkor',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Ogiltiga förfrågningsparametrar',
            'description' => '',
        ],
        '404' => [
            'error' => 'Sida saknas',
            'description' => "Förlåt, men sidan du efterfrågade finns inte här!",
        ],
        '403' => [
            'error' => "Du borde inte vara här.",
            'description' => 'Du kan däremot försöka gå tillbaka.',
        ],
        '401' => [
            'error' => "Du borde inte vara här.",
            'description' => 'Du kan däremot försöka gå tillbaka. Eller kanske logga in.',
        ],
        '405' => [
            'error' => 'Sida saknas',
            'description' => "Förlåt, men sidan du efterfrågade finns inte här!",
        ],
        '422' => [
            'error' => 'Ogiltiga förfrågningsparametrar',
            'description' => '',
        ],
        '429' => [
            'error' => 'Gränsen har överskridits',
            'description' => '',
        ],
        '500' => [
            'error' => 'Åh nej! Något gick sönder! ;_;',
            'description' => "Vi blir automatiskt notifierade om varje fel.",
        ],
        'fatal' => [
            'error' => 'Åh nej! Något gick (verkligen) sönder! ;_;',
            'description' => "Vi blir automatiskt notifierade om varje fel.",
        ],
        '503' => [
            'error' => 'Nere för underhåll!',
            'description' => "Underhåll brukar oftast ta från 5 sekunder till 10 minuter. Om vi är nere längre, se :link för mer information.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Bara ifall att, här är en kod du kan ge till support!",
    ],

    'popup_login' => [
        'button' => 'logga in / registrera dig ',

        'login' => [
            'forgot' => "Jag har glömt mina uppgifter",
            'password' => 'lösenord',
            'title' => 'Logga in för att fortsätta',
            'username' => 'användarnamn',

            'error' => [
                'email' => "Användarnamn eller e-postadress finns inte",
                'password' => 'Fel lösenord',
            ],
        ],

        'register' => [
            'download' => 'Ladda ner',
            'info' => 'Ladda ner osu! för att skapa ditt eget konto!',
            'title' => "Har du inte ett konto?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Inställningar',
            'follows' => 'Bevakningslistor',
            'friends' => 'Vänner',
            'logout' => 'Logga ut',
            'profile' => 'Min profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Skriv för att söka!',
        'retry' => 'Sökning misslyckades. Klicka för att försöka igen.',
    ],
];
