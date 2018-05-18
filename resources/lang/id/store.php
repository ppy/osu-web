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
    'admin' => [
        'warehouse' => 'Gudang',
    ],

    'checkout' => [
        'cart_problems' => 'Aduh, ada masalah dengan keranjang Anda!',
        'cart_problems_edit' => 'Klik di sini untuk menyuntingnya.',
        'declined' => 'Pembayaran dibatalkan.',
        'error' => 'Terjadi masalah saat menyelesaikan pembayaran :(',
        'old_cart' => 'Keranjang Anda nampaknya sudah kedaluwarsa dan telah dimuat ulang, silakan coba lagi.',
        'pay' => 'Bayar via Paypal',
        'pending_checkout' => [
            'line_1' => 'Anda belum menuntaskan pembayaran sebelumnya.',
            'line_2' => 'Lanjutkan pembayaran Anda dengan memilih metode pembayaran, atau :link untuk membatalkan.',
            'link_text' => 'klik di sini',
        ],
        'delayed_shipping' => 'Kami saat ini sedang kebajiran pesanan! Anda dipersilakan untuk melakukan pemesanan, namun apabila Anda memesan sekarang Anda diharapkan untuk memberikan waktu **selama 1-2 minggu** tambahan bagi kami untuk dapat mulai memproses pesanan Anda selagi kami mengurus pesanan-pesanan yang sudah ada sebelumnya.',
    ],

    'discount' => 'hemat :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Kami menerima pesanan osu!store Anda!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name untuk :username (:duration)',
            ],
            'quantity' => 'Jumlah',
        ],
    ],

    'product' => [
        'name' => 'Nama',

        'stock' => [
            'out' => 'Barang saat ini kehabisan stok. Periksa kembali nanti!',
            'out_with_alternative' => 'Sayangnya barang ini kehabisan stok. Gunakan dropdown untuk memilih jenis yang lain atau periksa kembali nanti!',
        ],

        'add_to_cart' => 'Tambahkan ke Keranjang',
        'notify' => 'Beri tahu saya bila tersedia!',

        'notification_success' => 'Anda akan diberitahu saat kami punya stok baru. klik :link untuk membatalkan',
        'notification_remove_text' => 'di sini',

        'notification_in_stock' => 'Produk ini telah tersedia!',
    ],

    'supporter_tag' => [
        'gift' => 'hadiahkan ke pengguna lain',
        'require_login' => [
            '_' => 'Anda harus :link untuk mendapatkan supporter tag!',
            'link_text' => 'masuk',
        ],
    ],

    'username_change' => [
        'check' => 'Masukkan nama pengguna untuk memeriksa ketersediaan!',
        'checking' => 'Memeriksa ketersediaan :username...',
        'require_login' => [
            '_' => 'Anda harus :link untuk mengubah nama Anda!',
            'link_text' => 'masuk',
        ],
    ],
];
