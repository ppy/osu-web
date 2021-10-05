<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Unduh sekarang',
        'online' => '<strong>:players</strong> pemain saat ini terhubung di dalam <strong>:games</strong> ruang permainan',
        'peak' => 'Tercatat maksimal sebanyak :count pengguna online',
        'players' => '<strong>:count</strong> pengguna terdaftar',
        'title' => 'selamat datang',
        'see_more_news' => 'lihat lebih banyak berita',

        'slogan' => [
            'main' => 'game ritme free-to-win terbaik',
            'sub' => 'rhythm is just a click away',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pencarian lanjutan',
        'button' => 'Cari',
        'empty_result' => 'Tidak ditemukan!',
        'keyword_required' => 'Kata kunci pencarian diperlukan',
        'placeholder' => 'ketik untuk mulai mencari',
        'title' => 'Pencarian',

        'beatmapset' => [
            'login_required' => 'Masuk untuk mencari beatmap',
            'more' => ':count hasil pencarian beatmap lainnya',
            'more_simple' => 'Lihat hasil pencarian beatmap lainnya',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Semua forum',
            'link' => 'Cari di forum',
            'login_required' => 'Masuk untuk mencari forum',
            'more_simple' => 'Lihat hasil pencarian forum lainnya',
            'title' => 'Forum',

            'label' => [
                'forum' => 'cari di forum',
                'forum_children' => 'termasuk subforum',
                'topic_id' => 'topik #',
                'username' => 'pemilik',
            ],
        ],

        'mode' => [
            'all' => 'semua',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'pemain',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Masuk untuk mencari pengguna',
            'more' => ':count hasil pencarian pengguna lainnya',
            'more_simple' => 'Lihat hasil pencarian pengguna lainnya',
            'more_hidden' => 'Pencarian pengguna terbatas untuk :max pengguna saja. Perbaiki kata kunci pencarian Anda.',
            'title' => 'Pengguna',
        ],

        'wiki_page' => [
            'link' => 'Cari di wiki',
            'more_simple' => 'Lihat hasil pencarian wiki lainnya',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "mari persiapkan<br>diri Anda!",
        'action' => 'Unduh osu!',

        'help' => [
            '_' => 'apabila Anda menemui suatu masalah di saat Anda hendak memulai permainan atau mendaftarkan akun, harap :help_forum_link atau :support_button.',
            'help_forum_link' => 'kunjungi sub-forum Help',
            'support_button' => 'hubungi layanan dukungan kami',
        ],

        'os' => [
            'windows' => 'untuk Windows',
            'macos' => 'untuk macOS',
            'linux' => 'untuk Linux',
        ],
        'mirror' => 'tautan alternatif',
        'macos-fallback' => 'osu! untuk pengguna macOS',
        'steps' => [
            'register' => [
                'title' => 'buat akun',
                'description' => 'ikuti petunjuk yang muncul di awal permainan untuk masuk atau membuat akun baru',
            ],
            'download' => [
                'title' => 'unduh permainannya',
                'description' => 'klik tombol di atas untuk mengunduh file instalasi, lalu jalankan!',
            ],
            'beatmaps' => [
                'title' => 'dapatkan beatmap',
                'description' => [
                    '_' => ':browse berbagai beatmap buatan pengguna yang tersedia pada katalog beatmap kami yang senantiasa berkembang dan mulailah bermain!',
                    'browse' => 'telusuri',
                ],
            ],
        ],
        'video-guide' => 'panduan video',
    ],

    'user' => [
        'title' => 'dasbor',
        'news' => [
            'title' => 'Berita',
            'error' => 'Terdapat kesalahan dalam memuat berita. Coba untuk memuat ulang laman?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Teman yang Online',
                'games' => 'Permainan',
                'online' => 'Pemain yang Online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Beatmap Ranked Terbaru',
            'popular' => 'Beatmap Populer',
            'by_user' => 'oleh :user',
        ],
        'buttons' => [
            'download' => 'Unduh osu!',
            'support' => 'Dukung osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Anda tampaknya sedang bersenang-senang! :D',
        'body' => [
            'part-1' => 'Tahukah Anda bahwa osu! beroperasi tanpa iklan, di mana biaya pengembangan dan operasionalnya bergantung sepenuhnya pada donasi sukarela dari para penggunanya?',
            'part-2' => 'Apakah Anda juga tahu bahwa dengan mendukung osu! Anda juga akan mendapatkan berbagai fitur eksklusif seperti <strong>pengunduh beatmap otomatis di dalam aplikasi osu!</strong> yang akan secara otomatis mengunduh beatmap yang Anda belum miliki di saat sedang menonton pemain lain dan di dalam pertandingan multiplayer?',
        ],
        'find-out-more' => 'Klik di sini untuk mengetahui lebih lanjut!',
        'download-starting' => "Oh, dan jangan khawatir - unduhan Anda sudah dimulai ;)",
    ],
];
