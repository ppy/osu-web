<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Meggyőztél! :D',
            'support' => 'osu! támogatása',
            'gift' => 'vagy ajándékozz támogatói címet más játékosoknak',
            'instructions' => 'kattints a szívet ábrázoló gombra, hogy továbblépj az osu!boltba',
        ],
        'why-support' => [
            'title' => 'Miért támogatnám az osu!-t? Hova megy a pénz?',

            'team' => [
                'title' => 'Támogasd a Csapatot',
                'description' => 'Egy kis csapat fejleszti és futtatja az osu!-t. A te támogatásod segíti őket, hogy, tudod... éljenek.',
            ],
            'infra' => [
                'title' => 'Szerver Infrastruktúra',
                'description' => 'A támogatások a szerverekhez mennek, amik futtatják a weboldalt, multiplayer szolgáltatásokat, online ranglétrákat, stb.',
            ],
            'featured-artists' => [
                'title' => 'Kiemelt Előadók',
                'description' => 'A te támogatásoddal mégtöbb nagyszerű előadót érünk el és szerződtetünk le az osu!-hoz!',
                'link_text' => 'Nézd meg a jelenlegi felállást &raquo;',
            ],
            'ads' => [
                'title' => 'Tartsd az osu!-t önfenntartóvá',
                'description' => 'A támogatásaid segítenek, hogy a játék teljesen független, és a szponzorokon kívül hirdetésmentes legyen.',
            ],
            'tournaments' => [
                'title' => 'Hivatalos bajnokságok',
                'description' => 'Támogasd a hivatalos osu! Világbajnokság rendezését (és díjait).',
                'link_text' => 'Bajnokságok felfedezése &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Nyílt forrású bounty program',
                'description' => 'Támogasd a közösségi közreműködőket, akik idejükkel és erőfeszítéseikkel teszik jobbá az osu!-t.',
                'link_text' => 'Tudj meg többet &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Szuper! Mit is kapok?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Gyors és egyszerű beatmap keresés és letöltés a játék elhagyása nélkül.',
            ],

            'friend_ranking' => [
                'title' => 'Baráti Ranglista',
                'description' => "Nézd meg hogyan álltok a barátaiddal egy beatmap ranglistáján a játékban és a weboldalon is.",
            ],

            'country_ranking' => [
                'title' => 'Országos Ranglista',
                'description' => 'Hódítsd meg az országod mielőtt a világot próbálnád.',
            ],

            'mod_filtering' => [
                'title' => 'Szűrés Modok szerint',
                'description' => 'Csak HDHR játékosok érdekelnek? Nem probléma!',
            ],

            'auto_downloads' => [
                'title' => 'Automatikus Letöltések',
                'description' => 'Automatikus letöltés többjátékos módban, mások nézése közben, vagy linkre kattintva a csevegőben!',
            ],

            'upload_more' => [
                'title' => 'Tölts fel többet',
                'description' => 'Még több függőben lévő beatmap hely (rangsorolt beatmaponként) maximum 10-ig.',
            ],

            'early_access' => [
                'title' => 'Korai Hozzáférés',
                'description' => 'Korai hozzáférés új kiadásokhoz amikben új funkciókat próbálhatsz ki mielőtt publikusak lennének!<br/><br/>Ez magába foglalja a webhely új funkcióihoz való korai hozzáférést is!',
            ],

            'customisation' => [
                'title' => 'Testreszabás',
                'description' => "Tedd egyedivé a profilod egy teljesen testre szabható felhasználói oldallal.",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Szűrők',
                'description' => 'Beatmap-ek szűrése játszott, nem játszott, illetve elért rang alapján.',
            ],

            'yellow_fellow' => [
                'title' => 'Sárga Kiemelés',
                'description' => 'Légy észrevehető játékon belül az új fényes sárga felhasználóneveddel.',
            ],

            'speedy_downloads' => [
                'title' => 'Gyors Letöltések',
                'description' => 'Kevésbé szigorú letöltési korlátozások, főleg az osu!direct használatánál.',
            ],

            'change_username' => [
                'title' => 'Felhasználónév Csere',
                'description' => 'Az első támogatói vásárlás egy ingyenes felhasználónév változtatást is tartalmaz.',
            ],

            'skinnables' => [
                'title' => 'Skinelhetőség',
                'description' => 'Extra játékon belüli skinelhetőség, mint például a főmenü háttere.',
            ],

            'feature_votes' => [
                'title' => 'Funkció Szavazások',
                'description' => 'Szavazások funkció kérelmekre. (havi 2)',
            ],

            'sort_options' => [
                'title' => 'Rendezési Beállítások',
                'description' => 'A lehetőség országos / baráti / mod-specifikus beatmap ranglétra megtekintésére játékon belül.',
            ],

            'more_favourites' => [
                'title' => 'Több Kedvenc',
                'description' => 'A maximum kedvencelhető beatmap-ek száma megnövekedett :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Több Barát',
                'description' => 'A maximum barátok száma megnövekedett :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Több Beatmap Feltöltése',
                'description' => 'A saját függőben lévő beatmap-ek száma egy alap érték, és egy bónusz szám összege, melyet minden egyes saját rangsorolt beatmap után kapsz (egy bizonyos korlátig).<br/><br/>Ez általában :base plusz :bonus rangsorolt beatmap-enként (max: :bonus_max).
Ha támogató vagy, ez megnövekszik :supporter_base plusz :supporter_bonus rangsorolt beatmap-enként (max: :supporter_bonus_max).',
            ],
            'friend_filtering' => [
                'title' => 'Baráti ranglétrák',
                'description' => 'Versenyezz a barátaiddal és nézd, hogyan állsz hozzájuk képest!',
            ],

        ],
        'supporter_status' => [
            'contribution_with_duration' => '',
            'not_yet' => "Még nincsen támogatói címed :(",
            'valid_until' => 'A jelenlegi támogatói címed eddig érvényes: :date!',
            'was_valid_until' => 'A támogatói címed eddig volt érvényes: :date.',

            'gifted' => [
                '_' => '',
                'users' => '',
            ],
        ],
    ],
];
