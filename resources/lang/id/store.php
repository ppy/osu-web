<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Checkout',
        'empty_cart' => 'Hapus semua item dari keranjang',
        'info' => ':count_delimited item dalam keranjang ($:subtotal)|:count_delimited item dalam keranjang ($:subtotal)',
        'more_goodies' => 'Saya ingin melihat produk lainnya sebelum merampungkan pesanan',
        'shipping_fees' => 'biaya pengiriman',
        'title' => 'Keranjang Belanja',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Uh-oh, terdapat masalah dengan keranjang belanjamu yang menghalangi proses checkout!',
            'line_2' => 'Hapus atau perbarui item di atas untuk melanjutkan.',
        ],

        'empty' => [
            'text' => 'Keranjang belanjamu kosong.',
            'return_link' => [
                '_' => 'Kembalilah ke halaman :link untuk menelusuri berbagai cendera mata yang tersedia!',
                'link_text' => 'etalase toko',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh-oh, terdapat masalah dengan keranjang belanjamu!',
        'cart_problems_edit' => 'Klik di sini untuk menyuntingnya.',
        'declined' => 'Pembayaran dibatalkan.',
        'delayed_shipping' => 'Kami sedang kebanjiran pesanan! Apabila kamu memesan sekarang, mohon beri kami waktu tambahan **selama 1-2 minggu** untuk memproses pesananmu selagi kami mengurus pesanan yang sudah ada.',
        'hide_from_activity' => 'Sembunyikan semua tag osu!supporter pada pesanan ini dari aktivitas saya',
        'old_cart' => 'Keranjang belanjamu sepertinya sudah usang dan sudah dimuat ulang. Silakan coba lagi.',
        'pay' => 'Checkout melalui Paypal',
        'title_compact' => 'checkout',

        'has_pending' => [
            '_' => 'Kamu memiliki transaksi yang belum tuntas. Klik :link untuk melihatnya.',
            'link_text' => 'di sini',
        ],

        'pending_checkout' => [
            'line_1' => 'Terdapat transaksi terdahulu yang belum dituntaskan.',
            'line_2' => 'Lanjutkan pembayaranmu dengan memilih metode pembayaran.',
        ],
    ],

    'discount' => 'hemat :percent%',
    'free' => 'gratis!',

    'invoice' => [
        'contact' => 'Kontak:',
        'date' => 'Tanggal:',
        'echeck_delay' => 'Berhubung pembayaranmu berupa eCheck, mohon tunggu hingga setidaknya 10 hari bagi PayPal untuk memproses pembayaranmu!',
        'echeck_denied' => 'Pembayaran eCheck ini ditolak oleh PayPal.',
        'hide_from_activity' => 'Tag osu!supporter yang dipesan melalui pesanan ini tidak akan ditampilkan pada riwayat aktivitas terkini milikmu.',
        'sent_via' => 'Dikirim Melalui:',
        'shipping_to' => 'Dikirim Ke:',
        'title' => 'Faktur',
        'title_compact' => 'faktur',

        'status' => [
            'cancelled' => [
                'title' => 'Pesananmu sudah dibatalkan',
                'line_1' => [
                    '_' => "Apabila kamu tidak meminta pembatalan ini, silakan hubungi :link dengan menyertakan nomor pesananmu (#:order_number).",
                    'link_text' => 'layanan dukungan osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'Pesananmu sudah dikirim! Kami harap kamu menikmatinya!',
                'line_1' => [
                    '_' => 'Apabila kamu menemui masalah dengan pembelianmu, silakan hubungi :link.',
                    'link_text' => 'layanan dukungan osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'Pesananmu sedang dipersiapkan!',
                'line_1' => 'Mohon tunggu sedikit lebih lama sebelum pesanan kamu dikirim. Informasi pelacakan kamu akan muncul pada halaman ini setelah pesananmu diproses dan dikirim. Hal ini bisa memakan waktu hingga 5 hari (namun biasanya akan lebih cepat!) tergantung dari kesibukan kami.',
                'line_2' => 'Kami mengirimkan semua pesanan dari Jepang dengan berbagai macam layanan pengiriman tergantung berat dan nilainya. Bagian ini akan diperbarui dengan rincian pengiriman setelah kami mengirimkan pesananmu.',
            ],
            'processing' => [
                'title' => 'Pembayaranmu belum terkonfirmasi!',
                'line_1' => 'Apabila kamu sudah membayar, kami mungkin masih menunggu konfirmasi pembayaranmu. Silakan muat ulang halaman ini dalam beberapa menit!',
                'line_2' => [
                    '_' => 'Apabila kamu menemui masalah dalam proses checkout, :link',
                    'link_text' => 'klik di sini untuk melanjutkan proses checkout',
                ],
            ],
            'shipped' => [
                'title' => 'Pesananmu sudah dikirim!',
                'tracking_details' => 'Berikut rincian pelacakan yang terkait:',
                'no_tracking_details' => [
                    '_' => "Kami tidak memiliki rincian pelacakan apa pun karena kami mengirim paketmu via Air Mail, namun pesananmu seharusnya akan sampai dalam 1-3 minggu. Untuk pengiriman ke Eropa, terkadang bea cukai setempat bisa menunda pesananmu di luar kendali kami. Apabila kamu memiliki sesuatu yang ingin ditanyakan, silakan balas email konfirmasi pesanan yang kamu terima (atau :link).",
                    'link_text' => 'kirimi kami email',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Batalkan Pesanan',
        'cancel_confirm' => 'Pesanan ini akan dibatalkan dan pembayaran yang masuk tidak akan diterima. Layanan pembayaran mungkin tidak akan mencairkan dana yang tersimpan dengan segera. Apakah kamu yakin?',
        'cancel_not_allowed' => 'Pesanan ini tidak bisa dibatalkan pada saat ini.',
        'invoice' => 'Lihat Faktur',
        'no_orders' => 'Tidak ada pesanan yang tercatat.',
        'paid_on' => 'Pemesanan dilangsungkan pada :date',
        'resume' => 'Lanjutkan Proses Checkout',
        'shipping_and_handling' => 'Pengiriman & Penanganan',
        'shopify_expired' => 'Tautan checkout untuk pesanan ini sudah kedaluwarsa.',
        'subtotal' => 'Subtotal',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Pesanan #',
            'payment_terms' => 'Ketentuan Pembayaran',
            'salesperson' => 'Pramuniaga',
            'shipping_method' => 'Metode Pengiriman',
            'shipping_terms' => 'Ketentuan Pengiriman',
            'title' => 'Rincian Pesanan',
        ],

        'item' => [
            'quantity' => 'jumlah',

            'display_name' => [
                'supporter_tag' => ':name untuk :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Pesan: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Kamu tidak bisa mengubah pesananmu karena pesanan ini sudah dibatalkan.',
            'checkout' => 'Kamu tidak bisa mengubah pesananmu pada saat pesanan ini sedang diproses.', // checkout and processing should have the same message.
            'default' => 'Pesanan tidak bisa diubah',
            'delivered' => 'Kamu tidak bisa mengubah pesananmu karena pesanan ini sudah dikirim.',
            'paid' => 'Kamu tidak bisa mengubah pesananmu karena pesanan ini sudah dilunasi.',
            'processing' => 'Kamu tidak bisa mengubah pesananmu pada saat pesanan ini sedang diproses.',
            'shipped' => 'Kamu tidak bisa mengubah pesananmu karena pesanan ini sudah dikirim.',
        ],

        'status' => [
            'cancelled' => 'Dibatalkan',
            'checkout' => 'Mempersiapkan',
            'delivered' => 'Sampai Tujuan',
            'paid' => 'Lunas',
            'processing' => 'Menunggu konfirmasi',
            'shipped' => 'Dalam Perjalanan',
            'title' => 'Status Pesanan',
        ],

        'thanks' => [
            'title' => 'Terima kasih atas pesananmu!',
            'line_1' => [
                '_' => 'Kamu akan menerima email konfirmasi dengan segera. Apabila kamu memiliki pertanyaan lebih lanjut, silakan :link!',
                'link_text' => 'hubungi kami',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nama',

        'stock' => [
            'out' => 'Stok barang ini sedang tidak tersedia. Silakan periksa kembali nanti!',
            'out_with_alternative' => 'Sayangnya, stok barang ini sedang tidak tersedia. Gunakan menu dropdown untuk memilih varian lain atau periksa kembali nanti!',
        ],

        'add_to_cart' => 'Tambah ke Keranjang',
        'notify' => 'Beritahukan saya ketika tersedia!',
        'out_of_stock' => 'Stok habis',

        'notification_success' => 'kamu akan menerima notifikasi pada saat kami memiliki stok baru. klik :link untuk membatalkan',
        'notification_remove_text' => 'di sini',

        'notification_in_stock' => 'Produk ini sudah tersedia!',
    ],

    'supporter_tag' => [
        'gift' => 'hadiahkan ke pemain lain',
        'gift_message' => 'tambahkan pesan untuk melengkapi hadiahmu! (maksimal :length karakter)',

        'require_login' => [
            '_' => 'Kamu harus :link untuk memperoleh tag osu!supporter!',
            'link_text' => 'masuk',
        ],
    ],

    'username_change' => [
        'check' => 'Masukkan nama pengguna untuk memeriksa ketersediaannya!',
        'checking' => 'Memeriksa ketersediaan :username...',
        'placeholder' => 'Nama Pengguna yang Diminta',
        'label' => 'Nama Pengguna Baru',
        'current' => 'Nama penggunamu saat ini adalah ":username".',

        'require_login' => [
            '_' => 'Kamu harus :link untuk mengubah namamu!',
            'link_text' => 'masuk',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
