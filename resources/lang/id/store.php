<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Checkout',
        'info' => ':count_delimited barang dalam keranjang ($:subtotal)|:count_delimited barang dalam keranjang ($:subtotal)',
        'more_goodies' => 'Saya ingin melihat produk lainnya sebelum merampungkan pesanan',
        'shipping_fees' => 'biaya pengiriman',
        'title' => 'Keranjang Belanja',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Uh-oh, terdapat masalah dengan keranjangmu yang menghalangi proses checkout!',
            'line_2' => 'Hapus atau perbarui item-item di atas untuk melanjutkan.',
        ],

        'empty' => [
            'text' => 'Keranjangmu masih kosong.',
            'return_link' => [
                '_' => 'Kembali ke tautan :link untuk mencari merchandise!',
                'link_text' => 'etalase toko',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, terdapat masalah dengan keranjangmu!',
        'cart_problems_edit' => 'Klik di sini untuk menyuntingnya.',
        'declined' => 'Pembayaran dibatalkan.',
        'delayed_shipping' => 'Kami sedang kebanjiran pesanan! Apabila kamu memesan sekarang, harap beri kami waktu tambahan **selama 1-2 minggu** untuk memproses pesananmu karena kami saat ini masih harus mengurus pesanan yang telah kami terima sebelumnya.',
        'hide_from_activity' => 'Sembunyikan seluruh tag osu!supporter pada pesanan ini dari aktivitas saya',
        'old_cart' => 'Keranjangmu sepertinya telah kedaluwarsa dan telah dimuat ulang. Silakan coba lagi.',
        'pay' => 'Checkout melalui Paypal',
        'title_compact' => 'checkout',

        'has_pending' => [
            '_' => 'Kamu memiliki transaksi yang belum tuntas. Klik :link untuk melihatnya.',
            'link_text' => 'di sini',
        ],

        'pending_checkout' => [
            'line_1' => 'Transaksi sebelumnya belum dituntaskan.',
            'line_2' => 'Lanjutkan pembayaranmu dengan memilih metode pembayaran.',
        ],
    ],

    'discount' => 'hemat :percent%',

    'invoice' => [
        'echeck_delay' => 'Berhubung pembayaranmu berupa eCheck, mohon tunggu hingga setidaknya 10 hari agar pembayaranmu dapat diproses oleh PayPal!',
        'hide_from_activity' => 'Tag osu!supporter yang dipesan melalui pesanan ini tidak akan ditampilkan pada riwayat aktivitas terkini milikmu.',
        'title_compact' => 'faktur',

        'status' => [
            'processing' => [
                'title' => 'Pembayaranmu belum terkonfirmasi!',
                'line_1' => 'Apabila kamu telah membayar sebelumnya, ada kemungkinan sistem kami masih memproses dan mengonfirmasi pembayaranmu. Silakan muat ulang halaman ini dalam beberapa menit!',
                'line_2' => [
                    '_' => 'Apabila kamu mengalami masalah dalam proses checkout, :link',
                    'link_text' => 'klik di sini untuk melanjutkan transaksimu',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Batalkan Pesanan',
        'cancel_confirm' => 'Pesanan ini akan dibatalkan dan segala biaya yang telah kamu keluarkan tidak akan kami terima. Apakah kamu yakin?',
        'cancel_not_allowed' => 'Pesanan ini tidak dapat dibatalkan pada saat ini.',
        'invoice' => 'Lihat Faktur',
        'no_orders' => 'Tidak ada pesanan yang tercatat.',
        'paid_on' => 'Pemesanan dilangsungkan pada :date',
        'resume' => 'Lanjutkan Proses Checkout',
        'shopify_expired' => 'Tautan checkout untuk pesanan ini telah kadaluarsa.',

        'item' => [
            'quantity' => 'Jumlah',

            'display_name' => [
                'supporter_tag' => ':name untuk :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Pesan: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Kamu tidak dapat menyunting pesanan yang telah dibatalkan.',
            'checkout' => 'Kamu tidak dapat menyunting pesanan yang sedang diproses.', // checkout and processing should have the same message.
            'default' => 'Pesanan tidak dapat diubah',
            'delivered' => 'Kamu tidak dapat menyunting pesanan yang telah dikirim.',
            'paid' => 'Kamu tidak dapat menyunting pesanan yang telah dibayar.',
            'processing' => 'Kamu tidak dapat menyunting pesanan yang sedang diproses.',
            'shipped' => 'Kamu tidak dapat menyunting pesanan yang telah dikirim.',
        ],

        'status' => [
            'cancelled' => 'Dibatalkan',
            'checkout' => 'Pesanan Diproses',
            'delivered' => 'Terkirim',
            'paid' => 'Lunas',
            'processing' => 'Menunggu konfirmasi',
            'shipped' => 'Terkirim',
        ],
    ],

    'product' => [
        'name' => 'Nama',

        'stock' => [
            'out' => 'Stok barang saat ini sedang tidak tersedia. Silakan periksa kembali nanti!',
            'out_with_alternative' => 'Sayangnya stok untuk barang ini habis. Gunakan menu dropdown untuk memilih jenis yang lain atau silahkan periksa kembali nanti!',
        ],

        'add_to_cart' => 'Tambahkan ke Keranjang',
        'notify' => 'Beri tahu saya bila telah tersedia!',

        'notification_success' => 'kamu akan diberitahukan pada saat kami memiliki stok baru. klik :link untuk membatalkan',
        'notification_remove_text' => 'di sini',

        'notification_in_stock' => 'Produk ini telah tersedia!',
    ],

    'supporter_tag' => [
        'gift' => 'hadiahkan ke pengguna lain',
        'gift_message' => 'tambahkan pesan untuk melengkapi hadiahmu! (maksimal :length karakter)',

        'require_login' => [
            '_' => 'Kamu harus :link untuk menerima tag osu!supporter!',
            'link_text' => 'masuk',
        ],
    ],

    'username_change' => [
        'check' => 'Masukkan nama pengguna untuk memeriksa ketersediaannya!',
        'checking' => 'Memeriksa ketersediaan :username...',
        'require_login' => [
            '_' => 'Anda harus :link untuk mengubah nama Anda!',
            'link_text' => 'masuk',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
