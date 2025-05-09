<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Daftar masuk untuk menyunting.',
            'system_generated' => 'Hantaran janaan tatanan tidak boleh disunting.',
            'wrong_user' => 'Pemilik hantaran sahaja boleh menyunting.',
        ],
    ],

    'events' => [
        'empty' => 'Tiada yang terjadi... lagi.',
    ],

    'index' => [
        'deleted_beatmap' => 'dipadam',
        'none_found' => 'Tiada perbincangan sepadan dengan ukur tara carian ditemui.',
        'title' => 'Perbincangan Beatmap',

        'form' => [
            '_' => 'Cari',
            'deleted' => 'Sertakan perbincangan terpadam',
            'mode' => 'Mod peta rentak',
            'only_unresolved' => 'Tunjuk perbincangan tidak selesai sahaja',
            'show_review_embeds' => 'Tunjuk hantaran ulasan',
            'types' => 'Jenis pesanan',
            'username' => 'Nama pengguna',

            'beatmapset_status' => [
                '_' => 'Taraf Peta Rentak',
                'all' => 'Semua',
                'disqualified' => 'Tersingkar',
                'never_qualified' => 'Tidak Pernah Layak',
                'qualified' => 'Layak',
                'ranked' => 'Berkedudukan',
            ],

            'user' => [
                'label' => 'Pengguna',
                'overview' => 'Gambaran kegiatan',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Tarikh hantaran',
        'deleted_at' => 'Tarikh dipadam',
        'message_type' => 'Jenis',
        'permalink' => 'Pautan Kekal',
    ],

    'nearby_posts' => [
        'confirm' => 'Tiada hantaran yang menumpukan perhatian terhadap kebimbangan saya',
        'notice' => 'Terdapat hantaran pada :timestamp (:existing_timestamps). Sila semak sebelum membuat hantaran.',
        'unsaved' => ':count pada ulasan ini',
    ],

    'owner_editor' => [
        'button' => 'Pemilik Kesukaran',
        'reset_confirm' => 'Set semula pemilik kesukaran ini?',
        'user' => 'Pemilik',
        'version' => 'Kesukaran',
    ],

    'refresh' => [
        'checking' => 'Menyemak untuk pengemaskinian...',
        'has_updates' => 'Perbincangan ini mempunyai pengemaskinian, klik untuk segar semula.',
        'no_updates' => 'Tiada pengemaskinian.',
        'updating' => 'Mengemas kini...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Daftar Masuk untuk Menjawab',
            'user' => 'Jawab',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blok diguna',
        'go_to_parent' => 'Lihat Hantaran Ulasan',
        'go_to_child' => 'Lihat Perbincangan',
        'validation' => [
            'block_too_large' => 'setiap blok hanya boleh mengandungi hingga :limit aksara',
            'external_references' => 'ulasan mengandungi rujukan kepada isu yang tiada tempat pada ulasan ini',
            'invalid_block_type' => 'jenis blok tidak sah',
            'invalid_document' => 'ulasan tidak sah',
            'invalid_discussion_type' => 'jenis perbincangan tidak sah',
            'minimum_issues' => 'ulasan mesti mengandungi minimum :count isu',
            'missing_text' => 'blok tiada teks',
            'too_many_blocks' => 'ulasan hanya boleh mengandungi :count perenggan/isu',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Ditanda selesai oleh :user',
            'false' => 'Dibuka semula oleh :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'umum',
        'general_all' => 'umum (semua)',
    ],

    'user_filter' => [
        'everyone' => 'Semua orang',
        'label' => 'Tapis menurut pengguna',
    ],
];
