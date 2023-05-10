<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Nächstes Lied automatisch abspielen',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rhythmus ist nur ein *Klick* entfernt! Mit Ouendan/EBA, Taiko und originalen Spielmodi, zusätzlich zu einem voll funktionalen Level-Editor.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'Beatmap-Sets',
            'beatmapset_covers' => 'Beatmap-Set-Cover',
            'contest' => 'Wettbewerb',
            'contests' => 'Wettbewerbe',
            'root' => 'Konsole',
        ],

        'artists' => [
            'index' => 'Liste',
        ],

        'beatmapsets' => [
            'show' => 'Info',
            'discussions' => 'Diskussion',
        ],

        'changelog' => [
            'index' => 'Liste',
        ],

        'help' => [
            'index' => 'Index',
            'sitemap' => 'Sitemap',
        ],

        'store' => [
            'cart' => 'Warenkorb',
            'orders' => 'Bestellverlauf',
            'products' => 'Produkte',
        ],

        'tournaments' => [
            'index' => 'Liste',
        ],

        'users' => [
            'modding' => 'Modding',
            'playlists' => 'Playlists',
            'realtime' => 'Mehrspieler',
            'show' => 'Info',
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
            '_' => 'Beatmaps',
        ],
        'community' => [
            '_' => 'Community',
            'dev' => 'Entwicklung',
        ],
        'help' => [
            '_' => 'Hilfe',
            'getAbuse' => 'Missbrauch melden',
            'getFaq' => 'FAQ',
            'getRules' => 'Regeln',
            'getSupport' => 'Ich brauche wirklich Hilfe!',
        ],
        'home' => [
            '_' => 'Home',
            'team' => 'Team',
        ],
        'rankings' => [
            '_' => 'Ranglisten',
            'kudosu' => 'Kudosu',
        ],
        'store' => [
            '_' => 'Store',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Allgemein',
            'home' => 'Home',
            'changelog-index' => 'Änderungsprotokoll',
            'beatmaps' => 'Beatmap-Auflistung',
            'download' => 'osu! herunterladen',
        ],
        'help' => [
            '_' => 'Hilfe & Community',
            'faq' => 'Häufig gestellte Fragen',
            'forum' => 'Community-Foren',
            'livestreams' => 'Livestreams',
            'report' => 'Einen Fehler melden',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Rechtliches & Status',
            'copyright' => 'Urheberrecht (DMCA)',
            'privacy' => 'Privatsphäre',
            'server_status' => 'Serverstatus',
            'source_code' => 'Quellcode',
            'terms' => 'Nutzungsbedingungen',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Ungültige Anfrageparameter',
            'description' => '',
        ],
        '404' => [
            'error' => 'Seite fehlt',
            'description' => "Entschuldigung, aber die angeforderte Seite existiert nicht!",
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
            'description' => "Entschuldigung, aber die angeforderte Seite existiert nicht!",
        ],
        '422' => [
            'error' => 'Ungültige Anfrageparameter',
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
        'button' => 'einloggen / registrieren',

        'login' => [
            'forgot' => "Passwort vergessen",
            'password' => 'Passwort',
            'title' => 'Einloggen, um fortzufahren',
            'username' => 'Benutzername',

            'error' => [
                'email' => "Benutzername oder E-Mail-Adresse existiert nicht",
                'password' => 'Falsches Passwort',
            ],
        ],

        'register' => [
            'download' => 'Herunterladen',
            'info' => 'Lade dir osu! herunter, um dir einen eigenen Account zu erstellen!',
            'title' => "Noch keinen Account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Einstellungen',
            'follows' => 'Merklisten',
            'friends' => 'Freunde',
            'logout' => 'Ausloggen',
            'profile' => 'Mein Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Tippe, um zu suchen!',
        'retry' => 'Suche fehlgeschlagen. Klicke, um es erneut zu versuchen.',
    ],
];
