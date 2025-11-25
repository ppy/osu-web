<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_ruleset' => 'Ruleset yang diberikan tidak valid.',

    'change_owner' => [
        'too_many' => 'Jumlah mapper tamu terlalu banyak.',
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Pilihan gagal diperbarui',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'izinkan kudosu',
        'beatmap_information' => 'Halaman Beatmap',
        'delete' => 'hapus',
        'deleted' => 'Dihapus oleh :editor :delete_time.',
        'deny_kudosu' => 'tolak kudosu',
        'edit' => 'sunting',
        'edited' => 'Terakhir disunting oleh :editor :update_time.',
        'guest' => 'Tingkat kesulitan tamu oleh :user',
        'kudosu_denied' => 'Perolehan kudosu ditolak.',
        'message_placeholder_deleted_beatmap' => 'Tingkat kesulitan ini telah dihapus sehingga diskusi lebih lanjut tidak lagi diperkenankan.',
        'message_placeholder_locked' => 'Diskusi pada beatmap ini telah ditutup.',
        'message_placeholder_silenced' => "Kamu tidak dapat mengirim topik diskusi pada saat sedang di-silence.",
        'message_type_select' => 'Pilih Jenis Komentar',
        'reply_notice' => 'Tekan enter untuk membalas.',
        'reply_resolve_notice' => 'Tekan enter untuk membalas. Tekan ctrl+enter untuk membalas dan menutup topik diskusi.',
        'reply_placeholder' => 'Ketik balasanmu di sini',
        'require-login' => 'Silakan masuk untuk mengirim atau membalas postingan',
        'resolved' => 'Terjawab',
        'restore' => 'pulihkan',
        'show_deleted' => 'Tampilkan yang telah dihapus',
        'title' => 'Diskusi',
        'unresolved_count' => ':count_delimited masalah yang belum terjawab|:count_delimited masalah yang belum terjawab',

        'collapse' => [
            'all-collapse' => 'Ciutkan semua',
            'all-expand' => 'Lebarkan semua',
        ],

        'empty' => [
            'empty' => 'Belum ada diskusi!',
            'hidden' => 'Tidak ada topik diskusi yang sesuai dengan filter yang dipilih.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Kunci diskusi',
                'unlock' => 'Buka diskusi',
            ],

            'prompt' => [
                'lock' => 'Alasan penguncian',
                'unlock' => 'Apakah kamu yakin untuk membuka kunci halaman diskusi ini?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Topik diskusi ini akan tertuju pada Umum (Seluruh tingkat kesulitan). Untuk membuka topik diskusi baru khusus bagi tingkat kesulitan ini, mulailah pesanmu dengan keterangan waktu (mis: 00:12:345).',
            'in_timeline' => 'Untuk memberikan mod pada beberapa keterangan waktu, pisahkan mod kamu ke dalam beberapa topik diskusi (satu topik per keterangan waktunya).',
        ],

        'message_placeholder' => [
            'general' => 'Ketik di sini untuk mengirimkan topik diskusi baru pada Umum (:version)',
            'generalAll' => 'Ketik di sini untuk mengirimkan topik diskusi baru pada Umum (Seluruh tingkat kesulitan)',
            'review' => 'Ketik di sini untuk mengirimkan kajian',
            'timeline' => 'Ketik di sini untuk mengirimkan topik diskusi baru pada Linimasa (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskualifikasi',
            'hype' => 'Hype!',
            'mapper_note' => 'Catatan',
            'nomination_reset' => 'Anulir Nominasi',
            'praise' => 'Pujian',
            'problem' => 'Masalah',
            'problem_warning' => 'Laporkan Masalah',
            'review' => 'Kajian',
            'suggestion' => 'Saran',
        ],

        'message_type_title' => [
            'disqualify' => 'Tulis Diskualifikasi',
            'hype' => 'Tulis Hype!',
            'mapper_note' => 'Tulis Catatan',
            'nomination_reset' => 'Hapus seluruh Nominasi',
            'praise' => 'Tulis Pujian',
            'problem' => 'Tulis Masalah',
            'problem_warning' => 'Tulis Masalah',
            'review' => 'Tulis Kajian',
            'suggestion' => 'Tulis Saran',
        ],

        'mode' => [
            'events' => 'Riwayat',
            'general' => 'Umum :scope',
            'reviews' => 'Kajian',
            'timeline' => 'Linimasa',
            'scopes' => [
                'general' => 'Tingkat kesulitan ini',
                'generalAll' => 'Seluruh tingkat kesulitan',
            ],
        ],

        'new' => [
            'pin' => 'Sematkan',
            'timestamp' => 'Keterangan Waktu',
            'timestamp_missing' => 'salin (ctrl+c) objek pada mode edit dan tempelkan (ctrl+v) pada pesanmu untuk menambahkan keterangan waktu!',
            'title' => 'Topik Diskusi Baru',
            'unpin' => 'Lepas Sematan',
        ],

        'review' => [
            'new' => 'Kajian Baru',
            'embed' => [
                'delete' => 'Hapus',
                'missing' => '[TOPIK DISKUSI DIHAPUS]',
                'unlink' => 'Lepas Tautan',
                'unsaved' => 'Belum Tersimpan',
                'timestamp' => [
                    'all-diff' => 'Postingan yang tertuju pada "Umum (Seluruh tingkat kesulitan)" tidak dapat mengandung keterangan waktu.',
                    'diff' => 'Apabila topik diskusi ini dimulai dengan keterangan waktu, topik ini akan muncul pada tab Linimasa.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'sisipkan paragraf baru',
                'praise' => 'sisipkan pujian',
                'problem' => 'sisipkan masalah',
                'suggestion' => 'sisipkan saran',
            ],
        ],

        'show' => [
            'title' => ':title dibuat oleh :mapper',
        ],

        'sort' => [
            'created_at' => 'Tanggal pembuatan',
            'timeline' => 'Linimasa',
            'updated_at' => 'Pembaruan terakhir',
        ],

        'stats' => [
            'deleted' => 'Dihapus',
            'mapper_notes' => 'Catatan',
            'mine' => 'Milik Saya',
            'pending' => 'Belum Terjawab',
            'praises' => 'Pujian',
            'resolved' => 'Terjawab',
            'total' => 'Semua',
        ],

        'status-messages' => [
            'approved' => 'Beatmap ini telah di-approve pada tanggal :date!',
            'graveyard' => "Beatmap ini belum diperbarui sejak :date dan sepertinya telah diabaikan oleh pembuatnya...",
            'loved' => 'Beatmap ini telah ditambahkan ke kategori Loved pada tanggal :date!',
            'ranked' => 'Beatmap ini telah di-rank pada tanggal :date!',
            'wip' => 'Catatan: Beatmap ini ditandai dengan status dalam pengerjaan (work-in-progress) oleh pembuatnya.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Belum ada downvote',
                'up' => 'Belum ada upvote',
            ],
            'latest' => [
                'down' => 'Downvote terbaru',
                'up' => 'Upvote terbaru',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Berikan Hype!',
        'button_done' => 'Telah di-Hype!',
        'confirm' => "Apakah kamu yakin? Dengan ini, kamu akan memberikan 1 hype kepada beatmap ini dari :n hype yang kamu miliki saat ini. Tindakan ini tidak dapat dibatalkan.",
        'explanation' => 'Berikan hype-mu untuk membawa beatmap ini lebih dekat menuju Ranked!',
        'explanation_guest' => 'Masuk dan berikan hype kepada beatmap ini agar beatmap ini dapat segera dinominasikan dan di-rank!',
        'new_time' => "Kamu akan memperoleh lebih banyak hype :new_time.",
        'remaining' => 'Kamu memiliki :remaining hype yang tersisa.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Perolehan Hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Berikan Masukan',
    ],

    'nominations' => [
        'already_nominated' => 'Kamu telah menominasikan beatmap ini.',
        'cannot_nominate' => 'Kamu tidak dapat memberikan nominasi untuk mode permainan ini.',
        'delete' => 'Hapus',
        'delete_own_confirm' => 'Apakah kamu yakin? Beatmap ini akan dihapus dan kamu akan dialihkan kembali ke halaman profilmu.',
        'delete_other_confirm' => 'Apakah kamu yakin? Beatmap ini akan dihapus dan kamu akan dialihkan kembali ke halaman profil pengguna yang bersangkutan.',
        'disqualification_prompt' => 'Alasan diskualifikasi?',
        'disqualified_at' => 'Didiskualifikasi pada :time_ago (:reason).',
        'disqualified_no_reason' => 'tidak ada alasan yang diberikan',
        'disqualify' => 'Diskualifikasi',
        'incorrect_state' => 'Terdapat kesalahan dalam melangsungkan tindakan ini. Cobalah untuk memuat ulang halaman.',
        'love' => 'Love',
        'love_choose' => 'Pilih tingkat kesulitan untuk diangkat ke kategori Loved',
        'love_confirm' => 'Love beatmap ini?',
        'nominate' => 'Nominasi',
        'nominate_confirm' => 'Nominasikan beatmap ini?',
        'nominated_by' => 'dinominasikan oleh :users',
        'not_enough_hype' => "Beatmap ini belum memperoleh cukup hype.",
        'remove_from_loved' => 'Lepas dari Loved',
        'remove_from_loved_prompt' => 'Alasan pelepasan status Loved:',
        'required_text' => 'Nominasi: :current/:required',
        'reset_message_deleted' => 'dihapus',
        'title' => 'Status Nominasi',
        'unresolved_issues' => 'Terdapat masalah belum terjawab yang harus diselesaikan terlebih dahulu.',

        'rank_estimate' => [
            '_' => 'Beatmap ini diperkirakan akan di-rank :date apabila tidak terdapat masalah yang ditemukan. Beatmap ini berada pada urutan ke-:position dalam :queue saat ini.',
            'unresolved_problems' => 'Beatmap ini sedang diblokir untuk dapat melewati kategori Qualified hingga :problems terselesaikan.',
            'problems' => 'masalah ini',
            'on' => 'pada tanggal :date',
            'queue' => 'antrean ranking',
            'soon' => 'segera',
        ],

        'reset_at' => [
            'nomination_reset' => 'Proses nominasi dianulir :time_ago oleh :user dengan ditemukannya masalah baru :discussion (:message).',
            'disqualify' => 'Didiskualifikasi :time_ago oleh :user dengan ditemukannya masalah baru :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Apakah kamu yakin? Tindakan ini akan melepas beatmap ini dari kategori Qualified dan mengulang proses nominasi dari awal.',
            'nomination_reset' => 'Apakah kamu yakin? Memposting masalah baru akan mengulang proses nominasi.',
            'problem_warning' => 'Apakah kamu yakin untuk melaporkan masalah pada beatmap ini? Tindakan ini akan memperingatkan seluruh anggota Beatmap Nominator.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'ketik kata kunci pencarian...',
            'login_required' => 'Silakan masuk untuk mencari.',
            'options' => 'Pilihan Pencarian Lebih Lanjut',
            'supporter_filter' => 'Penyaringan berdasarkan :filters memerlukan tag osu!supporter yang aktif',
            'not-found' => 'tidak ada hasil',
            'not-found-quote' => '… enggak, tidak ada yang ditemukan.',
            'filters' => [
                'extra' => 'Konten Tambahan',
                'general' => 'Umum',
                'genre' => 'Aliran',
                'language' => 'Bahasa',
                'mode' => 'Mode',
                'nsfw' => 'Konten Eksplisit',
                'played' => 'Riwayat Permainan',
                'rank' => 'Torehan Peringkat',
                'status' => 'Status',
            ],
            'sorting' => [
                'title' => 'Judul',
                'artist' => 'Artis',
                'difficulty' => 'Tingkat Kesulitan',
                'favourites' => 'Jumlah Favorit',
                'updated' => 'Tanggal Pembaruan',
                'ranked' => 'Tanggal Ranked',
                'rating' => 'Nilai Pengguna',
                'plays' => 'Jumlah Permainan',
                'relevance' => 'Relevansi',
                'nominations' => 'Jumlah Nominasi',
            ],
            'supporter_filter_quote' => [
                '_' => 'Penyaringan berdasarkan :filters memerlukan :link yang aktif',
                'link_text' => 'tag osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Sertakan beatmap convert',
        'featured_artists' => 'Featured artist',
        'follows' => 'Mapper yang diikuti',
        'recommended' => 'Kesulitan yang disarankan',
        'spotlights' => 'Beatmap yang di-spotlight',
    ],
    'mode' => [
        'all' => 'Semua',
        'any' => 'Semua',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
        'undefined' => 'belum diatur',
    ],
    'status' => [
        'any' => 'Semua',
        'approved' => 'Approved',
        'favourites' => 'Favorit',
        'graveyard' => 'Graveyard',
        'leaderboard' => 'Memiliki Leaderboard',
        'loved' => 'Loved',
        'mine' => 'Beatmap Saya',
        'pending' => 'Pending',
        'wip' => 'WIP',
        'qualified' => 'Qualified',
        'ranked' => 'Ranked',
    ],
    'genre' => [
        'any' => 'Semua',
        'unspecified' => 'Belum Ditentukan',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Lainnya',
        'novelty' => 'Novelti',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronik',
        'metal' => 'Metal',
        'classical' => 'Klasik',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
    ],
    'language' => [
        'any' => 'Semua',
        'english' => 'Inggris',
        'chinese' => 'Mandarin',
        'french' => 'Perancis',
        'german' => 'Jerman',
        'italian' => 'Italia',
        'japanese' => 'Jepang',
        'korean' => 'Korea',
        'spanish' => 'Spanyol',
        'swedish' => 'Swedia',
        'russian' => 'Rusia',
        'polish' => 'Polandia',
        'instrumental' => 'Instrumental',
        'other' => 'Lainnya',
        'unspecified' => 'Belum Ditentukan',
    ],

    'nsfw' => [
        'exclude' => 'Sembunyikan',
        'include' => 'Tampilkan',
    ],

    'played' => [
        'any' => 'Semua',
        'played' => 'Pernah Dimainkan',
        'unplayed' => 'Belum Pernah Dimainkan',
    ],
    'extra' => [
        'video' => 'Memiliki Video',
        'storyboard' => 'Memiliki Storyboard',
    ],
    'rank' => [
        'any' => 'Semua',
        'XH' => 'Silver SS',
        'X' => '',
        'SH' => 'Silver S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Jumlah permainan: :count',
        'favourites' => 'Jumlah favorit: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Semua',
        ],
    ],
];
