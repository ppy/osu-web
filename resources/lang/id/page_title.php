<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'admin',
    ],
    'error' => [
        'error' => [
            '400' => 'permintaan tidak valid',
            '404' => 'tidak ditemukan',
            '403' => 'terlarang',
            '401' => 'tidak terotorisir',
            '401-verification' => 'verifikasi akun',
            '405' => 'tidak ditemukan',
            '422' => 'permintaan tidak valid',
            '429' => 'terlalu banyak permintaan',
            '500' => 'terdapat masalah',
            '503' => 'pemeliharaan',
        ],
    ],
    'forum' => [
        '_' => 'forum',
        'topic_logs_controller' => [
            'index' => 'log topik',
        ],
    ],
    'main' => [
        'account_controller' => [
            'verify_link' => 'verifikasi akun',
        ],
        'artists_controller' => [
            '_' => 'featured artist',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'postingan diskusi beatmap',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'diskusi beatmap',
        ],
        'beatmap_packs_controller' => [
            '_' => 'paket beatmap',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'perolehan suara diskusi beatmap',
        ],
        'beatmapset_events_controller' => [
            '_' => 'riwayat beatmap',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'diskusi beatmap',
            'index' => 'daftar beatmap',
            'show' => 'info beatmap',
            'versions' => 'riwayat versi beatmap',
        ],
        'changelog_controller' => [
            '_' => 'riwayat perubahan',
        ],
        'chat_controller' => [
            '_' => 'chat',
        ],
        'comments_controller' => [
            '_' => 'komentar',
        ],
        'contest_entries_controller' => [
            'judge_results' => 'hasil penjurian kontes',
        ],
        'contests_controller' => [
            '_' => 'kontes',
            'judge' => 'penjurian kontes',
        ],
        'group_history_controller' => [
            '_' => 'riwayat grup',
        ],
        'groups_controller' => [
            'show' => 'grup',
        ],
        'home_controller' => [
            'get_download' => 'unduh',
            'index' => 'dasbor',
            'search' => 'pencarian',
            'support_the_game' => 'dukung permainan ini',
            'testflight' => 'testflight',
        ],
        'legacy_matches_controller' => [
            '_' => 'pertandingan',
        ],
        'legal_controller' => [
            '_' => 'informasi',
        ],
        'livestreams_controller' => [
            '_' => 'siaran langsung',
        ],
        'news_controller' => [
            '_' => 'berita',
        ],
        'notifications_controller' => [
            '_' => 'riwayat notifikasi',
        ],
        'password_reset_controller' => [
            '_' => 'pengaturan ulang kata sandi',
        ],
        'ranking_controller' => [
            '_' => 'peringkat',
        ],
        'scores_controller' => [
            '_' => 'performa',
        ],
        'seasons_controller' => [
            '_' => 'peringkat',
        ],
        'teams_controller' => [
            '_' => 'tim',
            'create' => 'buat tim',
            'edit' => 'pengaturan tim',
            'leaderboard' => 'papan peringkat tim',
            'show' => 'info tim',
        ],
        'tournaments_controller' => [
            '_' => 'turnamen',
        ],
        'user_cover_presets_controller' => [
            '_' => 'preset sampul pengguna',
        ],
        'user_totp_controller' => [
            '_' => 'aplikasi autentikator',
        ],
        'users_controller' => [
            '_' => 'info pemain',
            'create' => 'buat akun',
            'disabled' => 'pemberitahuan',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            'events' => 'riwayat ruangan',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'otorisir aplikasi',
        ],
    ],
    'store' => [
        '_' => 'toko',
    ],
    'teams' => [
        'members_controller' => [
            'index' => 'anggota tim',
        ],
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'info modder',
        ],
        'multiplayer_controller' => [
            '_' => 'riwayat multiplayer',
        ],
    ],
];
