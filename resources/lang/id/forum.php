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
    'pinned_topics' => 'Topik yang Disematkan',
    'slogan' => "Bermain sendiri itu berbahaya.",
    'subforums' => 'Subforum',
    'title' => 'forum osu!',

    'covers' => [
        'edit' => 'Sunting sampul',

        'create' => [
            '_' => 'Pasang gambar sampul',
            'button' => 'Unggah gambar',
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
        'confirm_destroy' => 'Yakin menghapus post?',
        'confirm_restore' => 'Yakin mengembalikan post?',
        'edited' => 'Terakhir disunting oleh :user :when, total disunting sebanyak :count kali.',
        'posted_at' => 'Diposting :when',

        'actions' => [
            'destroy' => 'Hapus Kiriman',
            'restore' => 'Kembalikan post',
            'edit' => 'Sunting post',
        ],

        'create' => [
            'title' => [
                'reply' => 'Balasan baru',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited postingan',
            'topic_starter' => 'Pembuka Topik',
        ],
    ],

    'search' => [
        'go_to_post' => 'Pergi ke post',
        'post_number_input' => 'masukkan nomor post',
        'total_posts' => ':posts_count post total',
    ],

    'topic' => [
        'deleted' => 'topik yang dihapus',
        'go_to_latest' => 'lihat posting terbaru',
        'latest_post' => ':when oleh :user',
        'latest_reply_by' => 'balasan terbaru oleh :user',
        'new_topic' => 'Post topik baru',
        'new_topic_login' => 'Silakan masuk untuk membuat topik baru',
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Ketik di sini untuk membalas',
        'reply_title_prefix' => 'Re',
        'started_by' => 'oleh :user',
        'started_by_verbose' => 'topik dimulai oleh :user',

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
                    'create' => 'post topik baru',
                ],
            ],

            'placeholder' => [
                'body' => 'Ketik konten post di sini',
                'title' => 'Klik di sini untuk mengatur judul',
            ],
        ],

        'jump' => [
            'enter' => 'klik untuk memasukkan nomor tertentu',
            'first' => 'pergi ke post pertama',
            'last' => 'pergi ke post terakhir',
            'next' => 'lewati 10 post berikutnya',
            'previous' => 'tuju 10 post terdahulu',
        ],

        'post_edit' => [
            'cancel' => 'Batal',
            'post' => 'Simpan',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'langganan forum',

            'box' => [
                'total' => 'Topik yang dilanggan',
                'unread' => 'Topik dengan balasan terbaru',
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
            'reply_with_quote' => 'Kutip posting untuk balasan',
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
                'max_options_info' => 'Jumlah opsi yang dapat dipilih setiap pengguna saat memilih',
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
            'to_0' => 'Hapus tanda "tertambahkan"',
            'to_0_done' => 'Tanda "tertambahkan" telah dihapus',
            'to_1' => 'Tambahkan tanda "tertambahkan"',
            'to_1_done' => 'Tanda "tertambahkan" telah ditambahkan',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Hapus tanda "tertentukan"',
            'to_0_done' => 'Tanda "tertentukan" telah dihapus',
            'to_1' => 'Tambahkan tanda "tertentukan"',
            'to_1_done' => 'Tanda "tertentukan" telah ditambahkan',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Hapus tanda "terkonfirmasi"',
            'to_0_done' => 'Tanda "terkonfirmasi" telah dihapus',
            'to_1' => 'Tambahkan tanda "terkonfirmasi"',
            'to_1_done' => 'Tanda "terkonfirmasi" telah ditambahkan',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Hapus tanda "terselesaikan"',
            'to_0_done' => 'Tanda "terselesaikan" telah dihapus',
            'to_1' => 'Tambahkan tanda "terselesaikan"',
            'to_1_done' => 'Tanda "terselesaikan" telah ditambahkan',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Hapus tanda "tidak valid"',
            'to_0_done' => 'Tanda "tidak valid" telah dihapus',
            'to_1' => 'Tambahkan tanda "tidak valid"',
            'to_1_done' => 'Tanda "tidak valid" telah ditambahkan',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Hapus tanda "terselesaikan"',
            'to_0_done' => 'Tanda "terselesaikan" telah dihapus',
            'to_1' => 'Tambahkan tanda "terselesaikan"',
            'to_1_done' => 'Tanda "terselesaikan" telah ditambahkan',
        ],

        'lock' => [
            'is_locked' => 'Topik ini telah dikunci dan tidak dapat dibalas',
            'to_0' => 'Buka topik',
            'to_0_done' => 'Topik telah dibuka',
            'to_1' => 'Kunci topik',
            'to_1_done' => 'Topik telah dikunci',
        ],

        'moderate_move' => [
            'title' => 'Pindahkan ke forum lain',
        ],

        'moderate_pin' => [
            'to_0' => 'Lepas sematan topik',
            'to_0_done' => 'Sematan topik telah dilepaskan',
            'to_1' => 'Sematkan topik',
            'to_1_done' => 'Topik telah disematkan',
            'to_2' => 'Sematkan topik dan tandai sebagai pengumuman',
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
                    'count' => '{0} tidak ada suara|{1} :count suara|[2,*] :count suara',
                    'current' => 'Anda memiliki :votes tersisa.',
                    'not_enough' => "Anda tidak memiliki cukup hak suara untuk dapat mempromosikan gagasan ini lebih jauh.",
                ],
            ],

            'poll' => [
                'edit' => 'Sunting jajak pendapat',
                'edit_warning' => 'Menyunting isi jajak pendapat akan menghilangkan semua hasil yang sudah tercatat sampai saat ini!',
                'vote' => 'Pilih',

                'button' => [
                    'change_vote' => 'Ganti suara',
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
