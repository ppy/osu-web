<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Topik-Topik yang Disematkan',
    'slogan' => "Bermain sendiri itu berbahaya.",
    'subforums' => 'Subforum',
    'title' => 'Forum',

    'covers' => [
        'edit' => 'Sunting gambar sampul',

        'create' => [
            '_' => 'Pasang gambar sampul',
            'button' => 'Unggah gambar sampul',
            'info' => 'Ukuran gambar yang optimal adalah :dimensions. Anda juga dapat meletakkan gambar di sini untuk mengunggah.',
        ],

        'destroy' => [
            '_' => 'Hapus gambar sampul',
            'confirm' => 'Apakah Anda yakin ingin menghapus gambar sampul ini?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Kiriman Terbaru',

        'index' => [
            'title' => 'Indeks Forum',
        ],

        'topics' => [
            'empty' => 'Topik tidak ditemukan!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Tandai forum ini sebagai telah terbaca',
        'forums' => 'Tandai forum-forum ini sebagai telah terbaca',
        'busy' => 'Menandai sebagai telah terbaca...',
    ],

    'post' => [
        'confirm_destroy' => 'Apakah Anda yakin untuk menghapus post ini?',
        'confirm_restore' => 'Apakah Anda yakin untuk mengembalikan post ini?',
        'edited' => 'Terakhir disunting oleh :user :when, dengan total penyuntingan sebanyak :count_delimited kali.|Terakhir disunting oleh :user :when, dengan total penyuntingan sebanyak :count_delimited kali.',
        'posted_at' => 'diposting :when',
        'posted_by' => 'di-post oleh :username',

        'actions' => [
            'destroy' => 'Hapus Kiriman',
            'edit' => 'Sunting post',
            'report' => 'Laporkan post',
            'restore' => 'Pulihkan post',
        ],

        'create' => [
            'title' => [
                'reply' => 'Balasan baru',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited postingan|:count_delimited postingan',
            'topic_starter' => 'Pembuka Topik',
        ],
    ],

    'search' => [
        'go_to_post' => 'Tuju post',
        'post_number_input' => 'masukkan nomor post',
        'total_posts' => ':posts_count total postingan',
    ],

    'topic' => [
        'confirm_destroy' => 'Apakah Anda yakin untuk menghapus topik ini?',
        'confirm_restore' => 'Apakah Anda yakin untuk mengembalikan topik ini?',
        'deleted' => 'topik yang dihapus',
        'go_to_latest' => 'lihat postingan terbaru',
        'has_replied' => 'Anda telah mengirimkan balasan pada topik ini',
        'in_forum' => 'pada forum :forum',
        'latest_post' => ':when oleh :user',
        'latest_reply_by' => 'balasan terbaru oleh :user',
        'new_topic' => 'Topik baru',
        'new_topic_login' => 'Silakan masuk untuk membuat topik baru',
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Ketik di sini untuk membalas',
        'reply_title_prefix' => 'Re',
        'started_by' => 'oleh :user',
        'started_by_verbose' => 'topik dimulai oleh :user',

        'actions' => [
            'destroy' => 'Hapus topik',
            'restore' => 'Kembalikan topik',
        ],

        'create' => [
            'close' => 'Tutup',
            'preview' => 'Pratinjau',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Ketik',
            'submit' => 'Post',

            'necropost' => [
                'default' => 'Topik ini sudah tidak aktif untuk sementara waktu. Posting di sini jika Anda memiliki alasan khusus untuk melakukannya.',

                'new_topic' => [
                    '_' => "Topik ini sudah tidak aktif untuk beberapa waktu. Jika Anda tidak memiliki alasan khusus untuk memposting di sini, silakan :create saja.",
                    'create' => 'buat topik baru',
                ],
            ],

            'placeholder' => [
                'body' => 'Ketik konten post di sini',
                'title' => 'Klik di sini untuk mengatur judul',
            ],
        ],

        'jump' => [
            'enter' => 'klik untuk memasukkan nomor tertentu',
            'first' => 'tuju postingan pertama',
            'last' => 'tuju postingan terakhir',
            'next' => 'lewati 10 postingan berikutnya',
            'previous' => 'tuju 10 postingan sebelumnya',
        ],

        'logs' => [
            '_' => 'Log topik',
            'button' => 'Telusuri log topik',

            'columns' => [
                'action' => 'Tindakan',
                'date' => 'Tanggal',
                'user' => 'Pengguna',
            ],

            'data' => [
                'add_tag' => 'tag ":tag" disematkan',
                'announcement' => 'topik disematkan dan ditandai sebagai pengumuman',
                'edit_topic' => 'menuju :title',
                'fork' => 'dari :topic',
                'pin' => 'topik yang disematkan',
                'post_operation' => 'di-post oleh :username',
                'remove_tag' => 'tag ":tag" dihapus',
                'source_forum_operation' => 'dari :forum',
                'unpin' => 'topik yang tidak disematkan',
            ],

            'no_results' => 'tidak ada rekaman aktivitas yang tercatat...',

            'operations' => [
                'delete_post' => 'Postingan dihapus',
                'delete_topic' => 'Topik dihapus',
                'edit_topic' => 'Judul topik diubah',
                'edit_poll' => 'Jajak pendapat topik disunting',
                'fork' => 'Topik disalin',
                'issue_tag' => 'Tag disematkan',
                'lock' => 'Topik dikunci',
                'merge' => 'Postingan-postingan digabungkan ke dalam topik ini',
                'move' => 'Topik dipindahkan',
                'pin' => 'Topik disematkan',
                'post_edited' => 'Postingan disunting',
                'restore_post' => 'Postingan dipulihkan',
                'restore_topic' => 'Topik dipulihkan',
                'split_destination' => 'Postingan-postingan yang telah dipisah dipindahkan',
                'split_source' => 'Pisahkan post-post yang ada',
                'topic_type' => 'Tentukan tipe topik',
                'topic_type_changed' => 'Tipe topik diubah',
                'unlock' => 'Kunci topik dibuka',
                'unpin' => 'Sematan topik dilepas',
                'user_lock' => 'Topik milik sendiri dikunci',
                'user_unlock' => 'Kunci topik milik sendiri dibuka',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Batal',
            'post' => 'Simpan',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'daftar pantauan topik forum',

            'box' => [
                'total' => 'Topik yang dilanggan',
                'unread' => 'Topik dengan balasan baru',
            ],

            'info' => [
                'total' => 'Anda berlangganan :total topik.',
                'unread' => 'Anda mempunyai :unread balasan yang belum dibalas di topik yang Anda langgan.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Berhenti berlangganan dari topik?',
                'title' => 'Berhenti Berlangganan',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Topik',

        'actions' => [
            'login_reply' => 'Masuk untuk Membalas',
            'reply' => 'Balas',
            'reply_with_quote' => 'Kutip isi pesan sebagai bahan balasan',
            'search' => 'Cari',
        ],

        'create' => [
            'create_poll' => 'Pembuatan Jajak Pendapat',

            'preview' => 'Pratinjau Postingan',

            'create_poll_button' => [
                'add' => 'Buat jajak pendapat',
                'remove' => 'Batal membuat jajak pendapat',
            ],

            'poll' => [
                'hide_results' => 'Rahasiakan suara yang masuk ketika polling sedang berjalan.',
                'hide_results_info' => 'Hasil polling baru akan dapat terlihat ketika waktu pemungutan suara telah berakhir.',
                'length' => 'Jalankan jajak pendapat selama',
                'length_days_suffix' => 'hari',
                'length_info' => 'Biarkan kosong apabila Anda tidak ingin menerapkan tenggat waktu pada jajak pendapat ini',
                'max_options' => 'Pilihan per pengguna',
                'max_options_info' => 'Jumlah opsi yang dapat dipilih setiap pengguna saat memilih.',
                'options' => 'Pilihan',
                'options_info' => 'Tempatkan setiap opsi pada baris baru. Anda dapat memasukkan hingga 10 opsi.',
                'title' => 'Pertanyaan',
                'vote_change' => 'Izinkan pemilihan ulang.',
                'vote_change_info' => 'Jika diaktifkan, pengguna dapat mengubah pilihan mereka.',
            ],
        ],

        'edit_title' => [
            'start' => 'Sunting judul',
        ],

        'index' => [
            'feature_votes' => 'prioritas',
            'replies' => 'balasan',
            'views' => 'kali dilihat',
        ],

        'issue_tag_added' => [
            'to_0' => 'Hapus tag "added"',
            'to_0_done' => 'Tag "added" telah dihapus',
            'to_1' => 'Sematkan tag "added"',
            'to_1_done' => 'Tag "added" telah disematkan',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Hapus tag "assigned"',
            'to_0_done' => 'Tag "assigned" telah dihapus',
            'to_1' => 'Sematkan tag "assigned"',
            'to_1_done' => 'Tag "assigned" telah disematkan',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Hapus tag "confirmed"',
            'to_0_done' => 'Tag "confirmed" telah dihapus',
            'to_1' => 'Sematkan tag "confirmed"',
            'to_1_done' => 'Tag "confirmed" telah disematkan',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Hapus tag "duplicate"',
            'to_0_done' => 'Tag "duplilcate" telah dihapus',
            'to_1' => 'Sematkan tag "duplicate"',
            'to_1_done' => 'Tag "duplicate" telah disematkan',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Hapus tag "invalid"',
            'to_0_done' => 'Tag "invalid" telah dihapus',
            'to_1' => 'Sematkan tag "invalid"',
            'to_1_done' => 'Tag "invalid" telah disematkan',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Hapus tag "resolved"',
            'to_0_done' => 'Tag "resolved" telah dihapus',
            'to_1' => 'Sematkan tag "resolved"',
            'to_1_done' => 'Tag "resolved" telah disematkan',
        ],

        'lock' => [
            'is_locked' => 'Topik ini telah dikunci dan tidak dapat dibalas',
            'to_0' => 'Buka topik',
            'to_0_confirm' => 'Buka kunci topik?',
            'to_0_done' => 'Topik telah dibuka',
            'to_1' => 'Kunci topik',
            'to_1_confirm' => 'Kunci topik?',
            'to_1_done' => 'Topik telah dikunci',
        ],

        'moderate_move' => [
            'title' => 'Pindahkan ke forum lain',
        ],

        'moderate_pin' => [
            'to_0' => 'Lepas sematan topik',
            'to_0_confirm' => 'Lepas sematan topik?',
            'to_0_done' => 'Sematan topik telah dilepaskan',
            'to_1' => 'Sematkan topik',
            'to_1_confirm' => 'Sematkan topik?',
            'to_1_done' => 'Topik telah disematkan',
            'to_2' => 'Sematkan topik dan tandai sebagai pengumuman',
            'to_2_confirm' => 'Sematkan topik dan tandai sebagai pengumuman?',
            'to_2_done' => 'Topik telah disematkan dan ditandai sebagai pengumuman',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Tampilkan postingan yang telah dihapus',
            'hide' => 'Sembunyikan postingan yang telah dihapus',
        ],

        'show' => [
            'deleted-posts' => 'Post yang Dihapus',
            'total_posts' => 'Jumlah Post',

            'feature_vote' => [
                'current' => 'Prioritas saat ini: +:count',
                'do' => 'Promosikan permintaan ini',

                'info' => [
                    '_' => 'Ini adalah sebuah :feature_request. Fitur-fitur yang diajukan dapat di-vote lebih lanjut oleh :supporters.',
                    'feature_request' => 'permintaan fitur',
                    'supporters' => 'para supporter',
                ],

                'user' => [
                    'count' => '{0} tidak ada suara|{1} :count_delimited suara|[2,*] :count_delimited suara',
                    'current' => 'Anda memiliki :votes tersisa.',
                    'not_enough' => "Anda tidak memiliki cukup hak suara untuk dapat mempromosikan gagasan ini lebih jauh.",
                ],
            ],

            'poll' => [
                'edit' => 'Sunting jajak pendapat',
                'edit_warning' => 'Menyunting isi jajak pendapat akan menghilangkan semua hasil yang sudah tercatat sampai saat ini!',
                'vote' => 'Pilih',

                'button' => [
                    'change_vote' => 'Ubah suara',
                    'edit' => 'Sunting jajak pendapat',
                    'view_results' => 'Lewati ke hasil jajak pendapat',
                    'vote' => 'Pilih',
                ],

                'detail' => [
                    'end_time' => 'Pemilihan akan berakhir :time',
                    'ended' => 'Pemilihan telah berakhir :time',
                    'results_hidden' => 'Hasil polling baru akan dapat terlihat ketika waktu pemungutan suara telah berakhir.',
                    'total' => 'Jumlah suara: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Tidak dimarkahi',
            'to_watching' => 'Markah',
            'to_watching_mail' => 'Markah dengan notifikasi',
            'tooltip_mail_disable' => 'Anda sedang mengaktifkan notifikasi otomatis untuk topik ini. Klik di sini untuk menonaktifkan notifikasi otomatis',
            'tooltip_mail_enable' => 'Anda sedang tidak mengaktifkan notifikasi otomatis untuk topik ini. Klik di sini untuk mengaktifkan notifikasi otomatis',
        ],
    ],
];
