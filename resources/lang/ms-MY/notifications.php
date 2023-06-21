<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Semuanya telah dibaca!',
    'delete' => 'Padam :type',
    'loading' => 'Memuatkan yang belum dibaca...',
    'mark_read' => 'Padam :type',
    'none' => 'Tiada pemberitahuan',
    'see_all' => 'lihat semua pemberitahuan',
    'see_channel' => 'buka tetingkap bual',
    'verifying' => 'Harap disahkan sesi terlebih dahulu sebelum melihat pemberitahuan',

    'action_type' => [
        '_' => 'semua',
        'beatmapset' => 'beatmap',
        'build' => 'versi terbitan',
        'channel' => 'perbualan',
        'forum_topic' => 'forum',
        'news_post' => 'berita',
        'user' => 'profil',
    ],

    'filters' => [
        '_' => 'semua pemberitahuan',
        'user' => 'profil',
        'beatmapset' => 'beatmap',
        'forum_topic' => 'forum',
        'news_post' => 'berita',
        'build' => 'versi',
        'channel' => 'bual',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Kesukaran tamu',
                'beatmap_owner_change' => 'Kamu telah terdaftar sebagai pemilik tingkat kesukaran ":beatmap" pada beatmap ":title"',
                'beatmap_owner_change_compact' => 'Kamu telah terdaftar sebagai pemilik dari tingkat kesukaran ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Laman perbincangan beatmap',
                'beatmapset_discussion_lock' => 'Perbincangan untuk beatmap ":title" telah ditutup',
                'beatmapset_discussion_lock_compact' => 'Perbincangan beatmap telah ditutup',
                'beatmapset_discussion_post_new' => 'Kiriman baharu pada ":title" oleh :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Kiriman baharu pada ":title" oleh :username',
                'beatmapset_discussion_post_new_compact' => 'Kiriman baharu oleh :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Kiriman baharu oleh :username',
                'beatmapset_discussion_review_new' => 'Terdapat ulasan baharu pada ":title" oleh :username yang menyinggung seputar masalah: :problems, saran: :suggestions, dan pujian berupa: :praises',
                'beatmapset_discussion_review_new_compact' => 'Terdapat ulasan baharu oleh :username yang menyinggung seputar masalah: :problems, saran: :suggestions, dan pujian berupa: :praises',
                'beatmapset_discussion_unlock' => 'Perbincangan untuk beatmap ":title" telah dibuka kembali.',
                'beatmapset_discussion_unlock_compact' => 'Perbincangan beatmap telah dibuka',
            ],

            'beatmapset_problem' => [
                '_' => 'Masalah pada Beatmap Lulusan',
                'beatmapset_discussion_qualified_problem' => 'Dilaporkan oleh :username pada ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Dilaporkan oleh :username pada ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Dilaporkan oleh :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Dilaporkan oleh :username',
            ],

            'beatmapset_state' => [
                '_' => 'Perubahan status beatmap',
                'beatmapset_disqualify' => 'Beatmap ":title" telah disingkirkan',
                'beatmapset_disqualify_compact' => 'Beatmap telah disingkirkan',
                'beatmapset_love' => 'Beatmap ":title" telah diberikan status digemari',
                'beatmapset_love_compact' => 'Beatmap telah diberikan status digemari',
                'beatmapset_nominate' => '":title" telah dicalonkan',
                'beatmapset_nominate_compact' => 'Beatmap telah dicalonkan',
                'beatmapset_qualify' => '":title" telah memperoleh jumlah pencalonan yang diperlukan untuk memasuki barisan pemeringkatan',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '":title" telah diperingkatkan',
                'beatmapset_rank_compact' => 'Beatmap telah diperingkatkan',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'channel' => [
            '_' => '',

            'announcement' => [
                '_' => '',

                'announce' => [
                    'channel_announcement' => '',
                    'channel_announcement_compact' => '',
                    'channel_announcement_group' => '',
                ],
            ],

            'channel' => [
                '_' => '',

                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => '',
                    'channel_message_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => '',

            'forum_topic_reply' => [
                '_' => '',
                'forum_topic_reply' => '',
                'forum_topic_reply_compact' => '',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Beatmap baharu',

                'user_beatmapset_new' => 'Beatmap baharu ":title" oleh :username',
                'user_beatmapset_new_compact' => 'Beatmap baharu ":title"',
                'user_beatmapset_new_group' => '',

                'user_beatmapset_revive' => '',
                'user_beatmapset_revive_compact' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Pingat',

            'user_achievement_unlock' => [
                '_' => 'Pingat baharu',
                'user_achievement_unlock' => '":title" terbuka!',
                'user_achievement_unlock_compact' => 'Pingat ":title" terbuka!',
                'user_achievement_unlock_group' => 'Pingat diperolehi!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Kamu telah terdaftar sebagai pemilik kesukaran tamu pada beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Perbincangan untuk ":title" telah ditutup',
                'beatmapset_discussion_post_new' => 'Terdapat kemas kini pada perbincangan ":title"',
                'beatmapset_discussion_unlock' => 'Perbincangan untuk ":title\' telah dibuka',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Terdapat masalah baharu yang dilaporkan pada ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" telah disingkirkan',
                'beatmapset_love' => '":title" telah diberikan status digemari',
                'beatmapset_nominate' => '":title" telah diberikan status dicalonkan',
                'beatmapset_qualify' => '":title" telah memperoleh jumlah pencalonan yang diperlukan untuk memasuki barisan pemeringkatan',
                'beatmapset_rank' => '":title" telah diberikan status diperingkatkan',
                'beatmapset_remove_from_loved' => 'Status digemari telah dibuang dari ":title"',
                'beatmapset_reset_nominations' => 'Status dicalonkan pada ":title" telah dibatalkan',
            ],

            'comment' => [
                'comment_new' => 'Terdapat ulasan baharu pada beatmap ":title"',
            ],
        ],

        'channel' => [
            'announcement' => [
                'announce' => 'Terdapat pengumuman baharu pada ":name"',
            ],

            'channel' => [
                'pm' => 'Kamu menerima pesanan baharu dari :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Terdapat ulasan baharu pada riwayat perubahan ":title"',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Terdapat ulasan baharu pada berita ":title"',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Terdapat balasan baharu pada ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username telah memperolehi pingat baharu, ":title"!',
                'user_achievement_unlock_self' => 'Kamu telah memperolehi pingat baharu, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username telah mencipta beatmap baru',
                'user_beatmapset_revive' => ':username memiliki beatmap yang dipulihkan dari Perkuburan',
            ],
        ],
    ],
];
