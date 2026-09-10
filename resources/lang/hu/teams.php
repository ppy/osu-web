<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Felvettem egy felhasználót a csapatba.',
        ],
        'destroy' => [
            'ok' => 'Kérelem megszakítva.',
        ],
        'reject' => [
            'ok' => 'Elutasították a kérelmet.',
        ],
        'store' => [
            'ok' => 'Kérelem elküldve.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited tag|:count_delimited tagok',
    ],

    'create' => [
        'submit' => 'Csapat Létrehozása',

        'form' => [
            'name_help' => 'A csapatod neve. A név jelenleg végleges.',
            'short_name_help' => 'Legfeljebb 4 karakter.',
            'title' => "Alkossunk egy új csapatot",
        ],

        'intro' => [
            'description' => "Játssz együtt barátaiddal – akár a régiekkel, akár újakkal. Jelenleg nem vagy tagja egyetlen csapatnak sem. Csatlakozz egy :search_link csapathoz a csapat oldalának felkeresésével, vagy hozz létre saját csapatot ezen az oldalon.",
            'search_link' => 'létező csapat',
            'title' => 'Csapat!',
        ],
    ],

    'destroy' => [
        'ok' => 'Csapat eltávolítva.',
    ],

    'edit' => [
        'ok' => 'A beállítások mentése sikeresen megtörtént.',
        'title' => 'Csapat Beállításai',

        'description' => [
            'label' => 'Leírás',
            'title' => 'Csapatleírás',
        ],

        'flag' => [
            'label' => 'Csapatzászló',
            'title' => 'Csapatzászló Beállítása',
        ],

        'header' => [
            'label' => 'Fejléc Kép',
            'title' => 'Fejléc Kép Beállítása',
        ],

        'settings' => [
            'application_help' => 'Hogy engedélyezzék-e az embereknek, hogy jelentkezzenek a csapatba',
            'default_ruleset_help' => 'A csapatoldal megnyitásakor alapértelmezésként kiválasztandó szabálykészlet',
            'flag_help' => 'Legfeljebb :width×:height méretű',
            'header_help' => 'Legfeljebb :width×:height méretű',
            'title' => 'Csapat beállításai',

            'application_state' => [
                'state_0' => 'Zárt',
                'state_1' => 'Nyílt',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'beállítások',
        'leaderboard' => 'ranglista',
        'show' => 'információ',

        'members' => [
            'index' => 'tagok kezelése',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Globális rang',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Csapattag eltávolítva',
        ],

        'index' => [
            'title' => 'Tagok Kezelése',

            'applications' => [
                'accept_confirm' => 'Fel kell venni a(z) :user felhasználót a csapatba?',
                'created_at' => 'Kérelem Ideje',
                'empty' => 'Nincs csatlakozási kérelem.',
                'empty_slots' => 'Szabad Helyek',
                'empty_slots_overflow' => ':count_delimited felhasználó túlcsordulás|:count_delimited felhasználók túlcsordulás',
                'reject_confirm' => 'Elutasítsa a(z) :user felhasználó csatlakozási kérését?',
                'title' => 'Csatlakozási Kérelmek',
            ],

            'table' => [
                'joined_at' => 'Csatlakozás Ideje',
                'remove' => 'Eltávolítás',
                'remove_confirm' => 'Töröljük a(z) :user felhasználót a csapatból?',
                'set_leader' => 'A csapat vezetésének átadása',
                'set_leader_confirm' => 'A csapat vezetését átadni a(z) :user felhasználónak?',
                'status' => 'Állapot',
                'title' => 'Jelenlegi Tagok',
            ],

            'status' => [
                'status_0' => 'Inaktív',
                'status_1' => 'Aktív',
            ],
        ],

        'set_leader' => [
            'success' => 'A :user felhasználó mostantól a csapatvezető.',
        ],
    ],

    'part' => [
        'ok' => 'Kilépett a csapatból ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Csapat Chat',
            'destroy' => 'Csapat Feloszlatása',
            'join' => 'Jelentkezés',
            'join_cancel' => 'Jelentkezés Visszavonása',
            'part' => 'Kilépés a Csapatból',
        ],

        'info' => [
            'created' => 'Létrehozva',
        ],

        'members' => [
            'members' => 'Csapattagok',
            'owner' => 'Csapatvezető',
        ],

        'sections' => [
            'about' => 'Rólunk!',
            'info' => 'Információ',
            'members' => 'Tagok',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited szabad hely|:count_delimited szabad helyek',
            'first_places' => 'Első helyek',
            'leader' => 'Csapatvezető',
            'rank' => 'Rang',
            'ranked_beatmapsets' => 'Rangsorolt beatmapek',
        ],
    ],

    'store' => [
        'ok' => 'Csapat létrehozva.',
    ],
];
