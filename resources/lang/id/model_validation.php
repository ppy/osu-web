<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute yang ditentukan tidak valid.',
    'not_negative' => ':attribute tidak boleh bernilai negatif.',
    'required' => ':attribute diwajibkan.',
    'too_long' => ':attribute melebihi batas maksimum - hanya bisa hingga :limit karakter.',
    'url' => 'Mohon masukkan URL yang valid.',
    'wrong_confirmation' => 'Konfirmasi tidak cocok.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Keterangan waktu ditentukan, namun tingkat beatmap tidak ada.',
        'beatmapset_no_hype' => "Beatmap ini tidak bisa di-hype.",
        'hype_requires_null_beatmap' => 'Hype harus diberikan pada bagian Umum (Semua tingkat kesulitan).',
        'invalid_beatmap_id' => 'Tingkat kesulitan yang ditentukan tidak valid.',
        'invalid_beatmapset_id' => 'Beatmap yang ditentukan tidak valid.',
        'locked' => 'Diskusi dikunci.',

        'attributes' => [
            'message_type' => 'Tipe pesan',
            'timestamp' => 'Keterangan Waktu',
        ],

        'hype' => [
            'discussion_locked' => "Beatmap ini sedang dikunci untuk diskusi lebih lanjut dan tidak bisa di-hype.",
            'guest' => 'Kamu harus masuk untuk memberikan hype.',
            'hyped' => 'Kamu sudah memberikan hype kepada beatmap ini.',
            'limit_exceeded' => 'Kamu sudah menggunakan semua hype yang kamu miliki.',
            'not_hypeable' => 'Beatmap ini tidak bisa di-hype',
            'owner' => 'Kamu tidak bisa memberikan hype kepada beatmap milik sendiri.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Keterangan waktu yang ditentukan berada di luar durasi beatmap.',
            'negative' => "Keterangan waktu tidak boleh bernilai negatif.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Topik diskusi ini dikunci.',
        'first_post' => 'Postingan pembuka tidak bisa dihapus.',

        'attributes' => [
            'message' => 'Pesan',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Komentar yang dihapus tidak bisa dibalas.',
        'top_only' => 'Komentar balasan tidak bisa disematkan.',

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
            'invalid' => 'Pilihan yang ditentukan tidak valid.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Postingan metadata beatmap tidak diperkenankan untuk dihapus.',
            'beatmapset_post_no_edit' => 'Postingan metadata beatmap tidak diperkenankan untuk disunting.',
            'first_post_no_delete' => 'Postingan pembuka tidak bisa dihapus',
            'missing_topic' => 'Postingan ini tidak memiliki topik',
            'only_quote' => 'Balasan kamu hanya berisi kutipan.',

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
            'duplicate_options' => 'Pilihan berganda tidak diizinkan.',
            'grace_period_expired' => 'Jajak pendapat tidak lagi bisa disunting setelah :limit jam.',
            'hiding_results_forever' => 'Hasil jajak pendapat yang tidak pernah berakhir tidak bisa dirahasiakan.',
            'invalid_max_options' => 'Pilihan per pengguna tidak boleh melebihi jumlah opsi yang tersedia.',
            'minimum_one_selection' => 'Diperlukan setidaknya satu opsi per pengguna.',
            'minimum_two_options' => 'Kamu harus menyertakan setidaknya dua pilihan.',
            'too_many_options' => 'Jumlah pilihan yang diizinkan melebihi batas.',

            'attributes' => [
                'title' => 'Judul jajak pendapat',
            ],
        ],

        'topic_vote' => [
            'required' => 'Pilih opsi saat memilih.',
            'too_many' => 'Jumlah pilihan yang dipilih lebih banyak dari yang diizinkan.',
        ],
    ],

    'legacy_api_key' => [
        'exists' => 'Hanya satu kunci API yang disediakan per pengguna untuk saat ini.',

        'attributes' => [
            'api_key' => 'kunci api',
            'app_name' => 'nama aplikasi',
            'app_url' => 'url aplikasi',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Jumlah aplikasi OAuth melebihi batas maksimal.',
            'url' => 'Silakan masukkan URL yang valid.',

            'attributes' => [
                'name' => 'Nama Aplikasi',
                'redirect' => 'URL Callback Aplikasi',
            ],
        ],
    ],

    'team' => [
        'invalid_characters' => ':attribute ini mengandung karakter yang tidak valid.',
        'used' => 'Pilihan :attribute ini sudah digunakan.',
        'word_not_allowed' => 'Pilihan :attribute ini tidak diizinkan.',

        'attributes' => [
            'default_ruleset_id' => 'Ruleset bawaan',
            'is_open' => 'Pendaftaran anggota tim',
            'name' => 'Nama',
            'short_name' => 'Nama pendek',
            'url' => 'URL',
        ],
    ],

    'user' => [
        'contains_username' => 'Kata sandi tidak boleh mengandung nama pengguna.',
        'email_already_used' => 'Alamat email ini sudah digunakan.',
        'email_not_allowed' => 'Alamat email ini tidak diizinkan.',
        'invalid_country' => 'Negara tidak terdapat dalam basis data.',
        'invalid_discord' => 'Nama pengguna Discord tidak valid.',
        'invalid_email' => "Alamat email ini sepertinya tidak valid.",
        'invalid_twitter' => 'Nama pengguna Twitter tidak valid.',
        'too_short' => 'Kata sandi baru terlalu pendek.',
        'unknown_duplicate' => 'Nama pengguna atau alamat email ini sudah digunakan.',
        'username_available_in' => 'Nama pengguna ini akan tersedia untuk digunakan dalam :duration.',
        'username_available_soon' => 'Nama pengguna ini akan segera tersedia untuk digunakan!',
        'username_invalid_characters' => 'Nama pengguna yang diminta mengandung karakter yang tidak valid.',
        'username_in_use' => 'Nama pengguna ini sudah digunakan!',
        'username_locked' => 'Nama pengguna ini sudah digunakan!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Mohon gunakan garis bawah atau spasi, jangan keduanya!',
        'username_no_spaces' => "Nama pengguna tidak boleh dimulai atau diakhiri dengan spasi!",
        'username_not_allowed' => 'Pilihan nama pengguna ini tidak diizinkan.',
        'username_too_short' => 'Nama pengguna yang diminta terlalu pendek.',
        'username_too_long' => 'Nama pengguna yang diminta terlalu panjang.',
        'weak' => 'Kata sandi ini berada dalam daftar hitam.',
        'wrong_current_password' => 'Kata sandi saat ini salah.',
        'wrong_email_confirmation' => 'Alamat email tidak cocok.',
        'wrong_password_confirmation' => 'Kata sandi tidak cocok.',
        'too_long' => 'Melebihi batas maksimum - hanya bisa hingga :limit karakter.',

        'attributes' => [
            'username' => 'Nama pengguna',
            'user_email' => 'Alamat email',
            'password' => 'Kata sandi',
        ],

        'change_username' => [
            'restricted' => 'Kamu tidak bisa mengubah nama pengguna pada saat akunmu sedang di-restrict.',
            'supporter_required' => [
                '_' => 'Kamu harus pernah :link untuk mengubah nama penggunamu!',
                'link_text' => 'menjadi osu!supporter',
            ],
            'username_is_same' => 'Ini adalah nama penggunamu yang sekarang, duh!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Beatmap yang berstatus Ranked tidak bisa dilaporkan',
        'not_in_channel' => 'Kamu tidak berada dalam kanal percakapan ini.',
        'in_team' => 'Kamu adalah anggota tim ini.',
        'reason_not_valid' => ':reason bukan alasan yang valid untuk jenis laporan ini.',
        'self' => "Kamu tidak bisa melaporkan dirimu sendiri!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Jumlah',
                'cost' => 'Harga',
            ],
        ],
    ],
];
