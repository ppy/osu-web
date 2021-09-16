<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Redă următorul track în mod automat',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ritmul este doar la un *clic* distanță! Cu Ouendan/EBA, Taiko și moduri de joc originale,  precum și un editor de nivel complet funcțional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'cover-uri beatmapset',
            'contest' => 'concurs',
            'contests' => 'concursuri',
            'root' => 'consolă',
            'store_orders' => 'magazin admin',
        ],

        'artists' => [
            'index' => 'listare',
        ],

        'changelog' => [
            'index' => 'listare',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Harta site-ului',
        ],

        'store' => [
            'cart' => 'coș',
            'orders' => 'istoric comenzi',
            'products' => 'produse',
        ],

        'tournaments' => [
            'index' => 'listare',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => '',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Închide (Esc)',
        'fullscreen' => 'Comută ecran mic/mare',
        'zoom' => 'Mărire/Micșorare',
        'previous' => 'Precedent (săgeată stânga)',
        'next' => 'Următor (săgeată dreapta)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => 'comunitate',
            'dev' => 'dezvoltare',
        ],
        'help' => [
            '_' => 'ajutor',
            'getAbuse' => '',
            'getFaq' => 'întrebări frecvente',
            'getRules' => 'reguli',
            'getSupport' => 'nu, de fapt, am nevoie de ajutor!',
        ],
        'home' => [
            '_' => 'acasă',
            'team' => 'echipă',
        ],
        'rankings' => [
            '_' => 'clasamente',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'magazin',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Acasă',
            'changelog-index' => 'Jurnalul modificărilor',
            'beatmaps' => 'Lista de beatmap',
            'download' => 'Descarcă osu!',
        ],
        'help' => [
            '_' => 'Ajutor & Comunitate',
            'faq' => 'Întrebări fregvente',
            'forum' => 'Forumuri',
            'livestreams' => 'Transmisiuni în direct',
            'report' => 'Raportează o problemă',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legalitate & Statut',
            'copyright' => 'Drepturi de autor (DMCA)',
            'privacy' => 'Confidențialitate',
            'server_status' => 'Starea serverului',
            'source_code' => 'Cod sursă',
            'terms' => 'Termeni și condiții',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Cerere în parametrii invalizi',
            'description' => '',
        ],
        '404' => [
            'error' => 'Pagina lipsește',
            'description' => "Ne pare rău, dar pagina solicitată nu este aici!",
        ],
        '403' => [
            'error' => "Nu ar trebui să fii aici.",
            'description' => 'Ai putea încerca să mergi înapoi, totuși.',
        ],
        '401' => [
            'error' => "Nu ar trebui să fii aici.",
            'description' => 'Ai putea să mergi înapoi, totuși. Sau poate să te conectezi.',
        ],
        '405' => [
            'error' => 'Pagina lipsește',
            'description' => "Ne pare rău, dar pagina solicitată nu este aici!",
        ],
        '422' => [
            'error' => 'Cerere în parametrii invalizi',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh nu! Ceva s-a rupt! ;_;',
            'description' => "Suntem informați automat de fiecare eroare.",
        ],
        'fatal' => [
            'error' => 'Oh, nu! Ceva s-a stricat (serios)! ;_;',
            'description' => "We're automatically notified of every error.",
        ],
        '503' => [
            'error' => 'Inchis pentru mentenanță!',
            'description' => "Mentenanța durează de obicei oriunde între 5 secunde și 10 minute. Dacă durează mai mult, vezi :link pentru mai multe informații.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Pentru orice eventualitate, aici este un cod pe care îl poți oferi pentru asistență!",
    ],

    'popup_login' => [
        'button' => 'autentifică-te / Înregistrează-te',

        'login' => [
            'forgot' => "Mi-am uitat detaliile de autentificare",
            'password' => 'parolă',
            'title' => 'Autentifică-te pentru a continua',
            'username' => 'nume de utilizator',

            'error' => [
                'email' => "Numele de utilizator sau adresa de e-mail nu există",
                'password' => 'Parolă incorectă',
            ],
        ],

        'register' => [
            'download' => 'Descarcă',
            'info' => 'Ai nevoie de un cont, domnule. De ce nu ai unul deja?',
            'title' => "Nu ai un cont?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Setări',
            'follows' => '',
            'friends' => 'Prieteni',
            'logout' => 'Deconectare',
            'profile' => 'Profilul meu',
        ],
    ],

    'popup_search' => [
        'initial' => 'Tastați pentru a căuta!',
        'retry' => 'Căutarea nu a reușit. Faceți clic pentru a reîncerca.',
    ],
];
