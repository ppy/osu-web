<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Semua notifikasi telah dibaca!',
    'mark_read' => 'Hilangkan semua notifikasi terkait :type',
    'none' => 'Tidak ada notifikasi',
    'see_all' => 'lihat semua notifikasi',

    'filters' => [
        '_' => 'semua',
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

            'beatmapset_discussion' => [
                '_' => 'Laman diskusi beatmap',
                'beatmapset_discussion_lock' => 'Diskusi untuk beatmap ":title" telah ditutup.',
                'beatmapset_discussion_lock_compact' => 'Diskusi beatmap telah dikunci',
                'beatmapset_discussion_post_new' => ':username menulis pesan baru pada laman diskusi beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => 'Postingan baru di ":title" oleh :username',
                'beatmapset_discussion_post_new_compact' => 'Postingan baru dari :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Postingan baru oleh :username',
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
                '_' => 'Status beatmap diganti',
                'beatmapset_disqualify' => 'Beatmap ":title" telah didiskualifikasi oleh :username.',
                'beatmapset_disqualify_compact' => 'Beatmap telah didiskualifikasi',
                'beatmapset_love' => 'Beatmap ":title" telah diberikan status loved oleh :username.',
                'beatmapset_love_compact' => 'Status beatmap dipromosikan menjadi loved',
                'beatmapset_nominate' => 'Beatmap ":title" telah dinominasikan oleh :username.',
                'beatmapset_nominate_compact' => 'Beatmap telah dinominasi',
                'beatmapset_qualify' => 'Beatmap ":title" telah memperoleh jumlah nominasi yang diperlukan untuk proses ranking.',
                'beatmapset_qualify_compact' => 'Beatmap telah memasuki antrean status ranking',
                'beatmapset_rank' => '":title" telah berstatus ranked',
                'beatmapset_rank_compact' => 'Beatmap sekarang berstatus ranked',
                'beatmapset_reset_nominations' => 'Masalah yang dikemukakan oleh :username menganulir nominasi sebelumnya pada beatmap ":title" ',
                'beatmapset_reset_nominations_compact' => 'Proses nominasi diulang',
            ],

            'comment' => [
                '_' => 'Komentar baru',

                'comment_new' => ':username berkomentar ":content" di topik ":title"',
                'comment_new_compact' => ':username berkomentar ":content"',
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

                'comment_new' => ':username berkomentar ":content" di topik ":title"',
                'comment_new_compact' => ':username berkomentar ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Berita',

            'comment' => [
                '_' => 'Komentar baru',

                'comment_new' => ':username berkomentar ":content" di topik ":title"',
                'comment_new_compact' => ':username berkomentar ":content"',
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
            '_' => 'PM Forum Lawas',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited pesan yang belum dibaca.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medali',

            'user_achievement_unlock' => [
                '_' => 'Medali baru',
                'user_achievement_unlock' => '":title" Terbuka!',
                'user_achievement_unlock_compact' => 'Anda berhasil mendapatkan medali ":title"!',
            ],
        ],
    ],
];
