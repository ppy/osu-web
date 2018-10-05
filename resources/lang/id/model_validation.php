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
    'not_negative' => ':attribute tidak bisa negatif.',
    'required' => ':attribute diwajibkan.',
    'too_long' => ':attribute melebihi batas maksimum - hanya bisa hingga :limit karakter.',
    'wrong_confirmation' => 'Konfirmasi tidak cocok.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Diskusi terkunci',
        'first_post' => 'Tidak dapat menghapus postingan awal.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Keterangan waktu telah ditentukan tetapi beatmap tidak ada.',
        'beatmapset_no_hype' => "Beatmap tidak dapat dihype.",
        'hype_requires_null_beatmap' => 'Hype harus dilakukan di bagian General (All difficulties).',
        'invalid_beatmap_id' => 'Tingkat kesulitan yang tidak valid ditentukan.',
        'invalid_beatmapset_id' => 'Beatmap yang tidak valid ditentukan.',
        'locked' => 'Diskusi dikunci.',

        'hype' => [
            'guest' => 'Silakan masuk untuk dapat memberikan hype.',
            'hyped' => 'Anda telah memberikan hype untuk beatmap ini.',
            'limit_exceeded' => 'Anda telah menggunakan semua hype Anda.',
            'not_hypeable' => 'Beatmap ini tidak dapat dihype.',
            'owner' => 'Tidak dapat memberikan hype pada beatmap anda sendiri.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Keterangan waktu yang ditentukan melebihi panjang beatmap.',
            'negative' => "Keterangan waktu tidak bisa bernilai negatif.",
        ],
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
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opsi ganda tidak diizinkan.',
            'invalid_max_options' => 'Pilihan per pengguna tidak boleh melebihi jumlah opsi yang tersedia.',
            'minimum_one_selection' => 'Diperlukan setidaknya satu opsi per pengguna.',
            'minimum_two_options' => 'Diperlukan setidaknya dua opsi',
            'too_many_options' => 'Jumlah maksimum opsi melebihi yang diizinkan.',
        ],

        'topic_vote' => [
            'required' => 'Pilih opsi saat memilih.',
            'too_many' => 'Jumlah pilihan Anda lebih banyak dari yang diizinkan.',
        ],
    ],

    'user' => [
        'contains_username' => 'Nama pengguna tidak diperbolehkan untuk berada di dalam kata sandi.',
        'email_already_used' => 'Alamat email sudah digunakan.',
        'invalid_country' => 'Negara tidak ada dalam basis data.',
        'invalid_discord' => 'Nama pengguna Discord tidak valid.',
        'invalid_email' => "Tampaknya bukan alamat email yang valid.",
        'too_short' => 'Kata sandi baru terlalu pendek.',
        'unknown_duplicate' => 'Nama pengguna atau alamat email sudah digunakan.',
        'username_available_in' => 'Nama pengguna ini akan tersedia untuk digunakan dalam :duration.',
        'username_available_soon' => 'Nama pengguna ini dapat digunakan sekarang!',
        'username_invalid_characters' => 'Nama pengguna yang diminta mengandung karakter yang tidak valid.',
        'username_in_use' => 'Nama pengguna sudah digunakan!',
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

        'change_username' => [
            'supporter_required' => [
                '_' => 'Anda harus menjadi :link untuk mengubah nama Anda!',
                'link_text' => 'osu!supporter',
            ],
            'username_is_same' => 'Ini nama penggunamu yang sekarang, bodoh!',
        ],
    ],
];
