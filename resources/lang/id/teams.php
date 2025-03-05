<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Pengguna ditambahkan ke tim.',
        ],
        'destroy' => [
            'ok' => 'Permintaan bergabung dibatalkan.',
        ],
        'reject' => [
            'ok' => 'Permintaan bergabung ditolak.',
        ],
        'store' => [
            'ok' => 'Permintaan bergabung dikirim.',
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
        'ok' => 'Tim dihapus',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Pengaturan Tim',

        'description' => [
            'label' => 'Deskripsi',
            'title' => 'Deskripsi Tim',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Gambar Tajuk',
            'title' => 'Pasang Gambar Tajuk',
        ],

        'settings' => [
            'application_help' => 'Apakah pengguna lain akan diizinkan untuk mendaftar ke tim',
            'default_ruleset_help' => 'Ruleset yang akan terpilih secara bawaan pada saat mengunjungi halaman tim',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Pengaturan Tim',

            'application_state' => [
                'state_0' => 'Ditutup',
                'state_1' => 'Dibuka',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'pengaturan',
        'leaderboard' => 'papan peringkat',
        'show' => 'info',

        'members' => [
            'index' => 'kelola anggota',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Peringkat Global',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Anggota tim dikeluarkan',
        ],

        'index' => [
            'title' => 'Kelola Anggota',

            'applications' => [
                'empty' => 'Tidak ada permintaan untuk bergabung pada saat ini.',
                'empty_slots' => 'Slot yang tersedia',
                'title' => 'Permintaan Bergabung',
                'created_at' => 'Diminta Pada',
            ],

            'table' => [
                'status' => 'Status',
                'joined_at' => 'Tanggal Bergabung',
                'remove' => 'Keluarkan',
                'title' => 'Anggota Saat Ini',
            ],

            'status' => [
                'status_0' => 'Tidak aktif',
                'status_1' => 'Aktif',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Tinggalkan tim ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Bubarkan Tim',
            'join' => 'Minta Gabung',
            'join_cancel' => 'Batal Gabung',
            'part' => 'Tinggalkan Tim',
        ],

        'info' => [
            'created' => 'Dibentuk pada',
        ],

        'members' => [
            'members' => 'Anggota Tim',
            'owner' => 'Ketua Tim',
        ],

        'sections' => [
            'info' => 'Info',
            'members' => 'Anggota',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
