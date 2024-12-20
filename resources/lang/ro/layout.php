<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Redă automat melodia următoare',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ritmul este doar la un *clic* distanță! Cu Ouendan/EBA, Taiko și moduri de joc originale,  precum și un editor de nivel complet funcțional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'fundale beatmapset',
            'contest' => 'concurs',
            'contests' => 'concursuri',
            'root' => 'consolă',
        ],

        'artists' => [
            'index' => 'listă',
        ],

        'beatmapsets' => [
            'show' => 'informații',
            'discussions' => 'discuție',
        ],

        'changelog' => [
            'index' => 'listă',
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
            'index' => 'listă',
        ],

        'users' => [
            'modding' => 'modding',
            'playlists' => 'playlist-uri',
            'realtime' => 'multiplayer',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Închide (Esc)',
        'fullscreen' => 'Comutare fullscreen',
        'zoom' => 'Mărire/Micșorare',
        'previous' => 'Precedent (săgeată stânga)',
        'next' => 'Următor (săgeată dreapta)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmap-uri',
        ],
        'community' => [
            '_' => 'comunitate',
            'dev' => 'dezvoltare',
        ],
        'help' => [
            '_' => 'ajutor',
            'getAbuse' => 'raportează abuz',
            'getFaq' => 'întrebări frecvente',
            'getRules' => 'reguli',
            'getSupport' => 'nu, chiar am nevoie de ajutor!',
        ],
        'home' => [
            '_' => 'acasă',
            'team' => 'echipă',
        ],
        'rankings' => [
            '_' => 'clasamente',
        ],
        'store' => [
            '_' => 'magazin',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Acasă',
            'changelog-index' => 'Istoric modificări',
            'beatmaps' => 'Lista Beatmap-uri',
            'download' => 'Descarcă osu!',
        ],
        'help' => [
            '_' => 'Ajutor & Comunitate',
            'faq' => 'Întrebări Frecvente',
            'forum' => 'Forum-uri',
            'livestreams' => 'Fluxuri Live',
            'report' => 'Raportează o problemă',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legalitate & Statut',
            'copyright' => 'Drepturi de autor (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Confidențialitate',
            'server_status' => 'Starea server-ului',
            'source_code' => 'Cod Sursă',
            'terms' => 'Termeni și Condiții',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Parametri cerere nevalizi',
            'description' => '',
        ],
        '404' => [
            'error' => 'Pagină Lipsă',
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
            'error' => 'Limita de folosire a fost depăşită',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh nu! Ceva s-a stricat! ;_;',
            'description' => "Suntem informați automat de fiecare eroare.",
        ],
        'fatal' => [
            'error' => 'Oh, nu! Ceva s-a stricat (rău)! ;_;',
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
        'button' => 'autentifică-te / înregistrează-te',

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
            'info' => 'Descarcă osu! pentru a-ți crea propriul cont!',
            'title' => "Nu ai un cont?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Setări',
            'follows' => 'Pagini Abonate',
            'friends' => 'Prieteni',
            'legacy_score_only_toggle' => 'Mod lazer',
            'legacy_score_only_toggle_tooltip' => 'Modul lazer afișează scoruri obținute din lazer folosind un algoritm nou de scor',
            'logout' => 'Deconectare',
            'profile' => 'Profilul Meu',
            'scoring_mode_toggle' => 'Mod scor clasic',
            'scoring_mode_toggle_tooltip' => 'Ajustează valorile pentru o experiența mai apropiată de modul clasic de scor fără standardizare',
            'team' => '',
        ],
    ],

    'popup_search' => [
        'initial' => 'Tastați pentru a căuta!',
        'retry' => 'Căutarea nu a reușit. Faceți clic pentru a reîncerca.',
    ],
];
