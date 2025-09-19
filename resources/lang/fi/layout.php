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
            'beatmapset' => 'rytmikarttasetti',
            'beatmapset_covers' => 'beatmapsettien kannet',
            'contest' => 'kilpailu',
            'contests' => 'kilpailuja',
            'root' => 'konsoli',
        ],

        'artists' => [
            'index' => 'listaus',
        ],

        'beatmapsets' => [
            'show' => 'tiedot',
            'discussions' => 'keskustelut',
        ],

        'changelog' => [
            'index' => 'listaus',
        ],

        'help' => [
            'index' => 'indeksi',
            'sitemap' => 'Sivustokartta',
        ],

        'store' => [
            'cart' => 'ostoskärry',
            'orders' => 'tilaushistoria',
            'products' => 'tuotteet',
        ],

        'tournaments' => [
            'index' => 'listaus',
        ],

        'users' => [
            'modding' => 'modaus',
            'playlists' => 'soittolistat',
            'realtime' => 'moninpeli',
            'show' => 'tiedot',
        ],
    ],

    'gallery' => [
        'close' => 'Sulje (Esc)',
        'fullscreen' => 'Vaihda kokoruututila',
        'zoom' => 'Lähennä/loitonna',
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
            'getAbuse' => 'ilmoita väärinkäytöstä',
            'getFaq' => 'usein kysytyt',
            'getRules' => 'säännöt',
            'getSupport' => 'tarvitsen siis oikeasti apua!',
        ],
        'home' => [
            '_' => 'etusivu',
            'team' => 'tiimi',
        ],
        'rankings' => [
            '_' => 'tilastot',
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
            'beatmaps' => 'Rytmikarttojen listaus',
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
            'copyright' => 'Tekijänoikeudet (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Yksityisyys',
            'rules' => '',
            'server_status' => 'Palvelimen tilanne',
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
            'error' => 'Pyyntöraja ylitetty',
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
            'forgot' => "Olen unohtanut kirjatutumistietoni",
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
            'info' => 'Lataa osu! luodaksesi oman käyttäjätunnuksen!',
            'title' => "Eikö sinulla ole vielä käyttäjää?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Asetukset',
            'follows' => 'Seurantalistat',
            'friends' => 'Kaverit',
            'legacy_score_only_toggle' => 'Lazer-tila',
            'legacy_score_only_toggle_tooltip' => 'Lazer-tila näyttää uuden pisteytysalgoritmin avulla saadut tulokset',
            'logout' => 'Kirjaudu ulos',
            'profile' => 'Oma profiili',
            'scoring_mode_toggle' => 'Klassinen pisteytys',
            'scoring_mode_toggle_tooltip' => 'Säädä pistemäärät tuntumaan enemmän klassiselta rajoittamattomalta pisteytykseltä',
            'team' => 'Minun tiimini',
        ],
    ],

    'popup_search' => [
        'initial' => 'Kirjoita hakeaksesi!',
        'retry' => 'Haku epäonnistui. Yritä uudelleen napsauttamalla.',
    ],
];
