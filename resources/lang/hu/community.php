<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Szereted az osu!-t?<br/>                                Támogasd az osu! fejlesztését! :D',
            'small_description' => '',
            'support_button' => 'Támogatni szeretném az osu!-t',
        ],

        'dev_quote' => 'Az osu! egy teljesen ingyenes játék, a fenntartása viszont már kevésbé mondható annak.
        A szerverek és a magas minőségű nemzetközi sávszélesség üzembe helyezése, a rendszerek és a közösség fenntartása, a díjak                                                         
        szolgáltatása versenyekre, a felhasználók kérdéseinek megválaszolása valamint a boldogságuk fenntartása, mindezek között az osu! 
        elég jelentős összeget emészt fel.
        Oh, és ne feledjük azt a tényt sem, hogy mindezt reklámok, olcsó toolbar-okkal való partnerség és hasonló badarságok nélkül szolgáltatjuk!
            <br/><br/>Mindezt beleszámítva, az osu!-t nagyrészt én tartom fenn, akit "peppy"-ként ismerhettek.
            Ott kellett hagynom a munkámat, hogy lépést tarthassak az osu!-val,
            és előfordul, hogy küszködnöm kell az általam elvárt színvonal fenntartásáért.
            Személyes köszönetemet szeretném küldeni azoknak akik eddig az osu! támogatása mellett döntöttek,
            és azoknak szintúgy, akik a jövőben is támogatni fogják ezt a csodálatos játékot és közösséget :).',

        'supporter_status' => [
            'contribution' => 'Köszönjük az eddigi támogatásodat! Összesen :dollars adománnyal járultál hozzá :tags: cím vásárlással!',
            'gifted' => 'A cím vételeidből :giftedTags ajándékozott (eddig összesen :giftedDollars ajándékozott), milyen nagylelkű!',
            'not_yet' => "Nincsen támogatói címed még :(",
            'title' => 'Jelenlegi támogatói állapot',
            'valid_until' => 'A jelenlegi támogatói címed eddig érvényes: :date!',
            'was_valid_until' => 'A támogatói címed eddig volt érvényes: :date.',
        ],

        'why_support' => [
            'title' => 'Miért kellene támogatnom az osu!-t!?',
            'blocks' => [
                'dev' => 'Nagyrészt egy ausztrál fickó által fejlesztve és karbantartva',
                'time' => 'A fenntartása annyi időt emészt fel, hogy már nem nagyon nevezhető "hobbinak".',
                'ads' => 'Egyetlen reklám sincs. <br/><br/>
                        A web 99.95%-ával ellentétben, mi nem abból profitálunk, hogy dolgokat nyomunk az arcodba.',
                'goodies' => 'Kapsz néhány extra jóságot!',
            ],
        ],

        'perks' => [
            'title' => 'Oh? Mit is kapok?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'gyors és egyszerű beatmap keresés a játék elhagyása nélkül.',
            ],

            'auto_downloads' => [
                'title' => 'Automatikus Letöltések',
                'description' => 'Automatikus letöltés többjátékos módban, mások nézése közben, vagy linkre kattintva a chat-ben!',
            ],

            'upload_more' => [
                'title' => 'Tölts fel többet',
                'description' => 'Még több függőben lévő beatmap hely (rangsorolt beatmap-onként) maximum 10-ig.',
            ],

            'early_access' => [
                'title' => 'Korai Hozzáférés',
                'description' => 'Korai hozzáférés új kiadásokhoz amikben új funkciókat próbálhatsz ki mielőtt publikusak lennének!',
            ],

            'customisation' => [
                'title' => 'Testreszabás',
                'description' => 'Tedd egyedivé a profilod egy teljesen testre szabható felhasználói oldallal.',
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

            'feel_special' => [
                'title' => 'Érezd magad különlegesnek',
                'description' => 'A meleg és bolyhos érzés attól, hogy segíted az osu! problémamentes működését!',
            ],

            'more_to_come' => [
                'title' => 'Több is jön',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Meggyőztél! :D',
            'support' => 'osu! támogatása!',
            'gift' => 'vagy ajándékozz támogatói címet más játékosoknak',
            'instructions' => 'kattints a szívet ábrázoló gombra, hogy továbblépj az osu!boltba',
        ],
    ],
];
