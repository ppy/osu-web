<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'I-play agad ang sumusunod na mga track',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ang ritmo ay isang *click* na lang! Mayroong Oudendan/EBA, Taiko at orihinal na mga gameplay mode, pati na rin ang gumaganang level editor.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'mga cover ng beatmapset',
            'contest' => 'paligsahan',
            'contests' => 'mga paligsahan',
            'root' => 'console',
        ],

        'artists' => [
            'index' => 'listahan',
        ],

        'changelog' => [
            'index' => 'listahan',
        ],

        'help' => [
            'index' => 'indeks',
            'sitemap' => 'Sitemap',
        ],

        'store' => [
            'cart' => 'kariton',
            'orders' => 'mga nagdaang pinamili',
            'products' => 'mga produkto',
        ],

        'tournaments' => [
            'index' => 'listahan',
        ],

        'users' => [
            'modding' => 'modding',
            'playlists' => '',
            'realtime' => '',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Saraduhin (Esc)',
        'fullscreen' => 'I-fullscreen/I-windowed',
        'zoom' => 'Palakihin/Paliitin',
        'previous' => 'Nagdaan (panang pakaliwa)',
        'next' => 'Susunod (panang pakanan)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'mga beatmap',
        ],
        'community' => [
            '_' => 'komunidad',
            'dev' => 'development',
        ],
        'help' => [
            '_' => 'tulong',
            'getAbuse' => 'i-ulat ang pag-abuso',
            'getFaq' => 'faq',
            'getRules' => 'mga patakaran',
            'getSupport' => 'hindi, kailangan ko talaga ng tulong!',
        ],
        'home' => [
            '_' => 'home',
            'team' => 'koponan',
        ],
        'rankings' => [
            '_' => 'kataasan',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'tindahan',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Home',
            'changelog-index' => 'Listahan ng Pagbabago',
            'beatmaps' => 'Listahan ng mga Beatmap',
            'download' => 'I-download ang osu!',
        ],
        'help' => [
            '_' => 'Tulong & Komunidad',
            'faq' => 'Mga Madalas na Tinatanong',
            'forum' => 'Mga Forum ng Komunidad',
            'livestreams' => 'Live Streams',
            'report' => 'Mag-ulat ng Isyu',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legal & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Palihim',
            'server_status' => 'Katayuan ng server',
            'source_code' => 'Source Code',
            'terms' => 'Terms',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Ang iyong request ay hindi katugma-tugma',
            'description' => '',
        ],
        '404' => [
            'error' => 'Nawawala ang Pahina',
            'description' => "Sori, pero wala dito ang hinihiling mong pahina!",
        ],
        '403' => [
            'error' => "Hindi ka dapat dito.",
            'description' => 'Pero maaari kang bumalik.',
        ],
        '401' => [
            'error' => "Hindi ka dapat dito.",
            'description' => 'Pero maaari kang bumalik. O pwedeng mag-sign in.',
        ],
        '405' => [
            'error' => 'Nawawala ang Pahina',
            'description' => "Sori, pero wala dito ang hinihiling mong pahina!",
        ],
        '422' => [
            'error' => 'Ang iyong request ay hindi katugma-tugma',
            'description' => '',
        ],
        '429' => [
            'error' => 'Nahigitan na ang rate-limit',
            'description' => '',
        ],
        '500' => [
            'error' => 'Naku! May nasira! ;_;',
            'description' => "Agad naiuulat sa amin ang bawat error.",
        ],
        'fatal' => [
            'error' => 'Naku! May (talagang) nasira! ;_;',
            'description' => "Agad naiuulat sa amin ang bawat error.",
        ],
        '503' => [
            'error' => 'May inaayos!',
            'description' => "Ang pagpapanatili ay karaniwang tumatagal mula sa 5 segundo hanggang sa 10 minuto. Kung mas matagal pa, tingnan :link para sa mga karagdagang impormasyon.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Kung sakali, dito ay isang code na mabibigay mo sa support!",
    ],

    'popup_login' => [
        'button' => 'magsign-in / gumawa ng account',

        'login' => [
            'forgot' => "Nalimutan ko ang aking mga detalye",
            'password' => 'password',
            'title' => 'Mag-sign In Upang Tumuloy',
            'username' => 'username',

            'error' => [
                'email' => "Hindi umiiral ang username o email address",
                'password' => 'Maling password',
            ],
        ],

        'register' => [
            'download' => 'Mag-download',
            'info' => 'Kailangan mo ng account, sir. Bakit wala ka pa?',
            'title' => "Walang account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Mga Setting',
            'follows' => 'Tala ng mga binabantayan',
            'friends' => 'Mga Kaibigan',
            'logout' => 'Mag-sign Out',
            'profile' => 'Aking Profile',
        ],
    ],

    'popup_search' => [
        'initial' => 'Mag-type para maghanap!',
        'retry' => 'Nabigo ang paghahanap. I-click upang subukan muli.',
    ],
];
