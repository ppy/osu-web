<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Semuanya telah dibaca!',
    'delete' => 'Padam :type',
    'loading' => 'Memuatkan pemberitahuan belum dibaca...',
    'mark_read' => 'Padam :type',
    'none' => 'Tiada pemberitahuan',
    'see_all' => 'lihat semua pemberitahuan',
    'see_channel' => 'ke bualan',
    'verifying' => 'Sila sahkan sesi untuk melihat pemberitahuan',

    'action_type' => [
        '_' => 'semua',
        'beatmapset' => 'beatmap',
        'build' => 'binaan',
        'channel' => 'bualan',
        'forum_topic' => 'forum',
        'news_post' => 'berita',
        'team' => 'pasukan',
        'user' => 'profil',
    ],

    'filters' => [
        '_' => 'semua',
        'beatmapset' => 'peta rentak',
        'build' => 'versi',
        'channel' => 'bual',
        'forum_topic' => 'forum',
        'news_post' => 'berita',
        'team' => 'pasukan',
        'user' => 'profil',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Peta rentak',

            'beatmap_owner_change' => [
                '_' => 'Kesukaran tamu',
                'beatmap_owner_change' => 'Anda kini pemilik kesukaran ":beatmap" pada peta rentak ":title"',
                'beatmap_owner_change_compact' => 'Anda kini pemilik kesukaran ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Perbincangan peta rentak',
                'beatmapset_discussion_lock' => 'Perbincangan pada ":title" telah dikunci',
                'beatmapset_discussion_lock_compact' => 'Perbincangan dikunci',
                'beatmapset_discussion_post_new' => 'Hantaran baharu pada ":title" oleh :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Hantaran baharu pada ":title" oleh :username',
                'beatmapset_discussion_post_new_compact' => 'Hantaran baharu oleh :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Hantaran baharu oleh :username',
                'beatmapset_discussion_review_new' => 'Ulasan baharu pada ":title" oleh :username mengandungi :review_counts',
                'beatmapset_discussion_review_new_compact' => 'Ulasan baharu oleh :username mengandungi :review_counts',
                'beatmapset_discussion_unlock' => 'Perbincangan tentang ":title" telah dibuka kunci',
                'beatmapset_discussion_unlock_compact' => 'Perbincangan telah dibuka kunci',

                'review_count' => [
                    'praises' => ':count_delimited pujian',
                    'problems' => ':count_delimited masalah',
                    'suggestions' => ':count_delimited cadangan',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Masalah Peta Rentak Layak',
                'beatmapset_discussion_qualified_problem' => 'Dilaporkan oleh :username pada ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Dilaporkan oleh :username pada ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Dilaporkan oleh :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Dilaporkan oleh :username',
            ],

            'beatmapset_state' => [
                '_' => 'Taraf peta rentak diubah',
                'beatmapset_disqualify' => 'Beatmap ":title" telah disingkirkan',
                'beatmapset_disqualify_compact' => 'Beatmap telah disingkirkan',
                'beatmapset_love' => 'Peta rentak ":title" telah dinaikkan ke Kegemaran',
                'beatmapset_love_compact' => 'Peta rentak telah dinaikkan ke Kegemaran',
                'beatmapset_nominate' => '":title" telah dicalonkan',
                'beatmapset_nominate_compact' => 'Peta rentak telah dicalonkan',
                'beatmapset_qualify' => '":title" telah memperoleh jumlah pencalonan yang cukup dan memasuki giliran pemeringkatan',
                'beatmapset_qualify_compact' => 'Peta rentak memasuki giliran pemeringkatan',
                'beatmapset_rank' => '":title" telah diperingkatkan',
                'beatmapset_rank_compact' => 'Peta rentak telah diperingkatkan',
                'beatmapset_remove_from_loved' => '":title" dipadam dari Kegemaran',
                'beatmapset_remove_from_loved_compact' => 'Peta rentak dipadam dari Kegemaran',
                'beatmapset_reset_nominations' => 'Pencalonan ":title" telah diset semula',
                'beatmapset_reset_nominations_compact' => 'Pencalonan telah diset semula',
            ],

            'comment' => [
                '_' => 'Komen baharu',

                'comment_new' => ':username mengomen ":content" pada ":title"',
                'comment_new_compact' => ':username mengomen ":content"',
                'comment_reply' => ':username membalas ":content" pada ":title"',
                'comment_reply_compact' => ':username membalas ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Bualan',

            'announcement' => [
                '_' => 'Pengumuman baharu',

                'announce' => [
                    'channel_announcement' => ':username berkata ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Pengumuman dari :username',
                ],
            ],

            'channel' => [
                '_' => 'Pesanan baharu',

                'pm' => [
                    'channel_message' => ':username berkata ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'dari :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Log perubahan',

            'comment' => [
                '_' => 'Komen baharu',

                'comment_new' => ':username mengomen ":content" pada ":title"',
                'comment_new_compact' => ':username mengomen ":content"',
                'comment_reply' => ':username membalas ":content" pada ":title"',
                'comment_reply_compact' => ':username membalas ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Berita',

            'comment' => [
                '_' => 'Komen baharu',

                'comment_new' => ':username mengomen ":content" pada ":title"',
                'comment_new_compact' => ':username mengomen ":content"',
                'comment_reply' => ':username membalas ":content" pada ":title"',
                'comment_reply_compact' => ':username membalas ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Tajuk forum',

            'forum_topic_reply' => [
                '_' => 'Balasan forum baharu',
                'forum_topic_reply' => ':username membalas pada ":title"',
                'forum_topic_reply_compact' => ':username membalas',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Permintaan masuk pasukan',

                'team_application_accept' => "Anda kini ahli pasukan :title",
                'team_application_accept_compact' => "Anda kini ahli pasukan :title",
                'team_application_reject' => 'Permintaan anda untuk memasuki pasukan :title ditolak',
                'team_application_reject_compact' => 'Permintaan anda untuk memasuki pasukan :title ditolak',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Peta rentak baharu',

                'user_beatmapset_new' => 'Peta rentak baharu ":title" oleh :username',
                'user_beatmapset_new_compact' => 'Peta rentak baharu ":title"',
                'user_beatmapset_new_group' => 'Peta rentak baharu oleh :username',

                'user_beatmapset_revive' => 'Peta rentak ":title" dikembalikan oleh :username',
                'user_beatmapset_revive_compact' => 'Peta rentak ":title" dikembalikan',
            ],
        ],

        'user_achievement' => [
            '_' => 'Pingat',

            'user_achievement_unlock' => [
                '_' => 'Pingat baharu',
                'user_achievement_unlock' => '":title" dibuka!',
                'user_achievement_unlock_compact' => 'Pingat ":title" dibuka!',
                'user_achievement_unlock_group' => 'Pingat dibuka!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Anda kini tamu beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Perbincangan untuk ":title" telah ditutup',
                'beatmapset_discussion_post_new' => 'Terdapat kemas kini pada perbincangan ":title"',
                'beatmapset_discussion_unlock' => 'Perbincangan untuk ":title\' telah dibuka kunci',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Terdapat masalah baharu yang dilaporkan pada ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" telah disingkirkan',
                'beatmapset_love' => '":title" telah dinaikkan ke Kegemaran',
                'beatmapset_nominate' => '":title" telah diberikan status dicalonkan',
                'beatmapset_qualify' => '":title" telah memperoleh jumlah pencalonan yang cukup dan memasuki giliran pemeringkatan',
                'beatmapset_rank' => '":title" telah diperingkatkan',
                'beatmapset_remove_from_loved' => '":title" dipadam dari Kegemaran',
                'beatmapset_reset_nominations' => 'Pencalonan ":title" telah diset semula',
            ],

            'comment' => [
                'comment_new' => 'Peta rentak ":title" mempunyai komen baharu',
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
                'comment_new' => 'Terdapat komen baharu pada log perubahan ":title"',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Terdapat komen baharu pada berita ":title"',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Terdapat balasan baharu pada ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Anda kini ahli pasukan :title",
                'team_application_reject' => 'Permintaan anda untuk memasuki pasukan :title ditolak',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username telah mencipta beatmap baru',
                'user_beatmapset_revive' => ':username memiliki beatmap yang dipulihkan dari Perkuburan',
            ],
        ],
    ],
];
