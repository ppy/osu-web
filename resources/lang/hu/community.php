<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Meggyőztél! :D',
            'support' => 'osu! támogatása!',
            'gift' => 'vagy ajándékozz támogatói címet más játékosoknak',
            'instructions' => 'kattints a szívet ábrázoló gombra, hogy továbblépj az osu!boltba',
        ],
        'why-support' => [
            'title' => 'Miért támogatnám az osu!-t? Hova megy a pénz?',

            'team' => [
                'title' => 'Támogasd a Csapatot',
                'description' => 'Egy kis csapat fejleszti és futtatja az osu!-t. A te támogatásod segíti őket, hogy, tudod.. éljenek.',
            ],
            'infra' => [
                'title' => 'Szerver Infrastruktúra',
                'description' => 'A támogatások a szerverekhez mennek amik futtatják a weboldalt, multiplayer szolgáltatásokhoz, online ranglétrákhoz, stb.',
            ],
            'featured-artists' => [
                'title' => 'Kiemelt Előadók',
                'description' => 'A te támogatásoddal mégtöbb nagyszerű előadókat érünk el és szerződtetünk le az osu!-hoz!',
                'link_text' => 'Nézd meg a jelenlegi felállást &raquo;',
            ],
            'ads' => [
                'title' => 'Tartsd az osu!-t önfenntartóvá',
                'description' => 'A ti támogatásotok segíti, hogy a játék független legyen és teljesen hirdetésmentes szponzorok nélkül.',
            ],
            'tournaments' => [
                'title' => 'Hivatalos Versenyek',
                'description' => 'Támogasd a hivatalos osu! Világbajnokság rendezését (és díjait).',
                'link_text' => 'Versenyek felfedezése &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Nyílt forrású bounty program',
                'description' => 'Támogasd a közösséget ami adta az idejét és az erejét, hogy az osu!-t jobbá tegyék.',
                'link_text' => 'Láss többet &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Oh? Mit is kapok?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'gyors és egyszerű beatmap keresés a játék elhagyása nélkül.',
            ],

            'friend_ranking' => [
                'title' => 'Baráti Ranglista',
                'description' => "Nézd meg hogyan álltok a barátaiddal egy beatmapen a ranglistán a játékban, vagy akár a weboldalon is.",
            ],

            'country_ranking' => [
                'title' => 'Országos Ranglista',
                'description' => 'Hódítsd meg az országod mielőtt a világot próbálnád.',
            ],

            'mod_filtering' => [
                'title' => 'Szűrés modok szerint',
                'description' => 'Csak HDHR-es emberekkel akarsz játszani? Nem probléma!',
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
                'description' => 'Korai hozzáférés új kiadásokhoz amikben új funkciókat próbálhatsz ki mielőtt publikusak lennének!',
            ],

            'customisation' => [
                'title' => 'Testreszabás',
                'description' => "Tedd egyedivé a profilod egy teljesen testre szabható felhasználói oldallal.",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Szűrők',
                'description' => 'Keresési szűrő játszott és nem játszott, illetve megszerzett rank által (ha van).',
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
                'description' => 'Lehetőség a felhasználóneved költségmentes megváltoztatására. (maximum egyszer)',
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
                'description' => 'A maximum kedvencelhető beatmapek száma megnövekedett :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Több Barát',
                'description' => 'A maximum barátok száma megnövekedett :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Több Beatmap Feltöltése',
                'description' => 'Hogy mennyi függő beatmapod lehet, az függ egy alap értéktől és egy bónusztól amit minden egyes rangsorolt beatmaptól kapsz, ami jelenleg van neked (egy bizonyos korlátig).<br/><br/> Általában ez az alap érték :base, és ez a plusz :bonus amit rangsorolt beatmapponként kapsz (egészen :bonus_max-ig).
Ha támogató vagy, ez megnövekszik :supporter_base (alap) + :supporter_bonus (bónusz) rangsorolt beatmapponként (egészen :supporter_bonus_max-ig). ',
            ],
            'friend_filtering' => [
                'title' => 'Baráti ranglétrák',
                'description' => 'Versenyezz a barátaiddal és nézd, hogyan válsz jobbá ellenük! *<br/><br/><small>* még nem elérhető az új oldalon, hamarosan(tm)
</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Köszönjük az eddigi támogatásodat! Összesen :dollars adománnyal járultál hozzá :tags: cím vásárlással!',
            'gifted' => "A cím vételeidből :giftedTags ajándékozott (eddig összesen :giftedDollars ajándékozott), milyen nagylelkű!",
            'not_yet' => "Nincsen támogatói címed még :(",
            'valid_until' => 'A jelenlegi támogatói címed eddig érvényes: :date!',
            'was_valid_until' => 'A támogatói címed eddig volt érvényes: :date.',
        ],
    ],
];
