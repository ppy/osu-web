<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

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
        'title' => 'Laman Diskusi Beatmap',

        'form' => [
            '_' => 'Cari',
            'deleted' => 'Sertakan diskusi yang telah dihapus',
            'only_unresolved' => '',
            'types' => 'Tipe pesan',
            'username' => 'Nama Pengguna',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
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

    'system' => [
        'resolved' => [
            'true' => 'Ditandai selesai oleh :user',
            'false' => 'Dibuka ulang oleh :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Semua orang',
        'label' => 'Filter berdasarkan pengguna',
    ],
];
