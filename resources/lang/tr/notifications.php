<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'all_read' => 'Tüm bildirimler okundu!',
    'mark_all_read' => 'Hepsini temizle',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap tartışması',
                'beatmapset_discussion_lock' => 'Beatmap ":title" tartışmak için kilitlendi.',
                'beatmapset_discussion_lock_compact' => 'Tartışma kilitlenmiş',
                'beatmapset_discussion_post_new' => ':username ":title" beatmapinin tartışmasında yeni mesaj attı.',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => ':username tarafından yeni gönderi',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => '":title" beatmapinin kilidi tartışmak için açıldı.',
                'beatmapset_discussion_unlock_compact' => 'Tartışmanın kilidi açılmış',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap durumu değişti',
                'beatmapset_disqualify' => '":title" diskalifiye edildi',
                'beatmapset_disqualify_compact' => 'Beatmap diskalifiye edildi',
                'beatmapset_love' => '":title" loved\'a yükseltildi',
                'beatmapset_love_compact' => 'Beatmap loved\'a yükseltildi',
                'beatmapset_nominate' => '":title" oylandı',
                'beatmapset_nominate_compact' => 'Beatmap oylandı',
                'beatmapset_qualify' => '":title" yeterli oy aldı ve derecelendirme sırasına girdi',
                'beatmapset_qualify_compact' => 'Beatmap ranking sırasına girdi',
                'beatmapset_rank' => '":title" ranked oldu',
                'beatmapset_rank_compact' => 'Beatmap ranked oldu',
                'beatmapset_reset_nominations' => '":title" \'ın oylaması yeniden başlatıldı',
                'beatmapset_reset_nominations_compact' => 'Oylama yeniden başlatıldı',
            ],

            'comment' => [
                '_' => 'Yeni yorum',

                'comment_new' => ':username ":title" üzerinde ":content" yorumunu yaptı',
                'comment_new_compact' => ':username ":content" yorumunu yaptı',
            ],
        ],

        'channel' => [
            '_' => 'Sohbet',

            'channel' => [
                '_' => 'Yeni mesaj',
                'pm' => [
                    'channel_message' => ':username ":title" diyor',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => ':username tarafından',
                ],
            ],
        ],

        'build' => [
            '_' => 'Değişiklik kayıtları',

            'comment' => [
                '_' => 'Yeni yorum',

                'comment_new' => ':username ":title" üzerinde ":content" yorumunu yaptı',
                'comment_new_compact' => ':username ":content" yorumunu yaptı',
            ],
        ],

        'news_post' => [
            '_' => 'Gelişmeler',

            'comment' => [
                '_' => 'Yeni yorum',

                'comment_new' => ':username ":title" üzerinde ":content" yorumunu yaptı',
                'comment_new_compact' => ':username ":content" yorumunu yaptı',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forum konusu',

            'forum_topic_reply' => [
                '_' => 'Yeni forum yanıtı',
                'forum_topic_reply' => ':username ":title" konusuna yanıt verdi.',
                'forum_topic_reply_compact' => ':username yanıt verdi',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Legacy Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited okunmamış mesaj.|:count_delimited okunmamış mesajlar.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Madalyalar',

            'user_achievement_unlock' => [
                '_' => 'Yeni madalya',
                'user_achievement_unlock' => '":title" \'ın kilidi açıldı!',
            ],
        ],
    ],
];
