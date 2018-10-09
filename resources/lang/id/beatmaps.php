<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'discussion-posts' => [
        'store' => [
            'error' => 'Gagal menyimpan kiriman',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Gagal memperbarui pilihan',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'izinkan kudosu',
        'delete' => 'hapus',
        'deleted' => 'Dihapus oleh :editor :delete_time.',
        'deny_kudosu' => 'tolak kudosu',
        'edit' => 'sunting',
        'edited' => 'Terakhir disunting oleh :editor :update_time.',
        'kudosu_denied' => 'Perolehan kudosu ditolak.',
        'message_placeholder_deleted_beatmap' => 'Tingkat kesulitan ini telah dihapus sehingga diskusi lebih lanjut tidak lagi diperkenankan.',
        'message_type_select' => 'Pilih Jenis Komentar',
        'reply_notice' => 'Tekan enter untuk membalas.',
        'reply_placeholder' => 'Ketik balasan Anda di sini',
        'require-login' => 'Silakan masuk untuk posting atau membalas',
        'resolved' => 'Terselesaikan',
        'restore' => 'kembalikan',
        'title' => 'Diskusi',

        'collapse' => [
            'all-collapse' => 'Ciutkan semua',
            'all-expand' => 'Lebarkan semua',
        ],

        'empty' => [
            'empty' => 'Belum ada diskusi!',
            'hidden' => 'Tidak ada diskusi yang cocok dengan filter yang dipilih.',
        ],

        'message_hint' => [
            'in_general' => 'Topik-topik diskusi ini berlaku untuk keseluruhan mapset secara umum. Untuk membuka topik diskusi baru, mulai pesan Anda dengan keterangan waktu (cth: 00:12:345).',
            'in_timeline' => 'Topik-topik diskusi ini berlaku untuk masing-masing tingkat kesulitan secara spesifik. Untuk memulai topik diskusi baru, salin keterangan waktu dari editor disertai dengan komentar Anda (satu topik per keterangan waktu).',
        ],

        'message_placeholder' => [
            'general' => 'Ketik disini untuk posting ke General (:version)',
            'generalAll' => 'Ketik disini untuk posting ke General (Semua tingkat kesulitan)',
            'timeline' => 'Ketik disini untuk posting ke Timeline (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskualifikasi',
            'hype' => 'Hype!',
            'mapper_note' => 'Catatan',
            'nomination_reset' => 'Hilangkan Status Nominasi',
            'praise' => 'Pujian',
            'problem' => 'Masalah',
            'suggestion' => 'Saran',
        ],

        'mode' => [
            'events' => 'Riwayat',
            'general' => 'Umum :scope',
            'timeline' => 'Linimasa',
            'scopes' => [
                'general' => 'Tingkat kesulitan ini',
                'generalAll' => 'Semua tingkat kesulitan',
            ],
        ],

        'new' => [
            'timestamp' => 'Keterangan Waktu',
            'timestamp_missing' => 'Salin (ctrl+c) keterangan waktu yang spesifik dari editor dan tempelkan (ctrl+v) pada boks yang tersedia untuk menambahkan keterangan waktu!',
            'title' => 'Diskusi Baru',
        ],

        'show' => [
            'title' => ':title dibuat oleh :mapper',
        ],

        'sort' => [
            '_' => 'Sortir berdasarkan:',
            'created_at' => 'waktu pembuatan',
            'timeline' => 'linimasa',
            'updated_at' => 'pembaruan terakhir',
        ],

        'stats' => [
            'deleted' => 'Dihapus',
            'mapper_notes' => 'Catatan',
            'mine' => 'Milik Saya',
            'pending' => 'Tertunda',
            'praises' => 'Pujian',
            'resolved' => 'Terselesaikan',
            'total' => 'Semua',
        ],

        'status-messages' => [
            'approved' => 'Beatmap ini telah di-Approve pada :date!',
            'graveyard' => "Beatmap ini belum diperbarui sejak :date dan kemungkinan besar telah diabaikan oleh pembuatnya...",
            'loved' => 'Beatmap ini telah ditambahkan pada kategori \'Loved\' pada :date!',
            'ranked' => 'Beatmap ini telah di-Rank pada :date!',
            'wip' => 'Catatan: Beatmap ini ditandai sebagai \'dalam pengerjaan\' oleh pembuat beatmap.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Telah di-Hype!',
        'confirm' => "Apakah Anda yakin? Dengan ini Anda akan memberikan 1 hype kepada beatmap ini dari :n hype yang Anda miliki saat ini. Aksi ini tidak dapat diurungkan.",
        'explanation' => 'Berikan hype kepada beatmap ini agar beatmap ini dapat lebih layak dinominasikan dan dapat segera di-rank!',
        'explanation_guest' => 'Masuk dan berikan hype kepada beatmap ini agar beatmap ini dapat lebih layak dinominasikan dan dapat segera di-rank!',
        'new_time' => "Anda akan mendapatkan hype tambahan dalam :new_time.",
        'remaining' => 'Anda memiliki :remaining hype tersisa.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Tinggalkan Umpan Balik',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Alasan diskualifikasi?',
        'disqualified_at' => 'Didiskualifikasi :time_ago (:reason).',
        'disqualified_no_reason' => 'tidak ada alasan yang diberikan',
        'disqualify' => 'Diskualifikasi',
        'incorrect_state' => 'Ditemukan kesalahan saat melakukan tindakan ini, silakan muat ulang laman.',
        'love' => 'Love',
        'love_confirm' => 'Love beatmap ini?',
        'nominate' => 'Nominasi',
        'nominate_confirm' => 'Nominasikan beatmap ini?',
        'nominated_by' => 'dinominasikan oleh :users',
        'qualified' => 'Diperkirakan akan berstatus Ranked pada :date jika tidak ada masalah yang ditemukan.',
        'qualified_soon' => 'Diperkirakan akan segera berstatus Ranked jika tidak ada masalah yang ditemukan.',
        'required_text' => 'Nominasi: :current/:required',
        'reset_message_deleted' => 'dihapus',
        'title' => 'Status Nominasi',
        'unresolved_issues' => 'Masih ada masalah yang belum terselesaikan yang harus ditangani terlebih dahulu.',

        'reset_at' => [
            'nomination_reset' => 'Proses nominasi diulang :time_ago oleh :user akibat ditemukannya masalah baru :discussion (:message).',
            'disqualify' => 'Didiskualifikasi :time_ago oleh :user akibat ditemukannya masalah baru :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Apakah kamu yakin? Memposting masalah baru akan mengulang proses nominasi.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'ketik kata kunci...',
            'login_required' => 'Masuk untuk mencari.',
            'options' => 'Opsi Pencarian Lebih Lanjut',
            'supporter_filter' => 'Penyaringan berdasarkan :filters memerlukan osu!supporter tag yang aktif',
            'not-found' => 'tidak ada hasil',
            'not-found-quote' => '... tidak, tidak ditemukan apa pun.',
            'filters' => [
                'general' => 'Umum',
                'mode' => 'Mode',
                'status' => 'Kategori',
                'genre' => 'Aliran',
                'language' => 'Bahasa',
                'extra' => 'tambahan',
                'rank' => 'Peringkat yang Diraih',
                'played' => 'Telah Dimainkan',
            ],
            'sorting' => [
                'title' => 'judul',
                'artist' => 'artis',
                'difficulty' => 'tingkat kesulitan',
                'updated' => 'terbaru',
                'ranked' => 'ranked',
                'rating' => 'penilaian',
                'plays' => 'jumlah dimainkan',
                'relevance' => 'relevansi',
                'nominations' => 'nominasi',
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
        'any' => 'Semua',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Semua',
        'ranked-approved' => 'Ranked & Approved',
        'approved' => 'Approved',
        'qualified' => 'Qualified',
        'loved' => 'Loved',
        'faves' => 'Favorit',
        'pending' => 'Pending & WIP',
        'graveyard' => 'Graveyard',
        'my-maps' => 'Map Saya',
    ],
    'genre' => [
        'any' => 'Semua',
        'unspecified' => 'Tidak Terdefinisi',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Lainnya',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
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
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
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
        'instrumental' => 'Instrumental',
        'other' => 'Lainnya',
    ],
    'played' => [
        'any' => 'Semua',
        'played' => 'Pernah Dimainkan',
        'unplayed' => 'Belum Dimainkan',
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
];
