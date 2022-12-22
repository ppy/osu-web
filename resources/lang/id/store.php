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
            'line_1' => 'Uh-oh, terdapat masalah dengan keranjang Anda yang menghalangi kami untuk dapat memproses pemesanan lebih lanjut!',
            'line_2' => 'Hapus atau perbarui item-item di atas untuk melanjutkan.',
        ],

        'empty' => [
            'text' => 'Keranjang anda masih kosong.',
            'return_link' => [
                '_' => 'Kembali ke tautan :link untuk mencari merchandise!',
                'link_text' => 'etalase toko',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Aduh, ada masalah dengan pemesanan anda!',
        'cart_problems_edit' => 'Klik di sini untuk menyuntingnya.',
        'declined' => 'Pembayaran dibatalkan.',
        'delayed_shipping' => 'Kami sedang kebanjiran pesanan! Apabila Anda memesan sekarang, harap beri kami waktu tambahan **selama 1-2 minggu** untuk memproses pesanan Anda karena kami saat ini masih harus mengurus berbagai pesanan yang telah kami terima sebelumnya.',
        'hide_from_activity' => '',
        'old_cart' => 'Keranjang Anda nampaknya sudah kedaluwarsa dan telah dimuat ulang, silakan coba lagi.',
        'pay' => 'Checkout melalui Paypal',
        'title_compact' => 'checkout',

        'has_pending' => [
            '_' => 'Anda memiliki transaksi yang belum tuntas, klik :link untuk melihatnya.',
            'link_text' => 'di sini',
        ],

        'pending_checkout' => [
            'line_1' => 'Anda belum menuntaskan pembayaran sebelumnya.',
            'line_2' => 'Lanjutkan pembayaran Anda dengan memilih metode pembayaran.',
        ],
    ],

    'discount' => 'hemat :percent%',

    'invoice' => [
        'echeck_delay' => 'Berhubung pembayaran Anda berupa eCheck, mohon tunggu hingga setidaknya 10 hari agar pembayaran Anda dapat diproses oleh PayPal!',
        'hide_from_activity' => '',
        'title_compact' => 'faktur',

        'status' => [
            'processing' => [
                'title' => 'Pembayaran Anda belum terkonfirmasi!',
                'line_1' => 'Apabila Anda sebelumnya benar-benar telah membayar sesuai dengan jumlah yang tertagih, ada kemungkinan sistem kami masih memproses dan mengonfirmasi pembayaran Anda tersebut. Mohon tunggu beberapa menit dan muat ulang halaman ini!',
                'line_2' => [
                    '_' => 'Apabila Anda mengalami masalah dalam proses checkout, :link',
                    'link_text' => 'klik di sini untuk melanjutkan transaksi Anda',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Batalkan Pesanan',
        'cancel_confirm' => 'Pesanan ini akan secara otomatis dibatalkan dan segala biaya yang telah Anda keluarkan tidak akan kami terima. Apakah Anda yakin?',
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
                'supporter_tag' => '',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Anda tidak dapat menyunting pesanan yang telah dibatalkan.',
            'checkout' => 'Anda tidak dapat menyunting pesanan yang sedang diproses.', // checkout and processing should have the same message.
            'default' => 'Pesanan tidak dapat diubah',
            'delivered' => 'Anda tidak dapat menyunting pesanan yang telah dikirim.',
            'paid' => 'Anda tidak dapat menyunting pesanan yang telah dibayar.',
            'processing' => 'Anda tidak dapat menyunting pesanan yang sedang diproses.',
            'shipped' => 'Anda tidak dapat menyunting pesanan yang telah dikirim.',
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

        'notification_success' => 'Anda akan diberitahu saat kami punya stok baru. klik :link untuk membatalkan',
        'notification_remove_text' => 'di sini',

        'notification_in_stock' => 'Produk ini telah tersedia!',
    ],

    'supporter_tag' => [
        'gift' => 'hadiahkan ke pengguna lain',
        'gift_message' => '',

        'require_login' => [
            '_' => 'Anda harus :link untuk dapat menerima osu!supporter tag!',
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
