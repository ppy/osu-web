<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'support' => [
        'convinced' => [
            'title' => 'Saya yakin! :D',
            'support' => 'dukung osu!',
            'gift' => 'atau hadiahkan supporter tag kepada pemain lain',
            'instructions' => 'klik tombol hati untuk melanjutkan ke osu!store',
        ],
        'why-support' => [
            'title' => 'Kenapa saya harus mendukung osu!? Kemana uangnya akan pergi?',

            'team' => [
                'title' => 'Dukung Tim kami',
                'description' => 'Sebuah tim kecil mengembangkan dan menjalankan layanan osu!. Dukunganmu akan membantu... kehidupan mereka.',
            ],
            'infra' => [
                'title' => 'Prasarana Server',
                'description' => 'Kontribusi langsung digunakan untuk kebutuhan server dalam menjalankan situs web, layanan multiplayer, papan peringkat online, dan lainnya.',
            ],
            'featured-artists' => [
                'title' => 'Artis Unggulan',
                'description' => 'Dengan dukunganmu, kami dapat mencari artis - artis berbakat lainnya dan melisensi musiknya untuk digunakan di osu!',
                'link_text' => 'Lihat daftar saat ini &raquo;',
            ],
            'ads' => [
                'title' => 'Bantu osu! untuk tetap berjalan sendiri',
                'description' => 'Kontribusi kamu menjaga game ini berjalan independen dan bebas dari iklan maupun sponsor dari luar sepenuhnya.',
            ],
            'tournaments' => [
                'title' => 'Turnamen Resmi',
                'description' => 'Bantu mendanai untuk menjalankan (dan menambah hadiah) yang diberikan di turnamen osu! World Cup.',
                'link_text' => 'Jelajahi turnamen &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Program Open Source Bounty',
                'description' => 'Dukung community contributors yang telah menyisihkan waktu dan upaya mereka untuk membantu membuat osu! lebih baik.',
                'link_text' => 'Temukan lebih banyak lagi &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Oh? Apa saja yang akan saya dapatkan?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'akses cepat dan mudah untuk mencari beatmap tanpa meninggalkan permainan.',
            ],

            'friend_ranking' => [
                'title' => 'Peringkat Teman',
                'description' => "Lihat bagaimana kemampuanmu dibandingkan dengan teman-temanmu di papan peringkat beatmap, baik dalam game maupun di situs web.",
            ],

            'country_ranking' => [
                'title' => 'Peringkat Negara',
                'description' => 'Taklukkan negaramu sebelum kamu menaklukkan dunia.',
            ],

            'mod_filtering' => [
                'title' => 'Filter berdasarkan Mod',
                'description' => 'Ingin mencari orang yang memainkannya dengan HDHR? Tidak masalah!',
            ],

            'auto_downloads' => [
                'title' => 'Unduh Otomatis',
                'description' => 'Unduhan otomatis saat bermain multiplayer, menonton orang lain, atau mengklik tautan dalam obrolan!.',
            ],

            'upload_more' => [
                'title' => 'Unggah Lebih Banyak',
                'description' => 'Slot tambahan untuk mengunggah beatmap yang berstatus Pending (satu slot tambahan per beatmap Ranked yang Anda miliki, hingga maksimum 10 beatmap Pending)',
            ],

            'early_access' => [
                'title' => 'Akses Pra-Rilis',
                'description' => 'Akses ke rilisan terbaru lebih awal, di mana Anda dapat mencoba fitur yang bahkan belum dirilis secara publik!',
            ],

            'customisation' => [
                'title' => 'Kustomisasi',
                'description' => "Kustomisasi profil Anda dengan menambahkan laman pengguna yang dapat Anda hias sepenuhnya.",
            ],

            'beatmap_filters' => [
                'title' => 'Filter Beatmap',
                'description' => 'Filter pencarian beatmap berdasarkan map yang belum dan sudah dimainkan juga peringkat yang dicapai (jika ada).',
            ],

            'yellow_fellow' => [
                'title' => 'Pesona Kemuning',
                'description' => 'Buat dirimu lebih tersorot dengan nama pengguna yang berwarna kuning terang di obrolan.',
            ],

            'speedy_downloads' => [
                'title' => 'Unduh Lebih Cepat',
                'description' => 'Pembatasan pengunduhan yang lebih toleran, terutama saat menggunakan osu!direct.',
            ],

            'change_username' => [
                'title' => 'Perubahan Nama Pengguna',
                'description' => 'Kemampuan untuk mengubah nama pengguna Anda tanpa biaya tambahan (maksimum sekali).',
            ],

            'skinnables' => [
                'title' => 'Elemen Skinning',
                'description' => 'Tambahan elemen skin yang bisa Anda kustomisasi, seperti latar belakang menu utama.',
            ],

            'feature_votes' => [
                'title' => 'Hak Suara Ekstra',
                'description' => 'Hak suara tambahan bagi Anda pada forum Feature Requests (2 suara per bulan).',
            ],

            'sort_options' => [
                'title' => 'Opsi Untuk Menyortir',
                'description' => 'Akses untuk melihat peringkat beatmap berdasarkan negara/teman/mod secara spesifik dalam game.',
            ],

            'more_favourites' => [
                'title' => 'Lebih Banyak Favorit',
                'description' => 'Jumlah maksimum beatmap yang dapat kamu favorit bertambah dari :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Lebih Banyak Teman',
                'description' => 'Jumlah maksimum teman yang dapat kamu miliki bertambah dari :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Unggah Lebih Banyak Beatmap',
                'description' => 'Berapa banyak beatmap non-ranked yang dapat kamu miliki dihitung dari nilai dasar ditambah bonus tambahan untuk tiap beatmap ranked yang kamu miliki saat ini (hingga batas).<br/><br/> Biasanya jumlahnya adalah 4 ditambah 1 per beatmap ranked (hingga 2). Dengan supporter, jumlah ini meningkat menjadi 8 ditambah 1 per beatmap ranked (hingga 12).',
            ],
            'friend_filtering' => [
                'title' => 'Papan Peringkat Teman',
                'description' => 'Bersainglah dengan teman-temanmu dan lihat bagaimana kamu dapat melawan dengan menunjukkan peringkatmu pada mereka!*<br/><br/><small>* fitur ini belum tersedia di situs baru, segera tersedia (tm) </small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Terima kasih atas dukungan Anda! Anda telah membeli supporter tag sebanyak :tags kali dengan total kontribusi sebesar :dollars!',
            'gifted' => ":giftedTags dari pembelian tag Anda telah dihadiahkan (dengan total sebesar :giftedDollars telah dihadiahkan). Terima kasih atas kemurahan hati Anda!",
            'not_yet' => "Anda belum pernah memiliki supporter tag :(",
            'valid_until' => 'Supporter Tag Anda saat ini berlaku hingga :date!',
            'was_valid_until' => 'Supporter Tag Anda berlaku hingga :date.',
        ],
    ],
];
