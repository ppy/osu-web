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
            'ok' => 'Kemasukan ke pasukan dipinta.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited ahli',
    ],

    'create' => [
        'submit' => 'Cipta Pasukan',

        'form' => [
            'name_help' => 'Nama pasukan anda. Nama ini kekal buat masa ini.',
            'short_name_help' => 'Maksimum 4 aksara.',
            'title' => "Mari sediakan pasukan baharu",
        ],

        'intro' => [
            'description' => "Main bersama-sama dengan rakan yang ada mahupun yang baharu. Anda kini tiada dalam mana-mana pasukan. Masuk pasukan yang ada dengan melawati halaman pasukan mereka atau cipta pasukan sendiri dari halaman ini.",
            'title' => 'Pasukan!',
        ],
    ],

    'destroy' => [
        'ok' => 'Pasukan dipadam',
    ],

    'edit' => [
        'ok' => 'Tetapan berjaya disimpan.',
        'title' => 'Tetapan Pasukan',

        'description' => [
            'label' => 'Keterangan',
            'title' => 'Keterangan Pasukan',
        ],

        'flag' => [
            'label' => 'Bendera Pasukan',
            'title' => 'Tetapkan Bendera Pasukan',
        ],

        'header' => [
            'label' => 'Gambar Kepala',
            'title' => 'Tetapkan Gambar Kepala',
        ],

        'settings' => [
            'application_help' => 'Membenarkan pemain lain memohon masuk pasukan',
            'default_ruleset_help' => 'Cara main yang dipilih secara asal ketika melawat halaman pasukan',
            'flag_help' => 'Ukuran maksimum :width×:height',
            'header_help' => 'Ukuran maksimum :width×:height',
            'title' => 'Tetapan Pasukan',

            'application_state' => [
                'state_0' => 'Ditutup',
                'state_1' => 'Dibuka',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'tetapan',
        'leaderboard' => 'papan pendahulu',
        'show' => 'maklumat',

        'members' => [
            'index' => 'urus ahli',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Pangkat Dunia',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Ahli pasukan dikeluarkan',
        ],

        'index' => [
            'title' => 'Urus Ahli',

            'applications' => [
                'accept_confirm' => 'Tambah pengguna :user ke pasukan?',
                'created_at' => 'Dipinta Pada',
                'empty' => 'Tiada permintaan masuk pada masa ini.',
                'empty_slots' => 'Slot tersedia',
                'empty_slots_overflow' => ':count_delimited pengguna limpahan',
                'reject_confirm' => 'Tolak permintaan masuk dari pengguna :user?',
                'title' => 'Permintaan Masuk',
            ],

            'table' => [
                'joined_at' => 'Tarikh Masuk',
                'remove' => 'Keluarkan',
                'remove_confirm' => 'Keluarkan pengguna :user dari pasukan?',
                'set_leader' => 'Pindahkan kepimpinan pasukan',
                'set_leader_confirm' => 'Pindahkan kepimpinan pasukan kepada pengguna :user?',
                'status' => 'Taraf',
                'title' => 'Ahli Semasa',
            ],

            'status' => [
                'status_0' => 'Lengai',
                'status_1' => 'Giat',
            ],
        ],

        'set_leader' => [
            'success' => 'Pengguna :user kini ketua pasukan.',
        ],
    ],

    'part' => [
        'ok' => 'Pasukan ditinggalkan ;m;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Bualan Pasukan',
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
            'about' => 'Mengenai Kami!',
            'info' => 'Maklumat',
            'members' => 'Ahli',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited slot tersedia',
            'first_places' => '',
            'leader' => 'Ketua Pasukan',
            'rank' => 'Pangkat',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Pasukan dicipta.',
    ],
];
