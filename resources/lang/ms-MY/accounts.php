<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'tetapan akaun',
        'username' => 'nama pengguna',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'tetap semula',
            'rules' => 'Sila pastikan avatar anda akur pada :link.<br/>Hal ini bermakna avatar anda mesti <strong>sesuai untuk penglihatan umum,</strong> iaitu senonoh serta tidak menyinggung.',
            'rules_link' => 'Pertimbangan kandungan tampak',
        ],

        'email' => [
            'new' => 'e-mel baharu',
            'new_confirmation' => 'pengesahan e-mel',
            'title' => 'E-mel',
            'locked' => [
                '_' => 'Sila hubungi :accounts sekiranya anda perlu mengemas kini e-mel anda.',
                'accounts' => 'pasukan sokongan akaun',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
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
                '_' => "Nampaknya negara akaun anda tidak sepadan dengan negara mastautin anda. :update_link.",
                'update_link' => 'Kemas kini ke :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'tempat semasa',
                'user_interests' => 'minat',
                'user_occ' => 'pekerjaan',
                'user_twitter' => '',
                'user_website' => 'laman sesawang',
            ],
        ],

        'signature' => [
            'title' => 'Tandatangan',
            'update' => 'kemas kini',
        ],
    ],

    'github_user' => [
        'info' => "Sekiranya anda penyumbang kepada gedung-gedung sumber terbuka osu!, anda akan mengaitkan entri log perubahan anda dengan profil osu! anda jika anda memaut akaun GitHub anda ke sini. Akaun GitHub tanpa sejarah sumbangan kepada osu! tidak boleh dipaut.",
        'link' => 'Pautkan Akaun Github',
        'title' => 'GitHub',
        'unlink' => 'Nyahpautkan Akaun Github',

        'error' => [
            'already_linked' => 'Akaun Github ini telah dipautkan dengan pengguna lain.',
            'no_contribution' => 'Tidak boleh pautkan akaun Github tanpa sejarah sumbangan dalam gedung osu!.',
            'unverified_email' => 'Sila sahkan e-mel utama anda di GitHub kemudian cuba pautkan akaun anda sekali lagi.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'terima pemberitahuan masalah baharu pada peta rentak layak untuk mod berikut',
        'beatmapset_disqualify' => 'terima pemberitahuan ketika peta rentak mod berikut tersingkir',
        'comment_reply' => 'terima pemberitahuan untuk balasan pada komen',
        'title' => 'Pemberitahuan',
        'topic_auto_subscribe' => 'upayakan pemberitahuan secara automatik pada tajuk forum baharu yang anda cipta atau balas',

        'options' => [
            '_' => 'hantarkan pemberitahuan melalui',
            'beatmap_owner_change' => 'kesukaran tamu',
            'beatmapset:modding' => 'penyelarasan peta rentak',
            'channel_message' => 'pesanan bualan peribadi',
            'channel_team' => 'pesanan bualan pasukan',
            'comment_new' => 'komen baharu',
            'forum_topic_reply' => 'balasan tajuk',
            'mail' => 'e-mel',
            'mapping' => 'pemeta rentak',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'pelanggan berizin',
        'own_clients' => 'pelanggan sendiri',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'sorok amaran untuk kandungan tidak senonoh dalam peta rentak',
        'beatmapset_title_show_original' => 'paparkan metadata peta rentak dalam bahasa asli',
        'title' => 'Pilihan',

        'beatmapset_download' => [
            '_' => 'jenis pemuatan turun peta rentak asal',
            'all' => 'dengan video ketika tersedia',
            'direct' => 'buka di osu!direct',
            'no_video' => 'tanpa video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'kekunci',
        'mouse' => 'tetikus',
        'tablet' => 'tablet',
        'title' => 'Gaya Main',
        'touch' => 'sentuhan',
    ],

    'privacy' => [
        'friends_only' => 'sekat pesanan peribadi daripada orang yang tiada pada senarai kawan',
        'hide_online' => 'sorok kehadiran dalam talian',
        'hide_online_info' => '',
        'title' => 'Kebersendirian',
    ],

    'security' => [
        'current_session' => 'semasa',
        'end_session' => 'Akhiri Sesi',
        'end_session_confirmation' => 'Tindakan ini akan langsung menamatkan sesi anda pada peranti itu. Adakah anda pasti?',
        'last_active' => 'Kegiatan terkini:',
        'title' => 'Keselamatan',
        'web_sessions' => 'sesi sesawang',
    ],

    'update_email' => [
        'update' => 'kemas kini',
    ],

    'update_password' => [
        'update' => 'kemas kini',
    ],

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'Anda kini boleh menutup tab/tetingkap ini',
        'title' => 'Pengesahan selesai',
    ],

    'verification_invalid' => [
        'title' => 'Pautan pengesahan tidak sah atau luput',
    ],
];
