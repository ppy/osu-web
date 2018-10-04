<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'defaults' => [
        'page_description' => 'osu! - Rhythm is just a *click* away! Dengan berbagai mode permainan seperti Ouendan/EBA, Taiko, serta level editor yang berfungsi.',
    ],

    'menu' => [
        'home' => [
            '_' => 'beranda',
            'account-edit' => 'pengaturan',
            'friends-index' => 'teman',
            'changelog-index' => 'riwayat perubahan',
            'changelog-build' => 'versi',
            'getDownload' => 'unduh',
            'getIcons' => 'ikon',
            'groups-show' => 'grup',
            'index' => 'dasbor',
            'legal-show' => 'informasi',
            'news-index' => 'berita',
            'news-show' => 'berita',
            'password-reset-index' => 'setel ulang kata sandi',
            'search' => 'cari',
            'supportTheGame' => 'dukung permainan ini',
            'team' => 'tim',
        ],
        'help' => [
            '_' => 'bantuan',
            'getFaq' => 'faq',
            'getRules' => 'peraturan',
            'getSupport' => 'beneran, saya butuh bantuan!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'featured artists',
            'beatmap_discussion_posts-index' => 'postingan diskusi beatmap',
            'beatmap_discussions-index' => 'laman diskusi beatmap',
            'beatmapset-watches-index' => 'daftar pengamatan modding',
            'beatmapset_discussion_votes-index' => 'laman diskusi voting beatmap',
            'beatmapset_events-index' => 'laman peristiwa beatmap',
            'index' => 'daftar',
            'packs' => 'paket',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'peringkat',
            'index' => 'performa',
            'performance' => 'performa',
            'charts' => 'spotlights',
            'score' => 'skor',
            'country' => 'negara',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'komunitas',
            'dev' => 'pengembangan',
            'getForum' => 'forum',
            'getChat' => 'obrolan',
            'getLive' => 'siaran langsung',
            'contests' => 'kontes',
            'profile' => 'profil',
            'tournaments' => 'turnamen',
            'tournaments-index' => 'turnamen',
            'tournaments-show' => 'info turnamen',
            'forum-topic-watches-index' => 'langganan',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'pertandingan',
        ],
        'error' => [
            '_' => 'kesalahan',
            '404' => 'hilang',
            '403' => 'dilarang',
            '401' => 'tidak memiliki akses',
            '405' => 'hilang',
            '500' => 'ada yang rusak',
            '503' => 'pemeliharaan',
        ],
        'user' => [
            '_' => 'pengguna',
            'getLogin' => 'masuk',
            'disabled' => 'dinonaktifkan',

            'register' => 'daftar',
            'reset' => 'pulihkan',
            'new' => 'baru',

            'messages' => 'Pesan',
            'settings' => 'Pengaturan',
            'logout' => 'Keluar',
            'help' => 'bantuan',
            'modding-history-discussions' => 'diskusi modding pengguna',
            'modding-history-events' => 'peristiwa modding pengguna',
            'modding-history-index' => 'riwayat modding pengguna',
            'modding-history-posts' => 'postingan modding pengguna',
            'modding-history-votesGiven' => 'suara modding yang diberikan pengguna',
            'modding-history-votesReceived' => 'suara modding yang diterima pengguna',
        ],
        'store' => [
            '_' => 'toko',
            'checkout-show' => 'periksa',
            'getListing' => 'daftar',
            'cart-show' => 'keranjang',

            'getCheckout' => 'periksa',
            'getInvoice' => 'faktur',
            'products-show' => 'produk',

            'new' => 'baru',
            'home' => 'beranda',
            'index' => 'beranda',
            'thanks' => 'terima kasih',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'sampul forum',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'pesanan',
            'orders-show' => 'pesanan',
        ],
        'admin' => [
            '_' => 'admin',
            'beatmapsets-covers' => 'sampul beatmapset',
            'logs-index' => 'log',
            'root' => 'indeks',

            'beatmapsets' => [
                '_' => 'beatmapset',
                'show' => 'rincian',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Umum',
            'home' => 'Beranda',
            'changelog-index' => 'Riwayat Perubahan',
            'beatmaps' => 'Daftar Beatmap',
            'download' => 'Unduh osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Bantuan & Komunitas',
            'faq' => 'Pertanyaan yang Sering Ditanyakan',
            'forum' => 'Forum Komunitas',
            'livestreams' => 'Siaran Langsung',
            'report' => 'Laporkan Masalah',
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
            'email' => 'alamat email',
            'forgot' => "Saya lupa identitas saya",
            'password' => 'kata sandi',
            'title' => 'Masuk untuk Melanjutkan',

            'error' => [
                'email' => "Nama pengguna atau alamat email tidak ada",
                'password' => 'Kata sandi salah',
            ],
        ],

        'register' => [
            'info' => "Anda butuh akun. Mengapa Anda belum memilikinya?",
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
