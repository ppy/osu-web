<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Toista seuraava kappale automaattisesti',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rytmi on vain klikkauksen päässä! Varustettuna Ouendan/EBA ja Taikosta tutuilla sekä alkuperäisillä pelimuodoilla ja täysin toiminnallisella tasoeditorilla.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => 'kilpailu',
            'contests' => 'kilpailuja',
            'root' => 'konsoli',
            'store_orders' => 'kaupan ylläpitäjä',
        ],

        'artists' => [
            'index' => 'listaus',
        ],

        'changelog' => [
            'index' => 'listaus',
        ],

        'help' => [
            'index' => 'indeksi',
            'sitemap' => 'Sivukartta',
        ],

        'store' => [
            'cart' => 'ostoskori',
            'orders' => 'tilaushistoria',
            'products' => 'tuotteet',
        ],

        'tournaments' => [
            'index' => 'listaus',
        ],

        'users' => [
            'modding' => 'modaus',
            'multiplayer' => 'moninpeli',
            'show' => 'tiedot',
        ],
    ],

    'gallery' => [
        'close' => 'Sulje (Esc)',
        'fullscreen' => 'Vaihda kokoruututila',
        'zoom' => 'Zoomaa sisään/ulos',
        'previous' => 'Edellinen (nuoli vasemmalla)',
        'next' => 'Seuraava (nuoli oikealla)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmapit',
        ],
        'community' => [
            '_' => 'yhteisö',
            'dev' => 'kehitystyö',
        ],
        'help' => [
            '_' => 'apua',
            'getAbuse' => 'ilmoita väärinkäyttöstä',
            'getFaq' => 'ukk',
            'getRules' => 'säännöt',
            'getSupport' => 'tarvitsen siis oikeasti apua!',
        ],
        'home' => [
            '_' => 'etusivu',
            'team' => 'tiimi',
        ],
        'rankings' => [
            '_' => 'tilastot',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'kauppa',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Yleiset',
            'home' => 'Etusivu',
            'changelog-index' => 'Muutosloki',
            'beatmaps' => 'Beatmapit',
            'download' => 'Lataa osu!',
        ],
        'help' => [
            '_' => 'Ohjeet & Yhteisö',
            'faq' => 'Usein kysytyt kysymykset',
            'forum' => 'Keskustelupalsta',
            'livestreams' => 'Suorat lähetykset',
            'report' => 'Ilmoita ongelmasta',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Lakiasiat ja tilanne',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Yksityisyys',
            'server_status' => 'Palvelimen tila',
            'source_code' => 'Lähdekoodi',
            'terms' => 'Käyttöehdot',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Virheellinen pyynnön parametri',
            'description' => '',
        ],
        '404' => [
            'error' => 'Sivu puuttuu',
            'description' => "Pahoittelut, mutta sivu jota hait ei ole täällä!",
        ],
        '403' => [
            'error' => "Sinun ei pitäisi olla täällä.",
            'description' => 'Voisit silti yrittää mennä takaisin.',
        ],
        '401' => [
            'error' => "Sinun ei pitäisi olla täällä.",
            'description' => 'Voisit silti yrittää mennä takaisin. Tai ehkäpä kirjautua sisään.',
        ],
        '405' => [
            'error' => 'Sivu puuttuu',
            'description' => "Pahoittelut, mutta sivu jota hait ei ole täällä!",
        ],
        '422' => [
            'error' => 'Virheellinen pyynnön parametri',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'Hupsista! Jotain taisi hajota! ;_;',
            'description' => "Meille tulee automaattisesti jokaisesta virheestä ilmoitus.",
        ],
        'fatal' => [
            'error' => 'Nyt taisi jokin hajota... ja pahasti ;_;',
            'description' => "Meille tulee automaattisesti jokaisesta virheestä ilmoitus.",
        ],
        '503' => [
            'error' => 'Suljettu huollon ajaksi!',
            'description' => "Huolto kestää yleensä viidestä sekunnista kymmeneen minuuttiin. Jos huolto kestää pidempään, käy katsomassa :link lisätietoja varten.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Kaiken varalta, tässä on koodi jonka voit antaa tukitiimille!",
    ],

    'popup_login' => [
        'button' => 'kirjaudu sisään / rekisteröidy',

        'login' => [
            'forgot' => "Olen unohtanut tietoni",
            'password' => 'salasana',
            'title' => 'Kirjaudu sisään jatkaaksesi',
            'username' => 'käyttäjänimi',

            'error' => [
                'email' => "Käyttäjänimeä tai sähköpostia ei ole",
                'password' => 'Väärä salasana',
            ],
        ],

        'register' => [
            'download' => 'Lataa',
            'info' => 'Tarvitset käyttäjän hyvä mies. Miksei sinulla ole jo sellaista?',
            'title' => "Eikö sinulla ole vielä käyttäjää?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Asetukset',
            'follows' => 'Seurantalistat',
            'friends' => 'Kaverit',
            'logout' => 'Kirjaudu ulos',
            'profile' => 'Profiilini',
        ],
    ],

    'popup_search' => [
        'initial' => 'Kirjoita etsiäksesi!',
        'retry' => 'Haku epäonnistui. Yritä uudelleen napsauttamalla.',
    ],
];
