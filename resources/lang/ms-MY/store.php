<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Semak keluar',
        'empty_cart' => 'Padam semua barang dari troli',
        'info' => ':count_delimited barang dalam troli ($:subtotal)',
        'more_goodies' => 'Saya nak tengok lagi cenderahati sebelum habiskan pesanan',
        'shipping_fees' => 'yuran penghantaran',
        'title' => 'Troli Beli-Belah',
        'total' => 'jumlah',

        'errors_no_checkout' => [
            'line_1' => 'Alamak, troli anda mempunyai masalah yang menghalang semak keluar!',
            'line_2' => 'Padam atau kemas kini barang di atas untuk teruskan.',
        ],

        'empty' => [
            'text' => 'Kereta sorong anda kosong.',
            'return_link' => [
                '_' => 'Kembali ke :link untuk mencari cenderahati!',
                'link_text' => 'senarai kedai',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Alamak, ada masalah dengan troli anda!',
        'cart_problems_edit' => 'Tekan di sini untuk sunting.',
        'declined' => 'Bayaran dibatalkan.',
        'delayed_shipping' => 'Kami kini dilandai banyak pesanan! Anda dialu-alukan meletak pesanan anda tetapi sila jangkakan **kelewatan 1-2 minggu** sambil kami mengurus pesanan yang ada.',
        'hide_from_activity' => 'Sorok semua tag osu!supporter dalam pesanan ini dari aktivitiku',
        'old_cart' => 'Troli anda nampaknya usang dan sudah dimuat semula, sila cuba lagi.',
        'pay' => 'Semak keluar dengan Paypal',
        'title_compact' => 'semak keluar',

        'has_pending' => [
            '_' => 'Anda mempunyai semak keluar tidak lengkap, klik :link untuk lihat.',
            'link_text' => 'di sini',
        ],

        'pending_checkout' => [
            'line_1' => 'Sebuah semak keluar dimulakan tetapi tidak selesai.',
            'line_2' => 'Sambung semak keluar dengan memilih kaedah bayaran.',
        ],
    ],

    'discount' => 'diskaun :percent%',
    'free' => 'percuma!',

    'invoice' => [
        'contact' => 'Hubungi:',
        'date' => 'Tarikh:',
        'echeck_delay' => 'Bayaran anda berupa eCheck jadi sila benarkan hingga 10 hari tambahan untuk penyelesaian pembayaran melalui PayPal!',
        'echeck_denied' => 'Bayaran eCheck ditolak oleh PayPal.',
        'hide_from_activity' => 'Tag osu!supporter dalam urutan ini tidak dipaparkan dalam aktiviti terkini anda.',
        'sent_via' => 'Dihantar Melalui:',
        'shipping_to' => 'Dihantar ke:',
        'title' => 'Invois',
        'title_compact' => 'invois',

        'status' => [
            'cancelled' => [
                'title' => 'Pesanan anda telah dibatalkan',
                'line_1' => [
                    '_' => "Sekiranya anda tidak meminta pembatalan, sila hubungi :link dan sebutkan angka pesanan anda (#:order_number).",
                    'link_text' => 'sokongan osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'Pesanan anda telah dihantar! Semoga anda menikmatinya!',
                'line_1' => [
                    '_' => 'Sekiranya anda mempunyai isu dengan pembelian anda, sila hubungi :link.',
                    'link_text' => 'sokongan osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'Pesanan anda kini disiapkan!',
                'line_1' => 'Sila tunggu sebentar lagi untuk penghantaran. Maklumat penjejakan akan muncul di sini setelah pesanan telah diproses dan dihantar yang akan mengambil masa hingga 5 hari (tetapi biasanya kurang!) bergantung kepada kesibukan kami.',
                'line_2' => 'Kami mengirim semua pesanan dari Jepun menggunakan pelbagai perkhidmatan penghantaran yang bergantung kepada nilai dan berat. Kawasan ini akan kemas kini dengan tentuan setelah pesanan dihantar.',
            ],
            'processing' => [
                'title' => 'Bayaran anda belum disahkan!',
                'line_1' => 'Sekiranya anda telah bayar, kami mungkin masih menunggu penerimaan pengesahan bayaran anda. Sila segar semula halaman ini dalam seminit dua!',
                'line_2' => [
                    '_' => 'Sekiranya anda menghadapi masalah semasa semak keluar, :link',
                    'link_text' => 'klik di sini untuk menyambung semak keluar',
                ],
            ],
            'shipped' => [
                'title' => 'Pesanan anda telah dihantar!',
                'tracking_details' => 'Butiran penjejakan adalah berikut:',
                'no_tracking_details' => [
                    '_' => "Kami tidak mempunyai butiran penjejakan kerana bungkusan anda dihantar melalui Air Mail tetapi anda boleh menjangkakan penerimaan dalam masa 1-3 minggu. Untuk Eropah, sesekali pemeriksaan kastam boleh melewatkan pesanan di luar kawalan kami. Sekiranya anda mempunyai keraguan, sila balas emel pengesahan pesanan yang diterima (atau :link).",
                    'link_text' => 'kirimi kami e-mel',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Batalkan Pesanan',
        'cancel_confirm' => 'Pesanan ini akan dibatalkan dan bayaran pesanan tidak akan diterima. Penyedia bayaran mungkin tidak akan segera mengeluarkan dana rizab. Adakah anda pasti?',
        'cancel_not_allowed' => 'Pesanan tidak boleh dibatalkan pada masa ini.',
        'invoice' => 'Lihat Invois',
        'no_orders' => 'Tiada pesanan untuk dilihat.',
        'paid_on' => 'Pesanan ditempah pada :date',
        'resume' => 'Sambung Semak Keluar',
        'shipping_and_handling' => 'Penghantaran & Pengendalian',
        'shopify_expired' => 'Pautan semak keluar pesanan ini telah luput.',
        'subtotal' => 'Jumlah kecil',
        'total' => 'Jumlah',

        'details' => [
            'order_number' => 'Pesanan #',
            'payment_terms' => 'Syarat Bayaran',
            'salesperson' => 'Jurujual',
            'shipping_method' => 'Kaedah Penghantaran',
            'shipping_terms' => 'Syarat Penghantaran',
            'title' => 'Butiran Pesanan',
        ],

        'item' => [
            'quantity' => 'kuantiti',

            'display_name' => [
                'supporter_tag' => ':name untuk :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Pesanan: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Anda tidak boleh menyesuai pesanan anda kerana telah dibatalkan.',
            'checkout' => 'Anda tidak boleh menyesuai pesanan anda ketika diproses.', // checkout and processing should have the same message.
            'default' => 'Pesanan tidak boleh disesuaikan',
            'delivered' => 'Anda tidak boleh menyesuai pesanan anda kerana telah dihantar.',
            'paid' => 'Anda tidak boleh menyesuai pesanan anda kerana telah dibayar.',
            'processing' => 'Anda tidak boleh menyesuai pesanan anda ketika diproses.',
            'shipped' => 'Anda tidak boleh menyesuai pesanan anda kerana telah dihantar.',
        ],

        'status' => [
            'cancelled' => 'Dibatalkan',
            'checkout' => 'Menyiapkan',
            'delivered' => 'Dihantar',
            'paid' => 'Dibayar',
            'processing' => 'Menunggu pengesahan',
            'shipped' => 'Dihantar',
            'title' => 'Taraf Pesanan',
        ],

        'thanks' => [
            'title' => 'Terima kasih atas pesanan anda!',
            'line_1' => [
                '_' => 'Anda akan menerima e-mel pengesahan sebentar lagi. Sekiranya anda mempunyai pertanyaan, sila :link!',
                'link_text' => 'hubungi kami',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nama',

        'stock' => [
            'out' => 'Barang ini kini tiada dalam simpanan. Semak semula nanti!',
            'out_with_alternative' => 'Malangnya barang ini tiada dalam simpanan. Gunakan menu ke bawah untuk memilih jenis yang lain atau semak semula nanti!',
        ],

        'add_to_cart' => 'Tambah ke Troli',
        'notify' => 'Beritahu saya ketika telah tersedia!',
        'out_of_stock' => 'Tiada dalam simpanan',

        'notification_success' => 'anda akan diberitahu ketika kami mempunyai simpanan baharu. klik :link untuk batal',
        'notification_remove_text' => 'di sini',

        'notification_in_stock' => 'Barangan ini telah ada dalam simpanan!',
    ],

    'supporter_tag' => [
        'gift' => 'hadiahi pemain',
        'gift_message' => 'tambahkan pesanan pilihan pada hadiah anda! (hingga :length characters)',

        'require_login' => [
            '_' => 'Anda perlu :link untuk mendapat tag osu!supporter!',
            'link_text' => 'mendaftar masuk',
        ],
    ],

    'username_change' => [
        'check' => 'Masukkan nama pengguna untuk semak ketersediaan!',
        'checking' => 'Menyemak ketersediaan :username...',
        'placeholder' => 'Nama Pengguna Pintaan',
        'label' => 'Nama Pengguna Baharu',
        'current' => 'Nama pengguna semasa anda ialah ":username".',

        'require_login' => [
            '_' => 'Anda perlu :link untuk mengubah nama anda!',
            'link_text' => 'mendaftar masuk',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
