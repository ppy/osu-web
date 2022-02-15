<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Nächstes Lied automatisch abspielen',
    ],

    'defaults' => [
        'page_description' => 'osu! - Der Rhythmus ist nur einen *Klick* entfernt!  Mit Ouendan/EBA, Taiko und eigenen Spielmodi, zusätzlich zu einem voll funktionalen Leveleditor',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'beatmapset covers',
            'contest' => 'wettbewerb',
            'contests' => 'wettbewerbe',
            'root' => 'konsole',
        ],

        'artists' => [
            'index' => 'liste',
        ],

        'changelog' => [
            'index' => 'liste',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Sitemap',
        ],

        'store' => [
            'cart' => 'warenkorb',
            'orders' => 'bestellverlauf',
            'products' => 'produkte',
        ],

        'tournaments' => [
            'index' => 'liste',
        ],

        'users' => [
            'modding' => 'modding',
            'playlists' => '',
            'realtime' => '',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Schließen (Esc)',
        'fullscreen' => 'Vollbild umschalten',
        'zoom' => 'Vergrößern/Verkleinern',
        'previous' => 'Vorheriges (Pfeil links)',
        'next' => 'Weiter (Pfeil rechts)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => 'community',
            'dev' => 'entwicklung',
        ],
        'help' => [
            '_' => 'hilfe',
            'getAbuse' => 'missbrauch melden',
            'getFaq' => 'faq',
            'getRules' => 'regeln',
            'getSupport' => 'ich brauche wirklich hilfe!',
        ],
        'home' => [
            '_' => 'home',
            'team' => 'team',
        ],
        'rankings' => [
            '_' => 'ranglisten',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'shop',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Allgemein',
            'home' => 'Home',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Beatmap-Auflistung',
            'download' => 'osu! herunterladen',
        ],
        'help' => [
            '_' => 'Hilfe & Community',
            'faq' => '\'Frequently Asked Questions\'',
            'forum' => 'Community-Foren',
            'livestreams' => 'Livestreams',
            'report' => 'Einen Fehler melden',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Rechtliches & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Privatsphäre',
            'server_status' => 'Serverstatus',
            'source_code' => 'Quellcode',
            'terms' => 'Nutzungsbedingungen',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Ungültige Anforderungsparameter',
            'description' => '',
        ],
        '404' => [
            'error' => 'Seite fehlt',
            'description' => "Sorry, aber die angeforderte Seite existiert nicht!",
        ],
        '403' => [
            'error' => "Du solltest nicht hier sein.",
            'description' => 'Du könntest versuchen, zurückzugehen.',
        ],
        '401' => [
            'error' => "Du solltest nicht hier sein.",
            'description' => 'Du könntest versuchen, zurückzugehen. Oder dich einloggen.',
        ],
        '405' => [
            'error' => 'Seite fehlt',
            'description' => "Sorry, aber die angeforderte Seite existiert nicht!",
        ],
        '422' => [
            'error' => 'Ungültige Anforderungsparameter',
            'description' => '',
        ],
        '429' => [
            'error' => 'Ratengrenze überschritten',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh nein! Irgendwas ist schiefgelaufen! ;_;',
            'description' => "Wir werden automatisch über jeden Fehler benachrichtigt.",
        ],
        'fatal' => [
            'error' => 'Oh nein! Irgendwas ist extrem schiefgelaufen! ;_;',
            'description' => "Wir werden automatisch über jeden Fehler benachrichtigt.",
        ],
        '503' => [
            'error' => 'Wegen Wartung nicht erreichbar!',
            'description' => "Wartungen dauern in der Regel zwischen 5 Sekunden und 10 Minuten. Sollten wir länger nicht erreichbar sein, schau bei :link für mehr Informationen.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Nur zur Sicherheit ist hier noch ein Code, den du dem Support geben kannst!",
    ],

    'popup_login' => [
        'button' => 'Einloggen / Registrieren',

        'login' => [
            'forgot' => "Passwort vergessen",
            'password' => 'passwort',
            'title' => 'Zum Fortfahren einloggen',
            'username' => 'Benutzername',

            'error' => [
                'email' => "Nutzername oder E-Mail-Adresse existiert nicht",
                'password' => 'Falsches Passwort',
            ],
        ],

        'register' => [
            'download' => 'Herunterladen',
            'info' => 'Sie brauchen einen Account, Sir. Warum besitzen Sie noch keinen?',
            'title' => "Kein Account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Einstellungen',
            'follows' => 'Beobachtungslisten',
            'friends' => 'Freunde',
            'logout' => 'Ausloggen',
            'profile' => 'Mein Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Zum Suchen Text eingeben!',
        'retry' => 'Suche fehlgeschlagen. Klicke, um es erneut zu versuchen.',
    ],
];
