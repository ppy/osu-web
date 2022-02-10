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
            'info' => 'Ukuran gambar sampul yang disarankan adalah :dimensions. Anda juga dapat meletakkan gambar Anda di sini untuk mengunggahnya.',
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
            'empty' => 'Tidak ada topik apapun!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Tandai forum ini sebagai telah terbaca',
        'forums' => 'Tandai forum-forum ini sebagai telah terbaca',
        'busy' => 'Menandai sebagai telah terbaca...',
    ],

    'post' => [
        'confirm_destroy' => 'Apakah Anda yakin untuk menghapus post ini?',
        'confirm_restore' => 'Apakah Anda yakin untuk memulihkan post ini?',
        'edited' => 'Terakhir disunting oleh :user :when, dengan total penyuntingan sebanyak :count_delimited kali.|Terakhir disunting oleh :user :when, dengan total penyuntingan sebanyak :count_delimited kali.',
        'posted_at' => 'diposting :when',
        'posted_by' => 'di-post oleh :username',

        'actions' => [
            'destroy' => 'Hapus post',
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
        'confirm_restore' => 'Apakah Anda yakin untuk memulihkan topik ini?',
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
        'reply_title_prefix' => 'Ttg',
        'started_by' => 'oleh :user',
        'started_by_verbose' => 'topik dimulai oleh :user',

        'actions' => [
            'destroy' => 'Hapus topik',
            'restore' => 'Pulihkan topik',
        ],

        'create' => [
            'close' => 'Tutup',
            'preview' => 'Pratinjau',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Tulis',
            'submit' => 'Kirim',

            'necropost' => [
                'default' => 'Topik ini sudah tidak lagi aktif. Harap untuk tidak membuat balasan baru pada topik ini kecuali apabila Anda memiliki alasan khusus untuk melakukannya.',

                'new_topic' => [
                    '_' => "Topik ini sudah tidak lagi aktif. Apabila Anda tidak memiliki alasan khusus untuk membuat balasan baru pada topik ini, harap :create.",
                    'create' => 'buat topik baru',
                ],
            ],

            'placeholder' => [
                'body' => 'Ketik konten post Anda di sini',
                'title' => 'Klik di sini untuk mengatur judul',
            ],
        ],

        'jump' => [
            'enter' => 'klik untuk memasukkan nomor post tertentu',
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
                'total' => 'Topik forum yang dipantau',
                'unread' => 'Topik forum dengan balasan baru',
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
                'remove' => 'Batalkan pembuatan jajak pendapat',
            ],

            'poll' => [
                'hide_results' => 'Rahasiakan hasil pada saat pemungutan suara sedang berlangsung.',
                'hide_results_info' => 'Apabila diaktifkan, hasil suara baru akan tersedia setelah jajak pendapat berakhir.',
                'length' => 'Jalankan jajak pendapat selama',
                'length_days_suffix' => 'hari',
                'length_info' => 'Kosongkan apabila Anda tidak ingin menerapkan tenggat waktu pada jajak pendapat ini',
                'max_options' => 'Pilihan per pengguna',
                'max_options_info' => 'Jumlah pilihan yang dapat dipilih oleh masing-masing pengguna.',
                'options' => 'Pilihan',
                'options_info' => 'Tempatkan masing-masing pilihan pada baris baru. Anda dapat menyertakan hingga 10 pilihan.',
                'title' => 'Pertanyaan',
                'vote_change' => 'Izinkan pemilihan ulang.',
                'vote_change_info' => 'Apabila diaktifkan, para pengguna akan dapat mengubah pilihan mereka.',
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
                'current' => 'Prioritas Saat Ini: +:count',
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
                'edit' => 'Sunting Jajak Pendapat',
                'edit_warning' => 'Menyunting jajak pendapat akan menganulir seluruh suara yang telah masuk!',
                'vote' => 'Pilih',

                'button' => [
                    'change_vote' => 'Ubah suara',
                    'edit' => 'Sunting jajak pendapat',
                    'view_results' => 'Lihat hasil',
                    'vote' => 'Pilih',
                ],

                'detail' => [
                    'end_time' => 'Jajak pendapat akan berakhir pada :time',
                    'ended' => 'Jajak pendapat telah berakhir pada :time',
                    'results_hidden' => 'Hasil jajak pendapat baru akan tersedia setelah pemungutan suara berakhir.',
                    'total' => 'Jumlah suara: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Tidak dimarkahi',
            'to_watching' => 'Markahi',
            'to_watching_mail' => 'Markahi dengan notifikasi',
            'tooltip_mail_disable' => 'Notifikasi untuk topik ini sedang tidak aktif. Klik untuk mengaktifkan notifikasi',
            'tooltip_mail_enable' => 'Notifikasi untuk topik ini sedang tidak aktif. Klik untuk mengaktifkan notifikasi',
        ],
    ],
];
