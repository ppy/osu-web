<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'pengaturan akun',
        'username' => 'nama pengguna',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'atur ulang',
            'rules' => 'Pastikan avatarmu tunduk pada :link yang berlaku.<br/>Hal ini berarti avatar ini harus <strong>cocok untuk segala usia</strong> tanpa unsur apa pun yang tidak dibenarkan, mis. konten yang berketelanjangan, menyinggung, atau sugestif.',
            'rules_link' => 'Pertimbangan konten visual',
        ],

        'email' => [
            'new' => 'email baru',
            'new_confirmation' => 'konfirmasi email',
            'title' => 'Email',
            'locked' => [
                '_' => 'Silakan hubungi :accounts apabila kamu perlu memperbarui alamat emailmu.',
                'accounts' => 'tim dukungan akun',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API Lawas',
        ],

        'password' => [
            'current' => 'kata sandi saat ini',
            'new' => 'kata sandi baru',
            'new_confirmation' => 'konfirmasi kata sandi',
            'title' => 'Kata Sandi',
        ],

        'profile' => [
            'country' => 'negara',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Sepertinya negara akunmu tidak sesuai dengan negara tempat kamu tinggal. :update_link.",
                'update_link' => 'Perbarui ke :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'lokasi saat ini',
                'user_interests' => 'minat',
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

    'github_user' => [
        'info' => "Apabila kamu adalah kontributor repositori open-source osu!, kamu dapat menautkan akun GitHub kamu di sini untuk menghubungkan entri riwayat perubahanmu dengan profil osu! kamu. Akun GitHub yang tidak memiliki riwayat kontribusi terhadap osu! tidak dapat ditautkan.",
        'link' => 'Tautkan Akun GitHub',
        'title' => 'GitHub',
        'unlink' => 'Lepas Tautan Akun GitHub',

        'error' => [
            'already_linked' => 'Akun GitHub ini telah terhubung ke pengguna lain.',
            'no_contribution' => 'Akun GitHub yang tidak memiliki riwayat kontribusi pada repositori osu! tidak dapat ditautkan.',
            'unverified_email' => 'Silakan verifikasi email utama kamu di GitHub, lalu cobalah untuk menghubungkan akunmu kembali.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'terima notifikasi pada saat terdapat masalah baru pada beatmap Qualified di mode',
        'beatmapset_disqualify' => 'terima notifikasi pada saat terdapat beatmap yang terdiskualifikasi pada mode',
        'comment_reply' => 'terima notifikasi untuk balasan baru pada komentar yang kamu tulis',
        'news_post' => 'terima notifikasi untuk postingan berita yang berkaitan dengan',
        'title' => 'Notifikasi',
        'topic_auto_subscribe' => 'aktifkan notifikasi secara otomatis bagi topik forum baru yang kamu buat atau balas',

        'options' => [
            '_' => 'opsi pengiriman',
            'beatmap_owner_change' => 'tingkat kesulitan tamu',
            'beatmapset:modding' => 'modding',
            'channel_message' => 'pesan pribadi',
            'channel_team' => 'pesan percakapan tim',
            'comment_new' => 'komentar baru',
            'forum_topic_reply' => 'balasan topik',
            'mail' => 'email',
            'mapping' => 'mapper',
            'news_post' => 'postingan berita',
            'push' => 'push (web)',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'klien yang terizin',
        'own_clients' => 'klien yang kamu miliki',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_anime_cover' => '',
        'beatmapset_show_nsfw' => 'sembunyikan peringatan untuk konten eksplisit pada beatmap',
        'beatmapset_title_show_original' => 'tampilkan metadata beatmap dalam bahasa aslinya',
        'title' => 'Pengaturan',

        'beatmapset_download' => [
            '_' => 'jenis unduhan beatmap bawaan',
            'all' => 'dengan video (apabila tersedia)',
            'direct' => 'buka di osu!direct',
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
        'friends_only' => 'blokir pesan pribadi dari pengguna yang tidak berada dalam daftar temanmu',
        'hide_online' => 'sembunyikan status onlinemu',
        'hide_online_info' => 'pengaturan ini akan terhubung ke mode "tampil offline" di osu!lazer',
        'title' => 'Privasi',
    ],

    'security' => [
        'current_session' => 'saat ini',
        'end_session' => 'Akhiri Sesi',
        'end_session_confirmation' => 'Tindakan ini akan mengakhiri sesimu pada perangkat yang bersangkutan dengan segera. Apakah kamu yakin?',
        'last_active' => 'Terakhir aktif:',
        'title' => 'Keamanan',
        'web_sessions' => 'sesi web',
    ],

    'update_email' => [
        'update' => 'perbarui',
    ],

    'update_password' => [
        'update' => 'perbarui',
    ],

    'user_totp' => [
        'title' => 'Apl. Autentikator',
        'usage_note' => 'Gunakan aplikasi autentikator untuk memverifikasi akun sebagai pengganti verifikasi via email. Verifikasi email akan tetap tersedia sebagai metode cadangan.',

        'button' => [
            'remove' => 'Hapus',
            'setup' => 'Tambah Aplikasi Autentikator',
        ],
        'status' => [
            'label' => 'status',
            'not_set' => 'Belum diatur',
            'set' => 'Telah diatur',
        ],
    ],

    'verification_completed' => [
        'text' => 'Kamu dapat menutup tab/jendela ini sekarang',
        'title' => 'Verifikasi selesai',
    ],

    'verification_invalid' => [
        'title' => 'Tautan verifikasi tidak valid atau telah kedaluwarsa',
    ],
];
