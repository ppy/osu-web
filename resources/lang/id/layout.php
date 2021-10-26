<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Putar lagu berikutnya secara otomatis',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rhythm is just a *click* away! Dengan berbagai mode permainan seperti Ouendan/EBA, Taiko, serta level editor yang sepenuhnya fungsional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'set beatmap',
            'beatmapset_covers' => 'sampul beatmap',
            'contest' => 'kontes',
            'contests' => 'kontes',
            'root' => 'konsol',
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
            'multiplayer' => 'multiplayer',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Tutup (Esc)',
        'fullscreen' => 'Beralih ke layar penuh',
        'zoom' => 'Perbesar/perkecil tampilan',
        'previous' => 'Sebelumnya (tombol panah kiri)',
        'next' => 'Selanjutnya (tombol panah kanan)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmap',
        ],
        'community' => [
            '_' => 'komunitas',
            'dev' => 'pengembangan',
        ],
        'help' => [
            '_' => 'bantuan',
            'getAbuse' => 'laporkan penyalahgunaan',
            'getFaq' => 'faq',
            'getRules' => 'peraturan',
            'getSupport' => 'beneran, saya butuh bantuan!',
        ],
        'home' => [
            '_' => 'beranda',
            'team' => 'tim',
        ],
        'rankings' => [
            '_' => 'peringkat',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'toko',
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
            'faq' => 'Pertanyaan yang Umum Diajukan (FAQ)',
            'forum' => 'Forum Komunitas',
            'livestreams' => 'Siaran Langsung',
            'report' => 'Laporkan Masalah',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Hukum & Status',
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
            'error' => 'Laman Tidak Ditemukan',
            'description' => "Maaf, tapi laman yang Anda minta tidak ada di sini!",
        ],
        '403' => [
            'error' => "Anda seharusnya tidak di sini.",
            'description' => 'Anda dapat mencoba untuk kembali ke halaman sebelumnya.',
        ],
        '401' => [
            'error' => "Anda seharusnya tidak di sini.",
            'description' => 'Anda dapat mencoba untuk kembali ke halaman sebelumnya. Atau mungkin coba untuk masuk terlebih dahulu.',
        ],
        '405' => [
            'error' => 'Laman Tidak Ditemukan',
            'description' => "Maaf, tapi laman yang Anda minta tidak ada di sini!",
        ],
        '422' => [
            'error' => 'Parameter yang diminta tidak valid',
            'description' => '',
        ],
        '429' => [
            'error' => 'Batas permintaan terlampaui',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh, tidak! Sepertinya ada sesuatu yang rusak! ;_;',
            'description' => "Sistem osu! akan secara otomatis memberitahukan kami setiap kali terdapat kesalahan seperti ini.",
        ],
        'fatal' => [
            'error' => 'Oh, tidak! Sepertinya ada sesuatu yang (sangat) rusak! ;_;',
            'description' => "Sistem osu! akan secara otomatis memberitahukan kami setiap kali terdapat kesalahan seperti ini.",
        ],
        '503' => [
            'error' => 'Sedang dalam pemeliharaan!',
            'description' => "Proses pemeliharaan utamanya dapat berlangsung dalam durasi yang cukup beragam, mulai dari 5 detik hingga lebih dari 10 menit. Jika proses pemeliharaan ternyata berlangsung lebih lama dari yang sewajarnya, harap kunjungi :link untuk informasi lebih lanjut.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Untuk berjaga-jaga, berikut kode yang dapat Anda berikan kepada layanan dukungan kami!",
    ],

    'popup_login' => [
        'button' => 'masuk / daftar',

        'login' => [
            'forgot' => "Saya lupa identitas saya",
            'password' => 'kata sandi',
            'title' => 'Masuk untuk Melanjutkan',
            'username' => 'nama pengguna',

            'error' => [
                'email' => "Nama pengguna atau alamat email tidak ditemukan",
                'password' => 'Kata sandi salah',
            ],
        ],

        'register' => [
            'download' => 'Unduh',
            'info' => 'Unduh osu! untuk membuat akun Anda!',
            'title' => "Belum memiliki akun?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Pengaturan',
            'follows' => 'Daftar Pantauan',
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
