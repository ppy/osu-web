<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Silakan masuk untuk menyunting.',
            'system_generated' => 'Post yang dihasilkan secara otomatis tidak dapat disunting.',
            'wrong_user' => 'Hanya pembuat post yang diperbolehkan untuk menyunting post.',
        ],
    ],

    'events' => [
        'empty' => 'Belum ada yang terjadi.',
    ],

    'index' => [
        'deleted_beatmap' => 'terhapus',
        'none_found' => 'Tidak ada diskusi yang memenuhi kriteria pencarian.',
        'title' => 'Laman Diskusi Beatmap',

        'form' => [
            '_' => 'Cari',
            'deleted' => 'Sertakan diskusi yang telah dihapus',
            'only_unresolved' => 'Hanya tampilkan diskusi yang belum selesai',
            'types' => 'Tipe pesan',
            'username' => 'Nama Pengguna',

            'beatmapset_status' => [
                '_' => 'Status Beatmap',
                'all' => 'Semua',
                'disqualified' => 'Disqualified',
                'never_qualified' => 'Tidak pernah Qualified',
                'qualified' => 'Qualified',
                'ranked' => 'Ranked',
            ],

            'user' => [
                'label' => 'Pengguna',
                'overview' => 'Ringkasan aktivitas',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Tanggal kiriman',
        'deleted_at' => 'Tanggal penghapusan',
        'message_type' => 'Jenis',
        'permalink' => 'Tautan',
    ],

    'nearby_posts' => [
        'confirm' => 'Tidak ada postingan yang membahas masalah saya',
        'notice' => 'Terdapat postingan pada :timestamp (:existing_timestamps). Silakan periksa sebelum memposting.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Masuk untuk Menanggapi',
            'user' => 'Tanggapi',
        ],
    ],

    'review' => [
        'go_to_parent' => 'Lihat Ulasan',
        'go_to_child' => 'Lihat Topik Diskusi',
        'validation' => [
            'invalid_block_type' => 'tipe blok tidak sah',
            'invalid_document' => 'kajian tidak sah',
            'minimum_issues' => 'kajian harus tersusun atas setidaknya :count isu|kajian harus tersusun atas setidaknya :count isu',
            'missing_text' => 'tidak terdapat tulisan pada blok',
            'too_many_blocks' => 'kajian hanya dapat tersusun sepanjang maksimal :count paragraf/isu|kajian hanya dapat tersusun sepanjang maksimal :count paragraf/isu',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Ditandai selesai oleh :user',
            'false' => 'Dibuka ulang oleh :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'umum',
        'general_all' => 'umum (semua)',
    ],

    'user_filter' => [
        'everyone' => 'Semua orang',
        'label' => 'Filter berdasarkan pengguna',
    ],
];
