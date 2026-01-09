<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Groti kitą takelį automatiškai',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ritmas yra tik per vieną *paspaudimą* nuo tavęs! Su Ouendan/EBA, Taiko ir originaliais žaidimo režimais, taip pat pilnai veikiančiu lygių redagavimo įrankių.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmap\'ų setas',
            'beatmapset_covers' => 'beatmap\'o seto viršeliai',
            'contest' => 'konkursas',
            'contests' => 'konkursai',
            'root' => 'konsolė',
        ],

        'artists' => [
            'index' => 'sąrašas',
        ],

        'beatmapsets' => [
            'show' => 'info',
            'discussions' => 'diskusija',
            'versions' => '',
        ],

        'changelog' => [
            'index' => 'sąrašas',
        ],

        'help' => [
            'index' => 'indeksas',
            'sitemap' => 'Svetainės struktūra',
        ],

        'store' => [
            'cart' => 'krepšelis',
            'orders' => 'užsakymų istorija',
            'products' => 'prekės',
        ],

        'tournaments' => [
            'index' => 'sąrašas',
        ],

        'users' => [
            'modding' => 'taisymai',
            'playlists' => 'grojaraščiai',
            'quickplay' => '',
            'realtime' => 'žaidimas tinkle',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Užverti (Esc)',
        'fullscreen' => 'Perjungti viso ekrano būsena',
        'zoom' => 'Didinti/mažinti mastelį',
        'previous' => 'Ankstesnis (rodyklė į kairę)',
        'next' => 'Sekantis (rodyklė į dešinę)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmap\'ai',
        ],
        'community' => [
            '_' => 'bendruomenė',
            'dev' => 'kūrimas',
        ],
        'help' => [
            '_' => 'pagalba',
            'getAbuse' => 'pranešti apie piktnaudžiavimą',
            'getFaq' => 'duk',
            'getRules' => 'taisyklės',
            'getSupport' => 'ne, tikrai, man reikia pagalbos!',
        ],
        'home' => [
            '_' => 'pagrindinis',
            'team' => 'komanda',
        ],
        'rankings' => [
            '_' => 'reitingai',
        ],
        'store' => [
            '_' => 'parduotuvė',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Bendrieji',
            'home' => 'Pradžia',
            'changelog-index' => 'Pakeitimų sąrašas',
            'beatmaps' => 'Beatmap\'ų sąrašas',
            'download' => 'Atsisiūsti osu!',
        ],
        'help' => [
            '_' => 'Pagalba ir Bendruomenė',
            'faq' => 'Dažniausiai Užduodami Klausimai',
            'forum' => 'Bendruomenės Forumai',
            'livestreams' => 'Tiesioginės Transliacijos',
            'report' => 'Pranešti apie problemą',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Teisė ir Būsena',
            'copyright' => 'Autorinės teisės (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Privatumas',
            'rules' => 'Taisyklės',
            'server_status' => 'Serverio būsena',
            'source_code' => 'Pirminis Kodas',
            'terms' => 'Sąlygos',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Negaliojantis užklausos parametrai',
            'description' => '',
        ],
        '404' => [
            'error' => 'Puslapis Nerastas',
            'description' => "Atsiprašom, bet puslapio, kurio ieškote čia nėra!",
        ],
        '403' => [
            'error' => "Tavęs čia neturėtu būti.",
            'description' => 'Bet gali pabandyti grįžti atgal.',
        ],
        '401' => [
            'error' => "Tavęs čia neturėtu būti.",
            'description' => 'Bet gali pabandyti grįžti atgal. Arba prisijungti.',
        ],
        '405' => [
            'error' => 'Puslapis nerastas',
            'description' => "Atsiprašom, bet puslapio, kurio ieškote čia nėra!",
        ],
        '422' => [
            'error' => 'Negaliojantis užklausos parametrai',
            'description' => '',
        ],
        '429' => [
            'error' => 'Iškvietimų limitas viršytas',
            'description' => '',
        ],
        '500' => [
            'error' => 'O ne! kažkas nesuveikė! ;_;',
            'description' => "Mes automatiškai informuojami apie visas įvykusias klaidas.",
        ],
        'fatal' => [
            'error' => 'O ne! kažkas nesuveikė (stipriai)! ;_;',
            'description' => "Mes automatiškai informuojami apie visas įvykusias klaidas.",
        ],
        '503' => [
            'error' => 'Išjungta tvarkymui!',
            'description' => "Tvarkymas įprastai užtrunka nuo 5 sekundžių iki 10 minučių. Jei neveikia ilgiau, tikrinkite :link dėl papildomos informacijos.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Štai kodas, kuri galite duoti pagalbai, dėl viso pikto!",
    ],

    'popup_login' => [
        'button' => 'prisijungti / registruotis',

        'login' => [
            'forgot' => "Pamiršau prisijungimo duomenys",
            'password' => 'slaptažodis',
            'title' => 'Prisijunk, kad tęsti',
            'username' => 'vartotojo vardas',

            'error' => [
                'email' => "Naudotojas arba el. paštas neegzistuoja",
                'password' => 'Neteisingas slaptažodis',
            ],
        ],

        'register' => [
            'download' => 'Atsisiųsti',
            'info' => 'Atsisiųsk osu!, kad susikurti paskyrą!',
            'title' => "Neturite paskyros?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Nustatymai',
            'follows' => 'Stebėjimo sąrašai',
            'friends' => 'Draugai',
            'legacy_score_only_toggle' => 'Lazer rėžimas',
            'legacy_score_only_toggle_tooltip' => 'Lazer rėžimas rodo lazer rezultatus naudojančius naują taškų skaičiavimo algoritmą',
            'logout' => 'Atsijungti',
            'profile' => 'Mano Profilis',
            'scoring_mode_toggle' => 'Klasikiniai taškai',
            'scoring_mode_toggle_tooltip' => 'Nustatyti kad taškų vertės butu panašesnės į klasikinio neribojamo taškų skaičiavimo',
            'team' => 'Mano Komanda',
        ],
    ],

    'popup_search' => [
        'initial' => 'Ieškokite rašydami!',
        'retry' => 'Paieška nepavyko. Spauskite, kad bandyti iš naujo.',
    ],
];
