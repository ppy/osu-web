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

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'saved' => 'Pengaturan berhasil disimpan',
        'title' => 'Pengaturan Tim',

        'description' => [
            'label' => 'Deskripsi',
            'title' => 'Deskripsi Tim',
        ],

        'header' => [
            'label' => 'Gambar Tajuk',
            'title' => 'Pasang Gambar Tajuk',
        ],

        'logo' => [
            'label' => 'Bendera Tim',
            'title' => 'Pasang Bendera Tim',
        ],

        'settings' => [
            'application' => 'Pendaftaran Tim',
            'application_help' => 'Apakah pengguna lain akan diizinkan untuk mendaftar ke tim',
            'default_ruleset' => 'Ruleset Bawaan',
            'default_ruleset_help' => 'Ruleset yang akan terpilih secara bawaan pada saat mengunjungi halaman tim',
            'title' => 'Pengaturan Tim',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Ditutup',
                'state_1' => 'Dibuka',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
        'performance' => '',
        'total_score' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Anggota tim dikeluarkan',
        ],

        'index' => [
            'title' => 'Kelola Anggota',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
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
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Dibentuk pada',
            'website' => 'Situs web',
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
];
