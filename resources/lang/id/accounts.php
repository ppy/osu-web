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
    'edit' => [
        'title_compact' => 'pengaturan',
        'username' => 'nama pengguna',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Pastikan avatar Anda mematuhi :link.<br/> Hal ini berarti konten harus <strong>cocok untuk segala usia</strong>. mis. tidak menampilkan ketelanjangan, kata-kata kotor atau sugestif.',
            'rules_link' => 'peraturan komunitas',
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
                'user_discord' => 'discord',
                'user_from' => 'lokasi saat ini',
                'user_interests' => 'minat',
                'user_msnm' => 'skype',
                'user_occ' => 'pekerjaan',
                'user_twitter' => 'twitter',
                'user_website' => 'situs web',
            ],
        ],

        'signature' => [
            'title' => 'Tanda Tangan',
            'update' => 'perbarui',
        ],
    ],

    'notifications' => [
        'title' => 'Notifikasi',
        'topic_auto_subscribe' => 'hidupkan notifikasi secara otomatis di topik forum baru yang Anda buat',
        'beatmapset_discussion_qualified_problem' => 'terima pemberitahuan untuk masalah baru pada qualified beatmap dari mode berikut',

        'mail' => [
            '_' => 'terima pemberitahuan email tentang',
            'beatmapset:modding' => 'modding beatmap',
            'forum_topic_reply' => 'balasan pada topik',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'klien yang memiliki akses',
        'own_clients' => 'klien yang dimiliki',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'keyboard',
        'mouse' => 'mouse',
        'tablet' => 'tablet',
        'title' => 'Gaya Bermain',
        'touch' => 'layar sentuh',
    ],

    'privacy' => [
        'friends_only' => 'Blokir pesan pribadi dari orang yang tidak ada dalam daftar teman Anda',
        'hide_online' => 'sembunyikan keberadaan online Anda',
        'title' => 'Kebijakan Privasi',
    ],

    'security' => [
        'current_session' => 'saat ini',
        'end_session' => 'Akhiri Sesi',
        'end_session_confirmation' => 'Aksi ini akan langsung mengakhiri sesi anda di perangkat tersebut. Apakah anda yakin?',
        'last_active' => 'Terakhir aktif:',
        'title' => 'Keamanan',
        'web_sessions' => 'web session',
    ],

    'update_email' => [
        'update' => 'perbarui',
    ],

    'update_password' => [
        'update' => 'perbarui',
    ],

    'verification_completed' => [
        'text' => 'Kamu dapat menutup laman ini sekarang',
        'title' => 'Verifikasi selesai',
    ],

    'verification_invalid' => [
        'title' => 'Tautan verifikasi tidak valid atau kedaluwarsa',
    ],
];
