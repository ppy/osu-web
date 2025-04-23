<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => '',
        ],
    ],

    'create' => [
        'submit' => 'Csapat létrehozása',

        'form' => [
            'name_help' => '',
            'short_name_help' => 'Legfeljebb 4 karakter.',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => 'Csapat!',
        ],
    ],

    'destroy' => [
        'ok' => 'Csapat eltávolítva.',
    ],

    'edit' => [
        'ok' => 'A beállítások mentése sikeresen megtörtént.',
        'title' => 'Csapat beállításai',

        'description' => [
            'label' => 'Leírás',
            'title' => 'Csapatleírás',
        ],

        'flag' => [
            'label' => 'Csapatzászló',
            'title' => 'Csapatzászló beállítása',
        ],

        'header' => [
            'label' => 'Fejléc kép',
            'title' => 'Fejléc kép beállítása',
        ],

        'settings' => [
            'application_help' => '',
            'default_ruleset_help' => '',
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
            'title' => 'Tagok kezelése',

            'applications' => [
                'accept_confirm' => '',
                'created_at' => 'Kérelem ideje',
                'empty' => 'Nincs csatlakozási kérelem.',
                'empty_slots' => 'Szabad helyek',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => 'Csatlakozási kérelmek',
            ],

            'table' => [
                'joined_at' => 'Csatlakozás ideje',
                'remove' => 'Eltávolítás',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => 'Állapot',
                'title' => 'Jelenlegi tagok',
            ],

            'status' => [
                'status_0' => 'Inaktív',
                'status_1' => 'Aktív',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => 'Kilépett a csapatból ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Csapat chat',
            'destroy' => 'Csapat feloszlatása',
            'join' => 'Jelentkezés',
            'join_cancel' => 'Jelentkezés visszavonása',
            'part' => 'Kilépés a csapatból',
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
            'rank' => 'Rang',
            'leader' => 'Csapatvezető',
        ],
    ],

    'store' => [
        'ok' => 'Csapat létrehozva.',
    ],
];
