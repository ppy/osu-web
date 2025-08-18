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

    'card' => [
        'members' => ':count_delimited anggota|:count_delimited anggota',
    ],

    'create' => [
        'submit' => 'Buat Tim',

        'form' => [
            'name_help' => 'Nama tim kamu. Nama ini akan bersifat permanen untuk saat ini.',
            'short_name_help' => 'Maksimum 4 karakter.',
            'title' => "Mari bentuk tim baru",
        ],

        'intro' => [
            'description' => "Bermainlah bersama teman-temanmu; baik yang sudah akrab atau yang baru kamu kenal. Kamu tidak sedang berada di dalam tim. Bergabunglah dengan tim yang sudah ada dengan mengunjungi halaman tim mereka atau buat tim kamu sendiri dari halaman ini.",
            'title' => 'Tim!',
        ],
    ],

    'destroy' => [
        'ok' => 'Tim dihapus.',
    ],

    'edit' => [
        'ok' => 'Pengaturan berhasil disimpan.',
        'title' => 'Pengaturan Tim',

        'description' => [
            'label' => 'Deskripsi',
            'title' => 'Deskripsi Tim',
        ],

        'flag' => [
            'label' => 'Bendera Tim',
            'title' => 'Pasang Bendera Tim',
        ],

        'header' => [
            'label' => 'Gambar Tajuk',
            'title' => 'Pasang Gambar Tajuk',
        ],

        'settings' => [
            'application_help' => 'Apakah pengguna lain akan diizinkan untuk mendaftar ke tim',
            'default_ruleset_help' => 'Ruleset yang akan terpilih secara bawaan pada saat mengunjungi halaman tim',
            'flag_help' => 'Ukuran maksimum :width×:height',
            'header_help' => 'Ukuran maksimum :width×:height',
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
                'accept_confirm' => 'Tambahkan pengguna :user ke tim?',
                'created_at' => 'Diminta Pada',
                'empty' => 'Tidak ada permintaan untuk bergabung pada saat ini.',
                'empty_slots' => 'Slot yang tersedia',
                'empty_slots_overflow' => ':count_delimited kelebihan pengguna|:count_delimited kelebihan pengguna',
                'reject_confirm' => 'Tolak permintaan bergabung dari pengguna :user?',
                'title' => 'Permintaan Bergabung',
            ],

            'table' => [
                'joined_at' => 'Tanggal Bergabung',
                'remove' => 'Keluarkan',
                'remove_confirm' => 'Keluarkan pengguna :user dari tim?',
                'set_leader' => 'Pindahkan kepemimpinan tim',
                'set_leader_confirm' => 'Pindahkan kepemimpinan tim ke pengguna :user?',
                'status' => 'Status',
                'title' => 'Anggota Saat Ini',
            ],

            'status' => [
                'status_0' => 'Tidak aktif',
                'status_1' => 'Aktif',
            ],
        ],

        'set_leader' => [
            'success' => 'Pengguna :user kini menjabat sebagai ketua tim.',
        ],
    ],

    'part' => [
        'ok' => 'Tinggalkan tim ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Percakapan Tim',
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
            'about' => 'Tentang Kami!',
            'info' => 'Info',
            'members' => 'Anggota',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited slot tersedia|:count_delimited slot tersedia',
            'leader' => 'Ketua Tim',
            'rank' => 'Peringkat',
        ],
    ],

    'store' => [
        'ok' => 'Tim telah dibuat.',
    ],
];
