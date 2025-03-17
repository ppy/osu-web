<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Apa kata main osu! pula?',
    'require_login' => 'Sila daftar masuk untuk teruskan.',
    'require_verification' => 'Sila sahkan untuk teruskan.',
    'restricted' => "Tidak boleh dilakukan ketika dihadkan.",
    'silenced' => "Tidak boleh dilakukan ketika didiamkan.",
    'unauthorized' => 'Capaian ditolak.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Gembaran tidak boleh dibuat asal.',
            'has_reply' => 'Perbincangan berbalas tidak boleh dipadam',
        ],
        'nominate' => [
            'exhausted' => 'Anda telah mencapai had pencalonan anda buat hari ini. Sila cuba lagi esok.',
            'incorrect_state' => 'Terdapat ralat ketika menjalankan tindakan itu. Sila segar semula halaman.',
            'owner' => "Peta rentak sendiri tidak boleh dicalonkan.",
            'set_metadata' => 'Anda mesti menetapkan genre dan bahasa terlebih dahulu sebelum pencalonan.',
        ],
        'resolve' => [
            'not_owner' => 'Hanya pemula bebenang dan pemilik peta rentak boleh menyelesaikan perbincangan.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Hanya pencipta peta rentak atau ahli pencalon/NAT boleh menghantar catatan pemeta.',
        ],

        'vote' => [
            'bot' => "Anda tidak boleh mengundi pada perbincangan buatan bot",
            'limit_exceeded' => 'Sila tunggu sebentar sebelum mengundi lagi',
            'owner' => "Tidak dapat mengundi perbincangan sendiri.",
            'wrong_beatmapset_state' => 'Anda boleh mengundi pada perbincangan tentang peta rentak tergantung sahaja.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Anda hanya boleh memadam hantaran sendiri.',
            'resolved' => 'Anda tidak boleh memadam hantaran perbincangan yang diselesaikan.',
            'system_generated' => 'Hantaran janaan automatik tidak boleh dipadam.',
        ],

        'edit' => [
            'not_owner' => 'Hanya penghantar boleh menyunting hantaran.',
            'resolved' => 'Anda tidak boleh menyunting hantaran perbincangan yang diselesaikan.',
            'system_generated' => 'Hantaran janaan automatik tidak boleh disunting.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Peta rentak ini dikunci dari perbincangan.',

        'metadata' => [
            'nominated' => 'Anda tidak boleh mengubah metadata peta yang dicalonkan. Hubungi ahli pencalon or NAT sekiranya anda berasa bahawa tetapan peta ini tidak betul.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => 'Anda mesti mencapai markah pada peta rentak untuk menambahkan tag.',
        ],
    ],

    'chat' => [
        'blocked' => 'Pengguna yang menyekat atau disekat anda tidak boleh dikirim pesanan.',
        'friends_only' => 'Pengguna menyekat pesanan daripada orang yang tiada dalam senarai kawan.',
        'moderated' => 'Saluran ini sedang dimoderasi.',
        'no_access' => 'Anda tidak boleh mencapai saluran itu.',
        'no_announce' => 'Anda tidak diizinkan untuk menghantar pengumuman.',
        'receive_friends_only' => 'Pengguna ini mungkin tidak boleh membalas kerana anda hanya menerima pesanan daripada orang dalam senarai kawan.',
        'restricted' => 'Anda tidak boleh mengirim pesanan ketika didiamkan, dihadkan atau dilarang.',
        'silenced' => 'Anda tidak boleh mengirim pesanan ketika didiamkan, dihadkan atau dilarang.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Pengomenan dilumpuhkan',
        ],
        'update' => [
            'deleted' => "Hantaran yang dipadam tidak boleh disunting.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'Pengadilan untuk peraduan ini tidak giat.',
        'voting_over' => 'Anda tidak boleh mengubah undian setelah tempoh mengundi untuk peraduan ini telah tamat.',

        'entry' => [
            'limit_reached' => 'Anda telah mencapai had penyertaan untuk peraduan ini',
            'over' => 'Terima kasih atas penyertaan anda! Penyerahan telah tutup untuk peraduan ini dan pengundian akan buka sebentar lagi.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Tidak diizinkan untuk memoderasi forum ini.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Hanya hantaran terakhir boleh dipadam.',
                'locked' => 'Hantaran pada tajuk terkunci tidak boleh dipadam.',
                'no_forum_access' => 'Capaian ke forum yang diminta diperlukan.',
                'not_owner' => 'Hanya penghantar boleh memadam hantaran ini.',
            ],

            'edit' => [
                'deleted' => 'Tidak boleh sunting hantaran yang dipadam.',
                'locked' => 'Hantaran ini dikunci daripada disunting.',
                'no_forum_access' => 'Capaian ke forum yang diminta diperlukan.',
                'not_owner' => 'Hanya penghantar boleh menyunting hantaran ini.',
                'topic_locked' => 'Hantaran pada tajuk terkunci tidak boleh disunting.',
            ],

            'store' => [
                'play_more' => 'Sila cuba bermain sebelum menghantar di forum! Sekiranya anda mempunyai masalah ketika bermain, sila hantar ke forum Bantuan dan Sokongan.',
                'too_many_help_posts' => "Anda perlu bermain osu! lagi sebelum anda boleh menghantar lagi. Sekiranya anda masih mempunyai masalah bermain, hantar e-mel ke support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Sila sunting hantaran sebelumnya daripada menghantar semula.',
                'locked' => 'Tidak boleh membalas bebenang yang dikunci.',
                'no_forum_access' => 'Capaian ke forum yang diminta diperlukan.',
                'no_permission' => 'Tidak diizinkan untuk membalas.',

                'user' => [
                    'require_login' => 'Sila daftar masuk untuk membalas.',
                    'restricted' => "Tidak boleh membalas ketika dihadkan.",
                    'silenced' => "Tidak boleh membalas ketika didiamkan.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Capaian ke forum yang diminta diperlukan.',
                'no_permission' => 'Tidak diizinkan untuk memulakan tajuk baharu.',
                'forum_closed' => 'Forum ini ditutup dan tidak boleh dibuat hantaran.',
            ],

            'vote' => [
                'no_forum_access' => 'Capaian ke forum yang diminta diperlukan.',
                'over' => 'Tinjauan telah tamat dan tidak boleh diundi lagi.',
                'play_more' => 'Anda perlu bermain lagi sebelum mengundi pada forum.',
                'voted' => 'Pengubahan undian tidak dibenarkan.',

                'user' => [
                    'require_login' => 'Sila daftar masuk untuk mengundi.',
                    'restricted' => "Tidak boleh mengundi ketika dihadkan.",
                    'silenced' => "Tidak boleh mengundi ketika didiamkan.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Capaian ke forum yang diminta diperlukan.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Kulit tidak sah ditentukan.',
                'not_owner' => 'Hanya pemilik boleh menyunting kulit.',
            ],
            'store' => [
                'forum_not_allowed' => 'Forum ini tidak menerima kulit tajuk.',
            ],
        ],

        'view' => [
            'admin_only' => 'Hanya pentadbir boleh melihat forum ini.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => 'Pemilik bilik sahaja boleh menutup.',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Markah jenis ini tidak boleh disemat",
            'failed' => "Markah tidak lulus tidak boleh disemat.",
            'not_owner' => 'Hanya pemilik markah boleh menyemat markah.',
            'too_many' => 'Terlalu banyak markah disemat.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "Anda telah memasuki pasukan ini.",
                'already_other_member' => "Anda telah memasuki pasukan lain.",
                'currently_applying' => 'Anda mempunyai permintaan masuk pasukan yang tergantung.',
                'team_closed' => 'Pasukan ini kini tidak menerima permintaan masuk.',
                'team_full' => "Pasukan ini penuh dan tidak boleh menerima ahli lagi.",
            ],
        ],
        'part' => [
            'is_leader' => "Ketua pasukan tidak boleh meninggalkan pasukan.",
            'not_member' => 'Anda bukan ahli pasukan.',
        ],
        'store' => [
            'require_supporter_tag' => 'Tag osu!supporter diperlukan untuk mencipta pasukan.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Halaman pengguna dikunci.',
                'not_owner' => 'Halaman pengguna sendiri sahaja boleh disunting.',
                'require_supporter_tag' => 'Tag osu!supporter diperlukan.',
            ],
        ],
        'update_email' => [
            'locked' => 'alamat e-mel dikunci',
        ],
    ],
];
