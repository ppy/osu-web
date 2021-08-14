<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Semua notifikasi telah dibaca!',
    'delete' => 'Hapus :type',
    'loading' => 'Memuat notifikasi-notifikasi yang belum dibaca...',
    'mark_read' => 'Hapus :type',
    'none' => 'Tidak ada notifikasi',
    'see_all' => 'lihat semua notifikasi',
    'see_channel' => 'tuju obrolan',
    'verifying' => 'Harap verifikasi sesi Anda untuk dapat melihat notifikasi',

    'filters' => [
        '_' => 'semua notifikasi',
        'user' => 'profil',
        'beatmapset' => 'beatmap',
        'forum_topic' => 'forum',
        'news_post' => 'berita',
        'build' => 'build',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Guest difficulty',
                'beatmap_owner_change' => 'Anda telah terdaftar sebagai pembuat tingkat kesulitan ":beatmap" pada beatmap ":title"',
                'beatmap_owner_change_compact' => 'Anda telah terdaftar sebagai pemilik dari tingkat kesulitan ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Laman diskusi beatmap',
                'beatmapset_discussion_lock' => 'Diskusi untuk beatmap ":title" telah ditutup.',
                'beatmapset_discussion_lock_compact' => 'Diskusi beatmap telah dikunci',
                'beatmapset_discussion_post_new' => 'Postingan baru pada ":title" oleh :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Postingan baru pada ":title" oleh :username',
                'beatmapset_discussion_post_new_compact' => 'Postingan baru dari :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Postingan baru oleh :username',
                'beatmapset_discussion_review_new' => 'Terdapat ulasan baru pada ":title" oleh :username yang menyinggung seputar masalah: :problems, saran: :suggestions, dan pujian berupa: :praises',
                'beatmapset_discussion_review_new_compact' => 'Terdapat ulasan baru oleh :username yang menyinggung seputar masalah: :problems, saran: :suggestions, dan pujian berupa: :praises',
                'beatmapset_discussion_unlock' => 'Diskusi untuk beatmap ":title" telah dibuka kembali.',
                'beatmapset_discussion_unlock_compact' => 'Diskusi beatmap telah dibuka',
            ],

            'beatmapset_problem' => [
                '_' => 'Masalah pada Beatmap Qualified',
                'beatmapset_discussion_qualified_problem' => 'Dilaporkan oleh :username pada ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Dilaporkan oleh :username pada ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Dilaporkan oleh :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Dilaporkan oleh :username',
            ],

            'beatmapset_state' => [
                '_' => 'Perubahan status beatmap',
                'beatmapset_disqualify' => 'Beatmap ":title" telah didiskualifikasi',
                'beatmapset_disqualify_compact' => 'Beatmap telah didiskualifikasi',
                'beatmapset_love' => 'Beatmap ":title" telah diberikan status loved oleh :username.',
                'beatmapset_love_compact' => 'Status beatmap dipromosikan menjadi loved',
                'beatmapset_nominate' => '":title" telah mendapatkan nominasi',
                'beatmapset_nominate_compact' => 'Beatmap telah mendapatkan nominasi',
                'beatmapset_qualify' => 'Beatmap ":title" telah memperoleh jumlah nominasi yang diperlukan untuk proses ranking.',
                'beatmapset_qualify_compact' => 'Beatmap telah memasuki antrian ranking',
                'beatmapset_rank' => '":title" telah berstatus Ranked',
                'beatmapset_rank_compact' => 'Beatmap telah berstatus Ranked',
                'beatmapset_remove_from_loved' => '":title" telah dilepas dari Loved',
                'beatmapset_remove_from_loved_compact' => 'Beatmap telah dilepas dari Loved',
                'beatmapset_reset_nominations' => 'Masalah yang dikemukakan oleh :username menganulir nominasi sebelumnya pada beatmap ":title" ',
                'beatmapset_reset_nominations_compact' => 'Nominasi beatmap dianulir',
            ],

            'comment' => [
                '_' => 'Komentar baru',

                'comment_new' => ':username berkomentar ":content" di topik ":title"',
                'comment_new_compact' => ':username berkomentar ":content"',
                'comment_reply' => ':username berkomentar ":content" pada topik ":title"',
                'comment_reply_compact' => ':username berkomentar ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Pesan Baru',
                'pm' => [
                    'channel_message' => ':username mengatakan ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'dari :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Riwayat Perubahan',

            'comment' => [
                '_' => 'Komentar baru',

                'comment_new' => ':username berkomentar ":content" pada topik ":title"',
                'comment_new_compact' => ':username berkomentar ":content"',
                'comment_reply' => ':username berkomentar ":content" pada topik ":title"',
                'comment_reply_compact' => ':username berkomentar ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Berita',

            'comment' => [
                '_' => 'Komentar baru',

                'comment_new' => ':username berkomentar ":content" pada topik ":title"',
                'comment_new_compact' => ':username berkomentar ":content"',
                'comment_reply' => ':username berkomentar ":content" pada topik ":title"',
                'comment_reply_compact' => ':username berkomentar ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Topik forum',

            'forum_topic_reply' => [
                '_' => 'Balasan baru pada thread forum',
                'forum_topic_reply' => ':username memberikan balasan pada thread forum ":title".',
                'forum_topic_reply_compact' => ':username membalas',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited pesan yang belum dibaca.|:count_delimited pesan yang belum dibaca.',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Beatmap baru',

                'user_beatmapset_new' => 'Beatmap baru ":title" oleh :username',
                'user_beatmapset_new_compact' => 'Beatmap baru ":title"',
                'user_beatmapset_new_group' => 'Beatmap-beatmap baru oleh :username',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medali',

            'user_achievement_unlock' => [
                '_' => 'Medali baru',
                'user_achievement_unlock' => '":title" Terbuka!',
                'user_achievement_unlock_compact' => 'Anda berhasil mendapatkan medali ":title"!',
                'user_achievement_unlock_group' => 'Medali terbuka!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Anda telah terdaftar sebagai pembuat guest difficulty pada beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Topik diskusi ":title" telah dikunci',
                'beatmapset_discussion_post_new' => 'Terdapat pembaruan baru pada topik diskusi ":title"',
                'beatmapset_discussion_unlock' => 'Topik diskusi ":title" telah kembali dibuka',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Terdapat masalah baru yang dilaporkan pada ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" telah didiskualifikasi',
                'beatmapset_love' => '":title" telah dipromosikan ke dalam kategori Loved',
                'beatmapset_nominate' => '":title" telah mendapatkan nominasi',
                'beatmapset_qualify' => '":title" telah memperoleh jumlah nominasi yang dibutuhkan untuk memasuki antrian ranking',
                'beatmapset_rank' => '":title" telah berstatus Ranked',
                'beatmapset_remove_from_loved' => ':title telah dilepas dari Loved',
                'beatmapset_reset_nominations' => 'Status nominasi pada ":title" telah dianulir',
            ],

            'comment' => [
                'comment_new' => 'Terdapat komentar baru pada beatmap ":title"',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Anda mendapatkan pesan baru dari :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Terdapat komentar baru pada riwayat perubahan ":title"',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Terdapat komentar baru pada topik berita ":title"',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Terdapat balasan baru pada ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username telah mendapatkan medali baru, ":title"!',
                'user_achievement_unlock_self' => 'Anda telah mendapatkan medali baru, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username telah mengunggah beatmap baru',
            ],
        ],
    ],
];
