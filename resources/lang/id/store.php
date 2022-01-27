<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Checkout',
        'info' => ':count_delimited barang dalam keranjang ($:subtotal)|:count_delimited barang dalam keranjang ($:subtotal)',
        'more_goodies' => 'Saya ingin melihat produk-produk lainnya sebelum merampungkan pesanan',
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
        'delayed_shipping' => 'Kami saat ini sedang kebanjiran pesanan! Apabila Anda memesan sekarang, harap beri kami tenggat waktu tambahan **selama 1-2 minggu** untuk dapat mulai memproses pesanan Anda mengingat kami masih harus mengurus pesanan-pesanan yang sudah terlebih dahulu masuk sebelumnya.',
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
        'echeck_delay' => 'Karena Anda melakukan pembayaran via eCheck, mohon izinkan setidaknya 10 hari tambahan untuk masuk melalui PayPal!',
        'title_compact' => 'invoice',

        'status' => [
            'processing' => [
                'title' => 'Pembayaran Anda belum terkonfirmasi!',
                'line_1' => 'Apabila Anda sebelumnya benar-benar telah membayar sesuai dengan jumlah yang tertagih, ada kemungkinan sistem kami masih memproses dan mengonfirmasi pembayaran Anda tersebut. Mohon tunggu beberapa menit dan muat ulang halaman ini!',
                'line_2' => [
                    '_' => 'Jika Anda mengalami masalah saat melakukan pembayaran, :link',
                    'link_text' => 'klik di sini untuk melanjutkan transaksi Anda',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Batalkan Pesanan',
        'cancel_confirm' => 'Pesanan ini akan secara otomatis dibatalkan dan segala biaya yang telah Anda keluarkan tidak akan kami terima. Apakah Anda yakin?',
        'cancel_not_allowed' => 'Pesanan ini tidak dapat dibatalkan pada saat ini.',
        'invoice' => 'Lihat Invoice',
        'no_orders' => 'Tidak ada pesanan yang tercatat.',
        'paid_on' => 'Pemesanan dilangsungkan pada :date',
        'resume' => 'Lanjutkan Proses Checkout',
        'shopify_expired' => 'Tautan checkout untuk pesanan ini telah kadaluarsa.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name untuk :username (:duration)',
            ],
            'quantity' => 'Jumlah',
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
            'out' => 'Stok barang ini saat ini sedang tidak tersedia. Silahkan periksa kembali nanti!',
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
        'require_login' => [
            '_' => 'Anda harus :link untuk menerima osu!supporter tag!',
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
