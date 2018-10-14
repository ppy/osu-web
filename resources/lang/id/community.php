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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Suka osu!?<br/>                                Dukung pengembangannya! :D',
            'small_description' => '',
            'support_button' => 'Saya ingin mendukung osu!',
        ],

        'dev_quote' => 'osu! merupakan permainan yang benar-benar bersifat gratis untuk dimainkan (free-to-play), namun aspek-aspek operasional untuk game ini tentunya membutuhkan biaya tersendiri. Dengan menimbang berbagai hal seperti penyewaan server berskala internasional yang memiliki bandwidth berkualitas tinggi, pengupayaan pemeliharaan sistem dan komunitas, penyediaan hadiah untuk berbagai kompetisi, pemberian layanan dukungan, dan membahagiakan para pemain secara umum, pengoperasian osu! membutuhkan biaya yang sama sekali tidak sedikit! Ketahuilah bahwa kami melakukan ini semua tanpa menyisipkan iklan apapun ataupun bermitra dengan penyedia perangkat lunak manapun yang tidak jelas, sama sekali!
            <br/><br/>Pada akhirnya, sebagian besar dari osu! dijalankan oleh saya sendiri, yang lebih akrab dikenal sebagai \'peppy\'.
            Saya harus keluar dari pekerjaan tetap saya agar dapat terus mengembangkan osu!,
            dan di samping itu terkadang saya juga harus harus bersusah payah demi mempertahankan standar kualitas yang telah saya tetapkan.
            Saya ingin mengucapkan terima kasih secara pribadi kepada mereka yang telah mendukung osu! sampai saat ini,
            dan juga bagi mereka yang terus mendukung permainan yang luar biasa ini beserta komunitas-komunitasnya sampai ke masa yang akan datang :).',

        'supporter_status' => [
            'contribution' => 'Terima kasih atas dukungan Anda! Anda telah membeli supporter tag sebanyak :tags kali dengan total kontribusi sebesar :dollars!',
            'gifted' => ':giftedTags dari pembelian tag Anda telah dihadiahkan (dengan total sebesar :giftedDollars telah dihadiahkan). Terima kasih atas kemurahan hati Anda!',
            'not_yet' => "Anda belum pernah memiliki supporter tag :(",
            'title' => 'Status supporter saat ini',
            'valid_until' => 'Supporter Tag Anda saat ini berlaku hingga :date!',
            'was_valid_until' => 'Supporter Tag Anda berlaku hingga :date.',
        ],

        'why_support' => [
            'title' => 'Mengapa saya harus mendukung osu!?',
            'blocks' => [
                'dev' => 'Senantiasa dipelihara dan dikembangkan oleh satu orang di Australia',
                'time' => 'Memerlukan begitu banyak waktu untuk menjalankannya sehingga tidak mungkin lagi menyebutnya sebagai \'hobi\'.',
                'ads' => 'Tidak ada iklan di mana pun. <br/><br/>
                Tidak seperti 99,95% situs web lainnya, kami tidak berorientasi pada keuntungan atau mengiklankan tawaran barang-barang secara semena-mena di depan layar monitor Anda.',
                'goodies' => 'Anda akan mendapatkan beberapa fitur tambahan!',
            ],
        ],

        'perks' => [
            'title' => 'Oh? Apa saja yang akan saya dapatkan?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'akses cepat dan mudah untuk mencari beatmap tanpa meninggalkan permainan.',
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
                'description' => 'Kustomisasi profil Anda dengan menambahkan laman pengguna yang dapat Anda hias sepenuhnya.',
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

            'feel_special' => [
                'title' => 'Merasa Spesial',
                'description' => 'Perasaan hangat karena Anda telah melakukan bagian Anda untuk memastikan osu! berjalan lancar!',
            ],

            'more_to_come' => [
                'title' => 'Masih banyak lagi',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Saya yakin! :D',
            'support' => 'dukung osu!',
            'gift' => 'atau hadiahkan supporter tag kepada pemain lain',
            'instructions' => 'klik tombol hati untuk melanjutkan ke osu!store',
        ],
    ],
];
