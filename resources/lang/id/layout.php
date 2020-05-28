<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rhythm is just a *click* away! Dengan berbagai mode permainan seperti Ouendan/EBA, Taiko, serta level editor yang berfungsi.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'set beatmap',
            'beatmapset_covers' => 'sampul beatmap',
            'contest' => 'kontes',
            'contests' => 'kontes',
            'root' => 'konsol',
            'store_orders' => 'pengelola toko',
        ],

        'artists' => [
            'index' => 'daftar',
        ],

        'changelog' => [
            'index' => 'daftar',
        ],

        'help' => [
            'index' => 'indeks',
            'sitemap' => 'Peta Situs',
        ],

        'store' => [
            'cart' => 'keranjang',
            'orders' => 'riwayat transaksi',
            'products' => 'produk',
        ],

        'tournaments' => [
            'index' => 'daftar',
        ],

        'users' => [
            'modding' => 'modding',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Tutup (Esc)',
        'fullscreen' => 'Beralih ke layar penuh',
        'zoom' => 'Perbesar/perkecil tampilan',
        'previous' => 'Sebelumnya (arrow left)',
        'next' => 'Selanjutnya (arrow right)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmap',
            'artists' => 'featured artist',
            'index' => 'daftar',
            'packs' => 'paket',
        ],
        'community' => [
            '_' => 'komunitas',
            'chat' => 'chat',
            'contests' => 'kontes',
            'dev' => 'pengembangan',
            'forum-forums-index' => 'forum',
            'getLive' => 'siaran langsung',
            'tournaments' => 'turnamen',
        ],
        'help' => [
            '_' => 'bantuan',
            'getFaq' => 'faq',
            'getRules' => 'peraturan',
            'getSupport' => 'beneran, saya butuh bantuan!',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'beranda',
            'changelog-index' => 'riwayat perubahan',
            'getDownload' => 'unduh',
            'news-index' => 'berita',
            'search' => 'cari',
            'team' => 'tim',
        ],
        'rankings' => [
            '_' => 'peringkat',
            'charts' => 'spotlights',
            'country' => 'negara',
            'index' => 'performa',
            'kudosu' => 'kudosu',
            'score' => 'skor',
        ],
        'store' => [
            '_' => 'toko',
            'cart-show' => 'keranjang',
            'getListing' => 'daftar',
            'orders-index' => 'riwayat transaksi',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Umum',
            'home' => 'Beranda',
            'changelog-index' => 'Riwayat Perubahan',
            'beatmaps' => 'Daftar Beatmap',
            'download' => 'Unduh osu!',
        ],
        'help' => [
            '_' => 'Bantuan & Komunitas',
            'faq' => 'Pertanyaan yang Sering Ditanyakan',
            'forum' => 'Forum Komunitas',
            'livestreams' => 'Siaran Langsung',
            'report' => 'Laporkan Masalah',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Status Resmi',
            'copyright' => 'Hak Cipta (DMCA)',
            'privacy' => 'Privasi',
            'server_status' => 'Status Server',
            'source_code' => 'Kode Sumber',
            'terms' => 'Ketentuan Layanan',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Parameter yang diminta tidak valid',
            'description' => '',
        ],
        '404' => [
            'error' => 'Laman Hilang',
            'description' => "Maaf, tapi laman yang Anda minta tidak ada di sini!",
        ],
        '403' => [
            'error' => "Anda seharusnya tidak di sini.",
            'description' => 'Anda dapat mencoba kembali. Atau mungkin coba masuk.',
        ],
        '401' => [
            'error' => "Anda seharusnya tidak di sini.",
            'description' => 'Anda dapat mencoba kembali. Atau mungkin coba masuk.',
        ],
        '405' => [
            'error' => 'Halaman Hilang',
            'description' => "Maaf, tapi laman yang Anda minta tidak ada di sini!",
        ],
        '422' => [
            'error' => 'Parameter yang diminta tidak valid',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh tidak! Ada yang rusak (buruk)! ;_;',
            'description' => "Kami diberitahu secara otomatis setiap ada kesalahan.",
        ],
        'fatal' => [
            'error' => 'Oh tidak! Ada yang rusak (buruk)! ;_;',
            'description' => "Kami diberitahu secara otomatis setiap ada kesalahan.",
        ],
        '503' => [
            'error' => 'Sedang dalam pemeliharaan!',
            'description' => "Proses pemeliharaan (maintenance) biasanya berlangsung selama 5 detik hingga 10 menit. Jika proses pemeliharaan ternyata berlangsung lebih lama dari yang diharapkan, kunjungi :link untuk informasi lebih lanjut.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Untuk jaga-jaga, ini kode yang dapat Anda berikan saat menghubungi layanan dukungan!",
    ],

    'popup_login' => [
        'login' => [
            'forgot' => "Saya lupa identitas saya",
            'password' => 'kata sandi',
            'title' => 'Masuk untuk Melanjutkan',
            'username' => 'nama pengguna',

            'error' => [
                'email' => "Nama pengguna atau alamat email tidak ada",
                'password' => 'Kata sandi salah',
            ],
        ],

        'register' => [
            'download' => 'Unduh',
            'info' => 'Anda butuh akun. Mengapa Anda belum memilikinya?',
            'title' => "Belum memiliki akun?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Pengaturan',
            'friends' => 'Teman',
            'logout' => 'Keluar',
            'profile' => 'Profil Saya',
        ],
    ],

    'popup_search' => [
        'initial' => 'Ketik untuk mencari!',
        'retry' => 'Pencarian gagal. Klik untuk mencoba lagi.',
    ],
];
