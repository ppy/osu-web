<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute yang ditentukan tidak valid.',
    'not_negative' => ':attribute tidak bisa negatif.',
    'required' => ':attribute diwajibkan.',
    'too_long' => ':attribute melebihi batas maksimum - hanya bisa hingga :limit karakter.',
    'wrong_confirmation' => 'Konfirmasi tidak cocok.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Keterangan waktu telah ditentukan tetapi beatmap tidak ada.',
        'beatmapset_no_hype' => "Beatmap ini tidak dapat di-hype.",
        'hype_requires_null_beatmap' => 'Hype hanya dapat diberikan pada kolom diskusi Umum (Seluruh tingkat kesulitan).',
        'invalid_beatmap_id' => 'Tingkat kesulitan yang tidak valid ditentukan.',
        'invalid_beatmapset_id' => 'Beatmap yang tidak valid ditentukan.',
        'locked' => 'Diskusi dikunci.',

        'attributes' => [
            'message_type' => 'Tipe pesan',
            'timestamp' => 'Keterangan Waktu',
        ],

        'hype' => [
            'discussion_locked' => "Anda tidak dapat memberikan hype karena fitur diskusi untuk beatmap ini sedang dibekukan oleh moderator",
            'guest' => 'Silakan masuk untuk dapat memberikan hype.',
            'hyped' => 'Anda telah memberikan hype untuk beatmap ini.',
            'limit_exceeded' => 'Anda telah mempergunakan seluruh hype yang Anda miliki.',
            'not_hypeable' => 'Beatmap ini tidak dapat di-hype',
            'owner' => 'Anda tidak dapat memberikan hype pada beatmap milik sendiri.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Keterangan waktu yang ditentukan melebihi panjang beatmap.',
            'negative' => "Keterangan waktu tidak bisa bernilai negatif.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Topik diskusi ini terkunci.',
        'first_post' => 'Tidak dapat menghapus postingan awal.',

        'attributes' => [
            'message' => 'Pesan',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Anda tidak dapat membalas komentar yang sudah dihapus sebelumnya.',
        'top_only' => 'Tidak diperbolehkan menyemat balasan komentar.',

        'attributes' => [
            'message' => 'Isi pesan',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute yang ditentukan tidak valid.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Hanya dapat memilih permintaan fitur.',
            'not_enough_feature_votes' => 'Suara tidak cukup.',
        ],

        'poll_vote' => [
            'invalid' => 'Opsi yang ditentukan tidak valid.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Menghapus posting metadata beatmap tidak diizinkan.',
            'beatmapset_post_no_edit' => 'Menyunting posting metadata beatmap tidak diizinkan.',
            'first_post_no_delete' => 'Tidak dapat menghapus postingan awal',
            'missing_topic' => 'Postingan ini tidak memiliki topik',
            'only_quote' => 'Balasan Anda hanya berisi kutipan.',

            'attributes' => [
                'post_text' => 'Isi postingan',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Judul topik',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opsi ganda tidak diizinkan.',
            'grace_period_expired' => 'Tidak dapat menyunting sebuah jajak pendapat setelah melebihi :limit jam',
            'hiding_results_forever' => 'Suara pada polling yang tidak memiliki batasan akhir waktu tidak dapat dirahasiakan.',
            'invalid_max_options' => 'Pilihan per pengguna tidak boleh melebihi jumlah opsi yang tersedia.',
            'minimum_one_selection' => 'Diperlukan setidaknya satu opsi per pengguna.',
            'minimum_two_options' => 'Diperlukan setidaknya dua opsi',
            'too_many_options' => 'Jumlah maksimum opsi melebihi yang diizinkan.',

            'attributes' => [
                'title' => 'Judul pemungutan suara',
            ],
        ],

        'topic_vote' => [
            'required' => 'Pilih opsi saat memilih.',
            'too_many' => 'Jumlah pilihan Anda lebih banyak dari yang diizinkan.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Jumlah aplikasi OAuth melebihi batas maksimal.',
            'url' => 'Harap masukkan URL yang valid.',

            'attributes' => [
                'name' => 'Nama Aplikasi',
                'redirect' => 'Callback URL Aplikasi',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Nama pengguna tidak diperbolehkan untuk berada di dalam kata sandi.',
        'email_already_used' => 'Alamat email ini sudah digunakan sebelumnya.',
        'email_not_allowed' => 'Alamat email ini tidak diperbolehkan.',
        'invalid_country' => 'Negara tidak ada dalam basis data.',
        'invalid_discord' => 'Nama pengguna Discord tidak valid.',
        'invalid_email' => "Tampaknya bukan alamat email yang valid.",
        'invalid_twitter' => 'Nama pengguna Twitter tidak valid.',
        'too_short' => 'Kata sandi baru terlalu pendek.',
        'unknown_duplicate' => 'Nama pengguna atau alamat email ini sudah digunakan sebelumnya.',
        'username_available_in' => 'Nama pengguna ini akan tersedia untuk digunakan dalam :duration.',
        'username_available_soon' => 'Nama pengguna ini dapat digunakan sekarang!',
        'username_invalid_characters' => 'Nama pengguna yang diminta mengandung karakter yang tidak valid.',
        'username_in_use' => 'Nama pengguna sudah digunakan!',
        'username_locked' => 'Nama pengguna sudah digunakan!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Mohon gunakan garis bawah atau spasi, jangan keduanya!',
        'username_no_spaces' => "Nama pengguna tidak dapat dimulai atau diakhiri dengan spasi!",
        'username_not_allowed' => 'Pilihan nama pengguna ini tidak diizinkan.',
        'username_too_short' => 'Nama pengguna yang diminta terlalu pendek.',
        'username_too_long' => 'Nama pengguna yang diminta terlalu panjang.',
        'weak' => 'Kata sandi ini berada dalam daftar hitam.',
        'wrong_current_password' => 'Kata sandi saat ini salah.',
        'wrong_email_confirmation' => 'Konfirmasi email tidak cocok.',
        'wrong_password_confirmation' => 'Konfirmasi kata sandi tidak cocok.',
        'too_long' => 'Melebihi batas maksimum - hanya bisa hingga :limit karakter.',

        'attributes' => [
            'username' => 'Nama Pengguna',
            'user_email' => 'Alamat Email',
            'password' => 'Kata Sandi',
        ],

        'change_username' => [
            'restricted' => 'Anda tidak dapat mengganti nama pengguna ketika akun Anda sedang di-restrict.',
            'supporter_required' => [
                '_' => 'Anda harus menjadi :link untuk mengubah nama Anda!',
                'link_text' => 'osu!supporter',
            ],
            'username_is_same' => 'Ini nama penggunamu yang sekarang, bodoh!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Anda tidak dapat melaporkan beatmap yang berstatus Ranked',
        'reason_not_valid' => 'alasan :reason tidak sah untuk jenis laporan ini.',
        'self' => "Anda tidak dapat melaporkan diri Anda sendiri!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Jumlah',
                'cost' => 'Biaya',
            ],
        ],
    ],
];
