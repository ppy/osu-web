<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Reprodueix la següent pista automàticament',
    ],

    'defaults' => [
        'page_description' => '',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => '',
            'contest' => '',
            'contests' => '',
            'root' => '',
        ],

        'artists' => [
            'index' => '',
        ],

        'beatmapsets' => [
            'show' => 'info',
            'discussions' => '',
        ],

        'changelog' => [
            'index' => '',
        ],

        'help' => [
            'index' => '',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => '',
            'orders' => '',
            'products' => '',
        ],

        'tournaments' => [
            'index' => '',
        ],

        'users' => [
            'modding' => '',
            'playlists' => '',
            'realtime' => '',
            'show' => '',
        ],
    ],

    'gallery' => [
        'close' => 'Tancar (Esc)',
        'fullscreen' => 'Alternar pantalla completa',
        'zoom' => 'Apropar/reduir',
        'previous' => 'Anterior (fletxa esquerra)',
        'next' => 'Següent (fletxa dreta)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => '',
            'dev' => '',
        ],
        'help' => [
            '_' => '',
            'getAbuse' => '',
            'getFaq' => '',
            'getRules' => '',
            'getSupport' => 'no, de debò, necessito ajuda!',
        ],
        'home' => [
            '_' => '',
            'team' => '',
        ],
        'rankings' => [
            '_' => '',
            'kudosu' => '',
        ],
        'store' => [
            '_' => '',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '',
            'home' => 'Casa',
            'changelog-index' => 'Registre de canvis',
            'beatmaps' => 'Llistat de beatmaps',
            'download' => 'Descarregar osu!',
        ],
        'help' => [
            '_' => 'Ajuda i comunitat',
            'faq' => 'Preguntes freqüents',
            'forum' => 'Fòrums de la comunitat',
            'livestreams' => 'Transmissions en directe',
            'report' => '',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Estat legal',
            'copyright' => 'Drets d\'autor (DMCA)',
            'privacy' => 'Privacitat',
            'server_status' => 'Estat del servidor',
            'source_code' => 'Codi font',
            'terms' => 'Termes',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '',
            'description' => '',
        ],
        '404' => [
            'error' => 'Falta la pàgina',
            'description' => "",
        ],
        '403' => [
            'error' => "",
            'description' => '',
        ],
        '401' => [
            'error' => "",
            'description' => '',
        ],
        '405' => [
            'error' => '',
            'description' => "",
        ],
        '422' => [
            'error' => '',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh no! Alguna cosa s\'ha trencat! ;_;',
            'description' => "Som notificats automàticament de cada error.",
        ],
        'fatal' => [
            'error' => '',
            'description' => "Som notificats automàticament de cada error.",
        ],
        '503' => [
            'error' => '',
            'description' => "El manteniment normalment triga entre 5 segons i 10 minuts. Si continueu passat aquest temps, veieu :link per a més informació.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "",
    ],

    'popup_login' => [
        'button' => '',

        'login' => [
            'forgot' => "",
            'password' => 'contrasenya',
            'title' => 'Inicia sessió per continuar',
            'username' => '',

            'error' => [
                'email' => "",
                'password' => '',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => '',
            'title' => "",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '',
            'follows' => '',
            'friends' => '',
            'logout' => '',
            'profile' => '',
        ],
    ],

    'popup_search' => [
        'initial' => '',
        'retry' => '',
    ],
];
