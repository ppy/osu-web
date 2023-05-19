<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Kamu harus masuk untuk menyunting.',
            'system_generated' => 'Post yang dibuat secara otomatis tidak dapat disunting.',
            'wrong_user' => 'Hanya pembuat post yang diperbolehkan untuk menyunting post.',
        ],
    ],

    'events' => [
        'empty' => 'Belum ada hal apapun yang terjadi... hingga saat ini.',
    ],

    'index' => [
        'deleted_beatmap' => 'telah dihapus',
        'none_found' => 'Tidak ada topik diskusi yang sesuai dengan kriteria pencarian.',
        'title' => 'Laman Diskusi Beatmap',

        'form' => [
            '_' => 'Cari',
            'deleted' => 'Sertakan diskusi yang telah dihapus',
            'mode' => 'Mode beatmap',
            'only_unresolved' => 'Hanya tampilkan topik diskusi yang belum terjawab',
            'types' => 'Tipe pesan',
            'username' => 'Nama Pengguna',

            'beatmapset_status' => [
                '_' => 'Status Beatmap',
                'all' => 'Semua',
                'disqualified' => 'Disqualified',
                'never_qualified' => 'Belum Pernah Qualified',
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
        'created_at' => 'Tanggal dibuat',
        'deleted_at' => 'Tanggal penghapusan',
        'message_type' => 'Jenis',
        'permalink' => 'Tautan',
    ],

    'nearby_posts' => [
        'confirm' => 'Saya tidak menemukan adanya postingan yang membahas isu yang ingin saya angkat',
        'notice' => 'Terdapat postingan lain di sekitar :timestamp (:existing_timestamps). Harap periksa apakah isu yang ingin kamu angkat telah dibahas oleh pengguna lain sebelumnya.',
        'unsaved' => ':count pada kajian ini',
    ],

    'owner_editor' => [
        'button' => 'Kepemilikan Tingkat Kesulitan',
        'reset_confirm' => 'Atur ulang pemilik tingkat kesulitan ini?',
        'user' => 'Pemilik',
        'version' => 'Tingkat Kesulitan',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Masuk untuk Menanggapi',
            'user' => 'Tanggapi',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blok telah digunakan',
        'go_to_parent' => 'Lihat Kajian',
        'go_to_child' => 'Lihat Topik Diskusi',
        'validation' => [
            'block_too_large' => 'masing-masing poin yang dikaji terbatas pada :limit karakter',
            'external_references' => 'kajian mengandung poin yang merujuk pada isu yang tidak berasal dari kajian ini',
            'invalid_block_type' => 'tipe blok tidak valid',
            'invalid_document' => 'kajian tidak valid',
            'invalid_discussion_type' => 'tipe diskusi tidak valid',
            'minimum_issues' => 'kajian harus mengandung setidaknya :count isu|kajian harus mengandung setidaknya :count isu',
            'missing_text' => 'blok tidak mengandung teks',
            'too_many_blocks' => 'kajian hanya dapat mengandung maksimal :count paragraf/isu|kajian hanya dapat mengandung maksimal :count paragraf/isu',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Ditandai sebagai telah terjawab oleh :user',
            'false' => 'Dibuka kembali oleh :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'umum',
        'general_all' => 'umum (semua)',
    ],

    'user_filter' => [
        'everyone' => 'Semua',
        'label' => 'Saring berdasarkan pengguna',
    ],
];
