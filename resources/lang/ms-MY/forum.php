<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Tajuk Disemat',
    'slogan' => "bahaya kalau main sendiri.",
    'subforums' => 'Subforum',
    'title' => 'Forum',

    'covers' => [
        'edit' => 'Sunting kulit',

        'create' => [
            '_' => 'Tetapkan gambar kulit',
            'button' => 'Muat naik kulit',
            'info' => 'Ukuran kulit sepatutnya :dimensions. Anda juga boleh lepaskan gambar anda di sini untuk memuat naik.',
        ],

        'destroy' => [
            '_' => 'Padam kulit',
            'confirm' => 'Adakah anda pasti ingin memadam gambar kulit?',
        ],
    ],

    'forums' => [
        'forums' => 'Forum',
        'latest_post' => 'Hantaran Terkini',

        'index' => [
            'title' => 'Indeks Forum',
        ],

        'topics' => [
            'empty' => 'Tiada tajuk!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Tanda forum selaku dibaca',
        'forums' => 'Tanda forum selaku dibaca',
        'busy' => 'Menanda selaku dibaca...',
    ],

    'post' => [
        'confirm_destroy' => 'Betul nak padam hantaran?',
        'confirm_restore' => 'Betul nak pulihkan hantaran?',
        'edited' => 'Suntingan terkini oleh :user :when, disunting sejumlah :count_delimited kali.',
        'posted_at' => 'dihantar :when',
        'posted_by_in' => 'dihantar oleh :username di :forum',

        'actions' => [
            'destroy' => 'Padam hantaran',
            'edit' => 'Sunting hantaran',
            'report' => 'Laporkan hantaran',
            'restore' => 'Pulihkan hantaran',
        ],

        'create' => [
            'title' => [
                'reply' => 'Balasan baru',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited hantaran',
            'topic_starter' => 'Pembuka Tajuk',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ke hantaran',
        'post_number_input' => 'masukkan angka hantaran',
        'total_posts' => ':posts_count jumlah hantaran',
    ],

    'topic' => [
        'confirm_destroy' => 'Betul nak padam tajuk?',
        'confirm_restore' => 'Betul nak pulihkan tajuk?',
        'deleted' => 'tajuk dipadam',
        'go_to_latest' => 'lihat hantaran terkini',
        'go_to_unread' => 'lihat hantaran pertama yang belum dibaca',
        'has_replied' => 'Anda telah membalas tajuk ini',
        'in_forum' => 'pada :forum',
        'latest_post' => ':when oleh :user',
        'latest_reply_by' => 'balasan terkini oleh :user',
        'new_topic' => 'Tajuk baharu',
        'new_topic_login' => 'Daftar masuk untuk hantar tajuk baru',
        'post_reply' => 'Hantar',
        'reply_box_placeholder' => 'Taip di sini untuk membalas',
        'reply_title_prefix' => 'Ttg',
        'started_by' => 'oleh :user',
        'started_by_verbose' => 'dimulai oleh :user',

        'actions' => [
            'destroy' => 'Padam tajuk',
            'restore' => 'Pulihkan tajuk',
        ],

        'create' => [
            'close' => 'Tutup',
            'preview' => 'Pratonton',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Sunting',
            'submit' => 'Hantar',

            'necropost' => [
                'default' => 'Tajuk ini telah lengai buat sementara. Hantar di sini hanya sekiranya anda mempunyai sebab tertentu.',

                'new_topic' => [
                    '_' => "Tajuk ini telah lengai buat sementara. Sebaliknya, sila :create sekiranya anda tidak mempunyai sebab tertentu untuk menghantar ke sini.",
                    'create' => 'cipta tajuk baharu',
                ],
            ],

            'placeholder' => [
                'body' => 'Taip kandungan hantaran di sini',
                'title' => 'Klik sini untuk tetapkan judul',
            ],
        ],

        'jump' => [
            'enter' => 'klik untuk memasukkan angka hantaran tertentu',
            'first' => 'ke hantaran pertama',
            'last' => 'ke hantaran terkini',
            'next' => 'langkau 10 hantaran seterusnya',
            'previous' => 'mandir 10 hantaran',
        ],

        'logs' => [
            '_' => 'Log tajuk',
            'button' => 'Layari log tajuk',

            'columns' => [
                'action' => 'Tindakan',
                'date' => 'Tarikh',
                'user' => 'Pengguna',
            ],

            'data' => [
                'add_tag' => 'tag ":tag" ditambah',
                'announcement' => 'tajuk disemat dan ditanda sebagai pengumuman',
                'edit_topic' => 'ke :title',
                'fork' => 'dari :topic',
                'pin' => 'tajuk disemat',
                'post_operation' => 'dihantar oleh :username',
                'remove_tag' => 'tag ":tag" dipadam',
                'source_forum_operation' => 'dari :forum',
                'unpin' => 'tajuk dinyahsemat',
            ],

            'no_results' => 'log tidak ditemui...',

            'operations' => [
                'delete_post' => 'Hantaran dipadam',
                'delete_topic' => 'Tajuk dipadam',
                'edit_topic' => 'Judul tajuk diubah',
                'edit_poll' => 'Tinjauan tajuk disunting',
                'fork' => 'Tajuk disalin',
                'issue_tag' => 'Tag diterbitkan',
                'lock' => 'Tajuk dikunci',
                'merge' => 'Hantaran dicantum ke tajuk ini',
                'move' => 'Tajuk dipindahkan',
                'pin' => 'Tajuk disemat',
                'post_edited' => 'Hantaran disunting',
                'restore_post' => 'Hantaran dipulihkan',
                'restore_topic' => 'Tajuk dipulihkan',
                'split_destination' => 'Hantaran pisah dipindahkan',
                'split_source' => 'Pisahkan hantaran',
                'topic_type' => 'Tetapkan jenis tajuk',
                'topic_type_changed' => 'Jenis tajuk diubah',
                'unlock' => 'Tajuk dibuka kunci',
                'unpin' => 'Tajuk dinyahsemat',
                'user_lock' => 'Tajuk sendiri kunci',
                'user_unlock' => 'Tajuk sendiri dibuka kunci',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Batal',
            'post' => 'Simpan',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'senarai ikutan tajuk forum',

            'box' => [
                'total' => 'Tajuk ikutan',
                'unread' => 'Tajuk dengan balasan baharu',
            ],

            'info' => [
                'total' => 'Anda mengikuti :total tajuk.',
                'unread' => 'Anda mempunyai :unread balasan kepada tajuk ikutan yang belum dibaca.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Nyahikut tajuk?',
                'title' => 'Nyahikut',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Tajuk',

        'actions' => [
            'login_reply' => 'Daftar Masuk untuk Membalas',
            'reply' => 'Balas',
            'reply_with_quote' => 'Petik hantaran untuk balasan',
            'search' => 'Cari',
        ],

        'create' => [
            'create_poll' => 'Penciptaan Tinjauan',

            'preview' => 'Hantar Pratonton',

            'create_poll_button' => [
                'add' => 'Cipta tinjauan',
                'remove' => 'Batalkan penciptaan tinjauan',
            ],

            'poll' => [
                'hide_results' => 'Sorok hasil tinjauan.',
                'hide_results_info' => 'Hasil akan ditunjukkan hanya setelah tinjauan tamat.',
                'length' => 'Jalankan tinjauan selama',
                'length_days_suffix' => 'hari',
                'length_info' => 'Kosongkan untuk tinjauan tanpa tamat',
                'max_options' => 'Pilihan setiap pengguna',
                'max_options_info' => 'Ini jumlah pilihan untuk setiap pengguna ketika mengundi.',
                'options' => 'Tetapan',
                'options_info' => 'Letakkan setiap pilihan pada baris baru. Anda boleh masukkan hingga 10 pilihan.',
                'title' => 'Soalan',
                'vote_change' => 'Benarkan undian semula.',
                'vote_change_info' => 'Sekiranya diupayakan, pengguna boleh mengubah undian mereka.',
            ],
        ],

        'edit_title' => [
            'start' => 'Sunting judul',
        ],

        'index' => [
            'feature_votes' => 'keutamaan tinggi',
            'replies' => 'balasan',
            'views' => 'pelihatan',
        ],

        'issue_tag_added' => [
            'to_0' => 'Padam tag "added"',
            'to_0_done' => 'Tag "added" dipadam',
            'to_1' => 'Tambah tag "added"',
            'to_1_done' => 'Tag "added" ditambah',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Padam tag "assigned"',
            'to_0_done' => 'Tag "assigned" dipadam',
            'to_1' => 'Tambah tag "assigned"',
            'to_1_done' => 'Tag "assigned" ditambah',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Padam tag "confirmed"',
            'to_0_done' => 'Tag "confirmed" dipadam',
            'to_1' => 'Tambah tag "confirmed"',
            'to_1_done' => 'Tag "confirmed" ditambah',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Padam tag "duplicate"',
            'to_0_done' => 'Tag "duplicate" dipadam',
            'to_1' => 'Tambah tag "duplicate"',
            'to_1_done' => 'Tag "duplicate" ditambah',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Padam tag "invalid"',
            'to_0_done' => 'Tag "invalid" dipadam',
            'to_1' => 'Tambah tag "invalid"',
            'to_1_done' => 'Tag "invalid" ditambah',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Padam tag "resolved"',
            'to_0_done' => 'Tag "resolved" dipadam',
            'to_1' => 'Tambah tag "resolved"',
            'to_1_done' => 'Tag "resolved" ditambah',
        ],

        'issue_tag_osulazer' => [
            'to_0' => 'Padam tag "osu!lazer"',
            'to_0_done' => 'Tag "osu!lazer" dipadam',
            'to_1' => 'Tambah tag "osu!lazer"',
            'to_1_done' => 'Tag "osu!lazer" ditambah',
        ],

        'issue_tag_osustable' => [
            'to_0' => 'Padam tag "osu!stable"',
            'to_0_done' => 'Tag "osu!stable" dipadam',
            'to_1' => 'Tambah tag "osu!stable"',
            'to_1_done' => 'Tag "osu!stable" ditambah',
        ],

        'issue_tag_osuweb' => [
            'to_0' => 'Padam tag "osu!web"',
            'to_0_done' => 'Tag "osu!web" dipadam',
            'to_1' => 'Tambah tag "osu!web"',
            'to_1_done' => 'Tag "osu!web" ditambah',
        ],

        'lock' => [
            'is_locked' => 'Tajuk ini dikunci dan tidak boleh dibalas',
            'to_0' => 'Buka kunci tajuk',
            'to_0_confirm' => 'Buka kunci tajuk?',
            'to_0_done' => 'Tajuk telah dibuka kunci',
            'to_1' => 'Kunci tajuk',
            'to_1_confirm' => 'Kunci tajuk?',
            'to_1_done' => 'Tajuk telah dikunci',
        ],

        'moderate_move' => [
            'title' => 'Pindah ke forum lain',
        ],

        'moderate_pin' => [
            'to_0' => 'Nyahsemat tajuk',
            'to_0_confirm' => 'Nyahsemat tajuk?',
            'to_0_done' => 'Tajuk telah dinyahsemat',
            'to_1' => 'Semat tajuk',
            'to_1_confirm' => 'Semat tajuk?',
            'to_1_done' => 'Tajuk telah disemat',
            'to_2' => 'Semat tajuk dan tanda sebagai pengumuman',
            'to_2_confirm' => 'Semat tajuk dan tanda sebagai pengumuman?',
            'to_2_done' => 'Tajuk telah disemat dan ditanda sebagai pengumuman',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Tunjuk hantaran padaman',
            'hide' => 'Sorok hantaran terpadam',
        ],

        'show' => [
            'deleted-posts' => 'Hantaran Padaman',
            'total_posts' => 'Jumlah Hantaran',

            'feature_vote' => [
                'current' => 'Keutamaan Semasa: +:count',
                'do' => 'Galakkan permintaan ini',

                'info' => [
                    '_' => 'Ini ialah :feature_request. Permintaan ciri boleh diundi oleh :supporters.',
                    'feature_request' => 'permintaan ciri',
                    'supporters' => 'penyokong',
                ],

                'user' => [
                    'count' => '{0} tiada undian|{1} :count_delimited undian|[2,*] :count_delimited undian',
                    'current' => 'Anda mempunyai :votes lagi.',
                    'not_enough' => "Anda tidak mempunyai undian lagi",
                ],
            ],

            'poll' => [
                'edit' => 'Sunting Tinjauan',
                'edit_warning' => 'Hasil semasa akan dipadam sekiranya tinjauan disunting!',
                'vote' => 'Undi',

                'button' => [
                    'change_vote' => 'Ubah undian',
                    'edit' => 'Sunting tinjauan',
                    'view_results' => 'Langkau ke hasil',
                    'vote' => 'Undi',
                ],

                'detail' => [
                    'end_time' => 'Akhir tinjauan pada :time',
                    'ended' => 'Akhir tinjauan pada :time',
                    'results_hidden' => 'Hasil akan ditunjukkan setelah tinjauan tamat.',
                    'total' => 'Jumlah undian: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Tidak ditanda buku',
            'to_watching' => 'Tanda bukukan',
            'to_watching_mail' => 'Tanda bukukan dengan pemberitahuan',
            'tooltip_mail_disable' => 'Pemberitahuan diupayakan. Klik untuk lumpuhkan.',
            'tooltip_mail_enable' => 'Pemberitahuan dilumpuhkan. Klik untuk upayakan.',
        ],
    ],
];
