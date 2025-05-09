<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Putar runut seterusnya secara automatik',
    ],

    'defaults' => [
        'page_description' => 'osu! - Irama tinggal satu *klik* sahaja! Dengan Ouendan/EBA, Taiko dan mod permainan asli serta penyunting tahap berfungsi penuh.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'peta rentak',
            'beatmapset_covers' => 'kulit peta rentak',
            'contest' => 'peraduan',
            'contests' => 'peraduan',
            'root' => 'konsol',
        ],

        'artists' => [
            'index' => 'senarai',
        ],

        'beatmapsets' => [
            'show' => 'maklumat',
            'discussions' => 'perbincangan',
        ],

        'changelog' => [
            'index' => 'senarai',
        ],

        'help' => [
            'index' => 'indeks',
            'sitemap' => 'Peta Laman',
        ],

        'store' => [
            'cart' => 'troli',
            'orders' => 'sejarah pesanan',
            'products' => 'produk',
        ],

        'tournaments' => [
            'index' => 'senarai',
        ],

        'users' => [
            'modding' => 'penyelarasan',
            'playlists' => 'senarai main',
            'realtime' => 'pemain ramai',
            'show' => 'maklumat',
        ],
    ],

    'gallery' => [
        'close' => 'Tutup (Keluar)',
        'fullscreen' => 'Togol layar penuh',
        'zoom' => 'Luru ke dalam/luar',
        'previous' => 'Undur (anak panah kiri)',
        'next' => 'Maju (anak panah kanan)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'peta rentak',
        ],
        'community' => [
            '_' => 'komuniti',
            'dev' => 'pembangunan',
        ],
        'help' => [
            '_' => 'bantuan',
            'getAbuse' => 'lapor penyalahgunaan',
            'getFaq' => 'faq',
            'getRules' => 'peraturan',
            'getSupport' => 'betul, saya perlu bantuan!',
        ],
        'home' => [
            '_' => 'utama',
            'team' => 'pasukan',
        ],
        'rankings' => [
            '_' => 'kedudukan',
        ],
        'store' => [
            '_' => 'kedai',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Umum',
            'home' => 'Utama',
            'changelog-index' => 'Log Perubahan',
            'beatmaps' => 'Senarai Peta Rentak',
            'download' => 'Muat Turun osu!',
        ],
        'help' => [
            '_' => 'Bantuan dan Komuniti',
            'faq' => 'Soalan Lazim',
            'forum' => 'Forum Komuniti',
            'livestreams' => 'Siaran Langsung',
            'report' => 'Laporkan Isu',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Undang-Undang & Status',
            'copyright' => 'Hak Cipta (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Kebersendirian',
            'server_status' => 'Taraf Pelayan',
            'source_code' => 'Kod Sumber',
            'terms' => 'Syarat',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Parameter permintaan tidak sah',
            'description' => '',
        ],
        '404' => [
            'error' => 'Halaman Tiada',
            'description' => "Maaf tetapi halaman permintaan tiada di sini!",
        ],
        '403' => [
            'error' => "Anda sepatutnya tidak berada di sini.",
            'description' => 'Tetapi anda boleh cuba kembali.',
        ],
        '401' => [
            'error' => "Anda sepatutnya tidak berada di sini.",
            'description' => 'Tetapi anda boleh cuba kembali. Kalau tidak pun daftar masuk.',
        ],
        '405' => [
            'error' => 'Halaman Tiada',
            'description' => "Maaf tetapi halaman permintaan tiada di sini!",
        ],
        '422' => [
            'error' => 'Parameter permintaan tidak sah',
            'description' => '',
        ],
        '429' => [
            'error' => 'Kadar melebihi had',
            'description' => '',
        ],
        '500' => [
            'error' => 'Alamak! Ada yang rosak! ;m;',
            'description' => "Kami diberitahu tentang setiap ralat secara automatik.",
        ],
        'fatal' => [
            'error' => 'Alamak! Ada yang rosak (teruk)! ;m;',
            'description' => "Kami diberitahu tentang setiap ralat secara automatik.",
        ],
        '503' => [
            'error' => 'Tergendala bagi penyelenggaraan!',
            'description' => "Penyelenggaraan biasanya mengambil masa antara 5 saat hingga 10 minit. Sekiranya kami tergendala lebih lama, lihat :link untuk maklumat lanjut.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Kalau-kalau berguna, anda boleh berikan kod ini kepada pasukan sokongan!",
    ],

    'popup_login' => [
        'button' => 'daftar (masuk)',

        'login' => [
            'forgot' => "Saya terlupa butiran diri",
            'password' => 'kata laluan',
            'title' => 'Daftar Masuk untuk Teruskan',
            'username' => 'nama pengguna',

            'error' => [
                'email' => "Nama pengguna atau alamat e-mel tidak ada",
                'password' => 'Kata laluan tidak betul',
            ],
        ],

        'register' => [
            'download' => 'Muat Turun',
            'info' => 'Muat turun osu! untuk mencipta akaun anda sendiri!',
            'title' => "Adakah anda tidak mempunyai akaun?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Tetapan',
            'follows' => 'Senarai Ikutan',
            'friends' => 'Kawan',
            'legacy_score_only_toggle' => 'Mod lazer',
            'legacy_score_only_toggle_tooltip' => 'Mod lazer menunjukkan markah yang dicapai dari lazer dengan algoritma baharu',
            'logout' => 'Daftar Keluar',
            'profile' => 'Profilku',
            'scoring_mode_toggle' => 'Pemarkahan klasik',
            'scoring_mode_toggle_tooltip' => 'Laraskan nilai markah untuk rasa pemarkahan klasik tanpa had',
            'team' => 'Pasukanku',
        ],
    ],

    'popup_search' => [
        'initial' => 'Taip untuk mencari!',
        'retry' => 'Carian gagal. Klik untuk cuba lagi.',
    ],
];
