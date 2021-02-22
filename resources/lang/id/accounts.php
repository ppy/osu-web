<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'pengaturan',
        'username' => 'nama pengguna',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Pastikan avatar Anda mematuhi :link yang berlaku.<br/>  Dengan kata lain, avatar Anda harus <strong>cocok untuk segala usia</strong> tanpa mengandung unsur-unsur yang tidak dibenarkan seperti cacian, hinaan, atau konten-konten yang bersifat sugestif.',
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
                'user_discord' => '',
                'user_from' => 'lokasi saat ini',
                'user_interests' => 'minat',
                'user_msnm' => '',
                'user_occ' => 'pekerjaan',
                'user_twitter' => '',
                'user_website' => 'situs web',
            ],
        ],

        'signature' => [
            'title' => 'Tanda Tangan',
            'update' => 'perbarui',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'terima notifikasi pada saat terdapat masalah baru pada beatmap yang berstatus Qualified pada mode',
        'beatmapset_disqualify' => 'terima notifikasi pada saat terdapat beatmap yang terdiskualifikasi pada mode',
        'comment_reply' => 'terima notifikasi pada saat terdapat balasan baru pada komentar yang Anda kirim',
        'title' => 'Notifikasi',
        'topic_auto_subscribe' => 'hidupkan notifikasi secara otomatis di topik forum baru yang Anda buat',

        'options' => [
            '_' => 'kirimkan notifikasi melalui',
            'beatmapset:modding' => 'modding beatmap',
            'channel_message' => 'pesan pribadi',
            'comment_new' => 'komentar baru',
            'forum_topic_reply' => 'balasan pada topik',
            'mail' => 'email',
            'push' => 'web',
            'user_achievement_unlock' => 'terbukanya medali baru',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'klien yang memiliki akses',
        'own_clients' => 'klien yang Anda miliki',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'nonaktifkan peringatan untuk beatmap-beatmap yang mengandung konten eksplisit',
        'beatmapset_title_show_original' => 'tampilkan metadata beatmap dalam bahasa aslinya',
        'title' => 'Pengaturan',

        'beatmapset_download' => [
            '_' => 'tipe pengunduhan beatmap default',
            'all' => 'dengan video (apabila tersedia)',
            'direct' => 'buka melalui osu!direct',
            'no_video' => 'tanpa video',
        ],
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
        'text' => 'Anda dapat menutup laman ini sekarang',
        'title' => 'Verifikasi selesai',
    ],

    'verification_invalid' => [
        'title' => 'Tautan verifikasi tidak valid atau kedaluwarsa',
    ],
];
