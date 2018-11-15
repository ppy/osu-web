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
    'edit' => [
        'title' => 'Pengaturan <strong>Akun</strong>',
        'title_compact' => 'pengaturan',
        'username' => 'nama pengguna',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'email saat ini',
            'new' => 'email baru',
            'new_confirmation' => 'konfirmasi email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'kata sandi saat ini',
            'new' => 'kata sandi baru',
            'new_confirmation' => 'konfirmasi kata sandi',
            'title' => 'Kata Sandi',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_from' => 'lokasi saat ini',
                'user_interests' => 'minat',
                'user_msnm' => 'skype',
                'user_occ' => 'pekerjaan',
                'user_twitter' => 'twitter',
                'user_website' => 'situs web',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => 'Tanda Tangan',
            'update' => 'perbarui',
        ],
    ],

    'update_email' => [
        'email_subject' => 'konfirmasi perubahan email osu!',
        'update' => 'perbarui',
    ],

    'update_password' => [
        'email_subject' => 'konfirmasi perubahan kata sandi osu!',
        'update' => 'perbarui',
    ],

    'playstyles' => [
        'title' => 'Gaya Bermain',
        'mouse' => 'mouse',
        'keyboard' => 'keyboard',
        'tablet' => 'tablet',
        'touch' => 'layar sentuh',
    ],

    'privacy' => [
        'title' => 'Kebijakan Privasi',
        'friends_only' => 'Blokir pesan pribadi dari orang yang tidak ada dalam daftar teman Anda',
        'hide_online' => 'sembunyikan keberadaan online Anda',
    ],

    'security' => [
        'current_session' => 'saat ini',
        'end_session' => 'Akhisi Sesi',
        'end_session_confirmation' => 'Aksi ini akan langsung mengakhiri sesi di perangkat Anda. Apa anda yakin?',
        'last_active' => 'Terakhir aktif:',
        'title' => 'Keamanan',
        'web_sessions' => 'web session',
    ],
];
