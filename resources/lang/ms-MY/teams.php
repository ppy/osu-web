<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Pengguna ditambah ke pasukan.',
        ],
        'destroy' => [
            'ok' => 'Permintaan masuk dibatalkan.',
        ],
        'reject' => [
            'ok' => 'Permintaan masuk ditolak.',
        ],
        'store' => [
            'ok' => 'Kemasukan ke pasukan diminta.',
        ],
    ],

    'create' => [
        'submit' => '',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => 'Pasukan dipadam',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Tetapan Pasukan',

        'description' => [
            'label' => 'Keterangan',
            'title' => 'Keterangan Pasukan',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Gambar Kepala',
            'title' => 'Tetapkan Gambar Kepala',
        ],

        'settings' => [
            'application_help' => 'Membenarkan pemain lain memohon masuk pasukan',
            'default_ruleset_help' => 'Ruleset yang dipilih secara asal ketika melawat halaman pasukan',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Tetapan Pasukan',

            'application_state' => [
                'state_0' => 'Ditutup',
                'state_1' => 'Dibuka',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'tetapan',
        'leaderboard' => 'carta kedudukan',
        'show' => 'maklumat',

        'members' => [
            'index' => 'urus ahli',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Kedudukan Dunia',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Ahli pasukan dikeluarkan',
        ],

        'index' => [
            'title' => 'Urus Ahli',

            'applications' => [
                'empty' => 'Tiada permintaan masuk pada masa ini.',
                'empty_slots' => 'Slot tersedia',
                'title' => 'Permintaan Masuk',
                'created_at' => 'Diminta pada',
            ],

            'table' => [
                'status' => 'Taraf',
                'joined_at' => 'Tarikh Masuk',
                'remove' => 'Keluarkan',
                'title' => 'Ahli Semasa',
            ],

            'status' => [
                'status_0' => 'Lengai',
                'status_1' => 'Giat',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Pasukan ditinggalkan ;m;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Bubarkan Pasukan',
            'join' => 'Minta Kemasukan',
            'join_cancel' => 'Batal Kemasukan',
            'part' => 'Tinggalkan Pasukan',
        ],

        'info' => [
            'created' => 'Pembentukan',
        ],

        'members' => [
            'members' => 'Ahli Pasukan',
            'owner' => 'Ketua Pasukan',
        ],

        'sections' => [
            'info' => 'Maklumat',
            'members' => 'Ahli',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
