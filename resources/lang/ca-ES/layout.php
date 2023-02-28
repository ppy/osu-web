<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Reprodueix la següent pista automàticament',
    ],

    'defaults' => [
        'page_description' => 'osu! - El ritme només a un sol *clic*! Amb Ouendan/EBA, Taiko i modes de joc originals, així com un editor de nivells totalment funcional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'portades de beatmapsets',
            'contest' => 'concurs',
            'contests' => 'concursos',
            'root' => 'consola',
        ],

        'artists' => [
            'index' => 'llistat',
        ],

        'beatmapsets' => [
            'show' => 'info',
            'discussions' => 'discussió',
        ],

        'changelog' => [
            'index' => 'llistat',
        ],

        'help' => [
            'index' => 'índex',
            'sitemap' => 'Mapa del lloc',
        ],

        'store' => [
            'cart' => 'cistella',
            'orders' => 'historial de compres',
            'products' => 'productes',
        ],

        'tournaments' => [
            'index' => 'llistat',
        ],

        'users' => [
            'modding' => 'modding',
            'playlists' => 'llistes de joc',
            'realtime' => 'multijugador',
            'show' => 'info',
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
            '_' => 'comunitat',
            'dev' => 'desenvolupament',
        ],
        'help' => [
            '_' => 'ajuda',
            'getAbuse' => 'informar abús',
            'getFaq' => 'preguntes freqüents',
            'getRules' => 'normes',
            'getSupport' => 'no, de debò, necessito ajuda!',
        ],
        'home' => [
            '_' => 'inici',
            'team' => 'equip',
        ],
        'rankings' => [
            '_' => 'classificacions',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'botiga',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
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
            'report' => 'Informa d\'un problema',
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
            'error' => 'Paràmetre de sol·licitud no vàlid',
            'description' => '',
        ],
        '404' => [
            'error' => 'Falta la pàgina',
            'description' => "Ho sentim, però la pàgina que has sol·licitat no és aquí!",
        ],
        '403' => [
            'error' => "No hauries d'estar aquí.",
            'description' => 'Però pots intentar tornar enrere.',
        ],
        '401' => [
            'error' => "No hauries de ser aquí.",
            'description' => 'Pots intentar tornar enrere, o bé iniciar sessió. ',
        ],
        '405' => [
            'error' => 'Pàgina no trobada',
            'description' => "Ho sentim, però la pàgina que sol·licites no és aquí!",
        ],
        '422' => [
            'error' => 'Paràmetre de sol·licitud no vàlid',
            'description' => '',
        ],
        '429' => [
            'error' => 'Límit de freqüència superat',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh no! Alguna cosa s\'ha trencat! ;_;',
            'description' => "Som notificats automàticament de cada error.",
        ],
        'fatal' => [
            'error' => 'Oh no! Alguna cosa ha fallat (de manera greu)! ;_;',
            'description' => "Som notificats automàticament de cada error.",
        ],
        '503' => [
            'error' => 'Fora de servei per manteniment!',
            'description' => "El manteniment normalment triga entre 5 segons i 10 minuts. Si continueu passat aquest temps, veieu :link per a més informació.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Per si de cas, aquí tens un codi que pots enviar a l'equip de suport!",
    ],

    'popup_login' => [
        'button' => 'inicia sessió / registra\'t',

        'login' => [
            'forgot' => "He oblidat les meves dades",
            'password' => 'contrasenya',
            'title' => 'Inicia sessió per continuar',
            'username' => 'nom d\'usuari',

            'error' => [
                'email' => "El nom d'usuari o l'adreça de correu no existeixen",
                'password' => 'Contrasenya incorrecta',
            ],
        ],

        'register' => [
            'download' => 'Descarregar',
            'info' => 'Descarrega osu! per crear el teu propi compte!',
            'title' => "No tens un compte?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Configuració',
            'follows' => 'Llistes de seguiment',
            'friends' => 'Amics',
            'logout' => 'Tanca la sessió',
            'profile' => 'El meu perfil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Escriu per cercar!',
        'retry' => 'Cerca fallada. Clica per tornar-ho a intentar.',
    ],
];
