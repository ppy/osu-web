<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Gagal memperbarui pilihan',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'izinkan kudosu',
        'beatmap_information' => 'Laman Beatmap',
        'delete' => 'hapus',
        'deleted' => 'Dihapus oleh :editor :delete_time.',
        'deny_kudosu' => 'tolak kudosu',
        'edit' => 'sunting',
        'edited' => 'Terakhir disunting oleh :editor :update_time.',
        'kudosu_denied' => 'Perolehan kudosu ditolak.',
        'message_placeholder_deleted_beatmap' => 'Tingkat kesulitan ini telah dihapus sehingga diskusi lebih lanjut tidak lagi diperkenankan.',
        'message_placeholder_locked' => 'Laman diskusi pada beatmap ini telah ditutup.',
        'message_placeholder_silenced' => "Anda tidak dapat berpartisipasi pada laman diskusi beatmap ketika akun Anda sedang di-silence.",
        'message_type_select' => 'Pilih Jenis Komentar',
        'reply_notice' => 'Tekan enter untuk membalas.',
        'reply_placeholder' => 'Ketik balasan Anda di sini',
        'require-login' => 'Silakan masuk untuk membuka topik bahasan baru atau mengirimkan balasan',
        'resolved' => 'Terjawab',
        'restore' => 'kembalikan',
        'show_deleted' => 'Tampilan dihapus',
        'title' => 'Diskusi',

        'collapse' => [
            'all-collapse' => 'Ciutkan semua',
            'all-expand' => 'Lebarkan semua',
        ],

        'empty' => [
            'empty' => 'Belum ada diskusi!',
            'hidden' => 'Tidak ada diskusi yang cocok dengan filter yang dipilih.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Kunci diskusi',
                'unlock' => 'Buka diskusi',
            ],

            'prompt' => [
                'lock' => 'Alasan penguncian',
                'unlock' => 'Apakah Anda yakin untuk membuka kembali topik diskusi ini?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Topik-topik diskusi ini berlaku untuk keseluruhan mapset secara umum. Untuk membuka topik diskusi baru, mulai pesan Anda dengan keterangan waktu (cth: 00:12:345).',
            'in_timeline' => 'Topik-topik diskusi ini berlaku untuk masing-masing tingkat kesulitan secara spesifik. Untuk memulai topik diskusi baru, salin keterangan waktu dari editor disertai dengan komentar Anda (satu topik per keterangan waktu).',
        ],

        'message_placeholder' => [
            'general' => 'Ketik di sini untuk membuka topik bahasan baru pada Umum (:version)',
            'generalAll' => 'Ketik di sini untuk membuka topik bahasan baru pada Umum (Semua tingkat kesulitan)',
            'review' => 'Ketik di sini untuk memulai kajian baru',
            'timeline' => 'Ketik di sini untuk membuka topik bahasan baru pada Linimasa (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskualifikasi',
            'hype' => 'Hype!',
            'mapper_note' => 'Catatan',
            'nomination_reset' => 'Hilangkan Status Nominasi',
            'praise' => 'Pujian',
            'problem' => 'Masalah',
            'review' => 'Kajian',
            'suggestion' => 'Saran',
        ],

        'mode' => [
            'events' => 'Riwayat',
            'general' => 'Umum :scope',
            'reviews' => 'Kajian',
            'timeline' => 'Linimasa',
            'scopes' => [
                'general' => 'Tingkat kesulitan ini',
                'generalAll' => 'Semua tingkat kesulitan',
            ],
        ],

        'new' => [
            'pin' => 'Sematkan',
            'timestamp' => 'Keterangan Waktu',
            'timestamp_missing' => 'Salin (ctrl+c) keterangan waktu yang spesifik dari editor dan tempelkan (ctrl+v) pada boks yang tersedia untuk menambahkan keterangan waktu!',
            'title' => 'Diskusi Baru',
            'unpin' => 'Lepas sematan',
        ],

        'review' => [
            'new' => 'Kajian Baru',
            'embed' => [
                'delete' => 'Hapus',
                'missing' => '[TOPIK DISKUSI DIHAPUS]',
                'unlink' => 'Hapus Tautan',
                'unsaved' => 'Belum Tersimpan',
                'timestamp' => [
                    'all-diff' => 'Anda tidak dapat membubuhkan keterangan waktu pada topik bahasan yang tertuju pada "Umum (Semua tingkat kesulitan)".',
                    'diff' => 'Apabila terdapat keterangan waktu pada :type ini, topik bahasan yang bersangkutan akan muncul pada Linimasa.',
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
            'approved' => 'Beatmap ini telah di-Approve pada :date!',
            'graveyard' => "Beatmap ini belum diperbarui sejak :date dan kemungkinan besar telah diabaikan oleh pembuatnya...",
            'loved' => 'Beatmap ini telah ditambahkan pada kategori \'Loved\' pada :date!',
            'ranked' => 'Beatmap ini telah di-Rank pada :date!',
            'wip' => 'Catatan: Beatmap ini ditandai dengan status dalam pengerjaan (work-in-progress) oleh pembuat beatmap.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Belum ada downvote',
                'up' => 'Belum ada upvote',
            ],
            'latest' => [
                'down' => 'Downvotes terbaru',
                'up' => 'Upvotes terbaru',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Telah di-Hype!',
        'confirm' => "Apakah Anda yakin? Dengan ini Anda akan memberikan 1 hype kepada beatmap ini dari :n hype yang Anda miliki saat ini. Aksi ini tidak dapat diurungkan.",
        'explanation' => 'Berikan hype kepada beatmap ini agar beatmap ini dapat lebih layak dinominasikan dan dapat segera di-rank!',
        'explanation_guest' => 'Masuk dan berikan hype kepada beatmap ini agar beatmap ini dapat lebih layak dinominasikan dan dapat segera di-rank!',
        'new_time' => "Anda akan mendapatkan hype tambahan :new_time.",
        'remaining' => 'Anda memiliki :remaining hype tersisa.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Tinggalkan Masukan',
    ],

    'nominations' => [
        'delete' => 'Hapus',
        'delete_own_confirm' => 'Apa Anda yakin? Beatmap yang dipilih akan dihapus dan Anda akan dialihkan kembali ke profil Anda.',
        'delete_other_confirm' => 'Apa Anda yakin? Beatmap yang dipilih akan dihapus dan Anda akan dialihkan kembali ke profil pengguna.',
        'disqualification_prompt' => 'Alasan diskualifikasi?',
        'disqualified_at' => 'Didiskualifikasi pada :time_ago (:reason).',
        'disqualified_no_reason' => 'tidak ada alasan yang diberikan',
        'disqualify' => 'Diskualifikasi',
        'incorrect_state' => 'Ditemukan kesalahan saat melakukan tindakan ini, silakan muat ulang laman.',
        'love' => 'Love',
        'love_confirm' => 'Love beatmap ini?',
        'nominate' => 'Nominasi',
        'nominate_confirm' => 'Nominasikan beatmap ini?',
        'nominated_by' => 'dinominasikan oleh :users',
        'not_enough_hype' => "Beatmap tidak memiliki hype yang cukup.",
        'remove_from_loved' => 'Lepas dari Loved',
        'remove_from_loved_prompt' => 'Alasan pelepasan status Loved:',
        'required_text' => 'Nominasi: :current/:required',
        'reset_message_deleted' => 'dihapus',
        'title' => 'Status Nominasi',
        'unresolved_issues' => 'Terdapat satu atau lebih masalah yang belum terjawab dan harus ditangani terlebih dahulu.',

        'rank_estimate' => [
            '_' => 'Map ini akan berstatus Ranked pada :date apabila tidak terdapat masalah baru yang ditemukan. Map ini berada pada urutan ke-:position dalam :queue.',
            'queue' => 'antrian ranking',
            'soon' => 'segera',
        ],

        'reset_at' => [
            'nomination_reset' => 'Proses nominasi diulang :time_ago oleh :user akibat ditemukannya masalah baru :discussion (:message).',
            'disqualify' => 'Didiskualifikasi :time_ago oleh :user akibat ditemukannya masalah baru :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Apakah kamu yakin? Memposting masalah baru akan mengulang proses nominasi.',
            'disqualify' => 'Apakah Anda yakin? Tindakan ini akan menganulir status Qualified pada beatmap ini dan mengulang proses nominasi dari awal.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'ketik kata kunci...',
            'login_required' => 'Masuk untuk mencari.',
            'options' => 'Pilihan Pencarian Lebih Lanjut',
            'supporter_filter' => 'Penyaringan berdasarkan :filters memerlukan osu!supporter tag yang aktif',
            'not-found' => 'tidak ada hasil',
            'not-found-quote' => '... tidak, tidak ditemukan apa pun.',
            'filters' => [
                'general' => 'Umum',
                'mode' => 'Mode',
                'status' => 'Status',
                'genre' => 'Aliran',
                'language' => 'Bahasa',
                'extra' => 'Konten Ekstra',
                'rank' => 'Torehan Peringkat',
                'played' => 'Riwayat Permainan',
            ],
            'sorting' => [
                'title' => 'Judul',
                'artist' => 'Artis',
                'difficulty' => 'Tingkat Kesulitan',
                'favourites' => 'Jumlah Favorit',
                'updated' => 'Tanggal Pembaruan Terakhir',
                'ranked' => 'Tanggal Ranked',
                'rating' => 'Nilai Pengguna',
                'plays' => 'Jumlah Permainan',
                'relevance' => 'Relevansi',
                'nominations' => 'Jumlah Nominasi',
            ],
            'supporter_filter_quote' => [
                '_' => 'Penyaringan dengan :filters memerlukan :link aktif',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Tingkat kesulitan yang disarankan',
        'converts' => 'Sertakan beatmap yang dikonversi',
    ],
    'mode' => [
        'all' => 'Semua',
        'any' => 'Semua',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Semua',
        'approved' => 'Approved',
        'favourites' => 'Favorit',
        'graveyard' => 'Graveyard',
        'leaderboard' => 'Memiliki Leaderboard',
        'loved' => 'Loved',
        'mine' => 'Map Saya',
        'pending' => 'Pending & WIP',
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
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'MR' => 'Mirror',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
        'V2' => 'Score V2',
    ],
    'language' => [
        'any' => 'Semua',
        'english' => 'Inggris',
        'chinese' => 'Mandarin',
        'french' => 'Prancis',
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
        'X' => 'SS',
        'SH' => 'Silver S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
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
