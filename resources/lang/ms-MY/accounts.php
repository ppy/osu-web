<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'tetapan akaun',
        'username' => 'nama pengguna',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'set semula',
            'rules' => 'Pastikan avatarmu akur pada :link yang berlaku.<br/>Dengan kata lain, avatarmu mestilah <strong>sesuai untuk segala usia</strong> tanpa mengandung unsur apa pun yang tidak dibenarkan seperti cacian, hinaan, atau hal yang tidak senonoh.',
            'rules_link' => 'peraturan komuniti',
        ],

        'email' => [
            'new' => 'e-mel baharu',
            'new_confirmation' => 'pengesahan e-mel',
            'title' => 'E-mel',
            'locked' => [
                '_' => 'Sila hubungi akaun jika anda mahu emel anda dikemaskini.',
                'accounts' => 'akaun sokongan khidmat',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => '\'irc\' ',
            'title' => 'API Legasi',
        ],

        'password' => [
            'current' => 'Kata laluan semasa',
            'new' => 'kata laluan baharu',
            'new_confirmation' => 'pengesahan kata laluan',
            'title' => 'Kata laluan',
        ],

        'profile' => [
            'country' => 'negara',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Kelihatannya negara akaun anda tidak sempadan dengan negara petempatan anda. :update_link.",
                'update_link' => 'Kemaskini ke :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'kedudukan semasa',
                'user_interests' => 'minat',
                'user_occ' => 'pekerjaan',
                'user_twitter' => '',
                'user_website' => 'laman web',
            ],
        ],

        'signature' => [
            'title' => 'Tanda Tangan',
            'update' => 'kemas kini',
        ],
    ],

    'github_user' => [
        'info' => "Jika anda kontributor kepada osu! repositori sumber terbuka, menghubungkan akaun Github anda disini akan mengaitkan entri log perubahan dengan osu! profil anda. Akaun Github tanpa sejarah kontribusi kepada osu! tidak boleh dihubungkan.",
        'link' => 'Pautkan Akaun Github',
        'title' => 'GitHub',
        'unlink' => 'Nyahpautkan Akaun Github',

        'error' => [
            'already_linked' => 'Akaun Github ini telah dipautkan dengan pengguna lain.',
            'no_contribution' => 'Tidak boleh menghubungkan akaun Github tanpa sebarang sejarah kontribusi dalam repositori osu!.',
            'unverified_email' => 'Sila sahkan e-mel utama anda di Github, seterusnya pautkan akaun anda sekali lagi.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'terima notifikasi untuk masalah baru pada beatmap berkelayakan pada mod tersebut ',
        'beatmapset_disqualify' => 'terima notifikasi apabila beatmap bagi mod tersebut telah didisqualifikasi ',
        'comment_reply' => 'terima notifikasi untuk balasan pada komen anda',
        'title' => 'Notifications',
        'topic_auto_subscribe' => 'hidupkan notifikasi secara automatik pada topik forum baru yang anda cipta',

        'options' => [
            '_' => 'hantarkan pemberitahuan melalui',
            'beatmap_owner_change' => 'kesukaran tamu',
            'beatmapset:modding' => 'beatmap modding',
            'channel_message' => 'pesanan peribadi',
            'comment_new' => 'ulasan baharu',
            'forum_topic_reply' => 'balasan pada topik',
            'mail' => 'e-mel',
            'mapping' => 'pembuat beatmap',
            'push' => 'web',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'klien yang dibenarkan',
        'own_clients' => 'klien yang dimiliki',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'matikan peringatan untuk beatmap yang mengandungi kandungan eksplisit',
        'beatmapset_title_show_original' => 'paparkan metadata beatmap dalam bahasa aslinya',
        'title' => 'Pengaturan',

        'beatmapset_download' => [
            '_' => 'jenis lalai beatmap yang dimuat turun',
            'all' => 'dengan video (jika tersedia)',
            'direct' => 'buka melalui osu!direct',
            'no_video' => 'tanpa video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'kekunci',
        'mouse' => 'tetikus',
        'tablet' => 'tablet',
        'title' => 'Gaya Bermain',
        'touch' => 'layar sentuh',
    ],

    'privacy' => [
        'friends_only' => 'sekat pesanan peribadi dari orang yang tiada dalam senarai kawan kamu',
        'hide_online' => 'sembunyikan keberadaan dalam talian kamu',
        'title' => 'Privasi',
    ],

    'security' => [
        'current_session' => 'semasa',
        'end_session' => 'Akhiri Sesi',
        'end_session_confirmation' => 'Tindakan ini akan menamatkan sesi kamu pada peranti yang disangkutkan. Adakah kamu pasti?',
        'last_active' => 'Terakhir aktif:',
        'title' => 'Keselamatan',
        'web_sessions' => 'sesi web',
    ],

    'update_email' => [
        'update' => 'kemas kini',
    ],

    'update_password' => [
        'update' => 'kemas kini',
    ],

    'verification_completed' => [
        'text' => 'Kamu boleh tutup tab/tetingkap ini sekarang',
        'title' => 'Pengesahan selesai',
    ],

    'verification_invalid' => [
        'title' => 'Pautan pengesahan tidak sah atau sudah luput',
    ],
];
