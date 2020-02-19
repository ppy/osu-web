<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'all_read' => 'Tüm bildirimler okundu!',
    'mark_all_read' => 'Hepsini temizle',
    'none' => '',
    'see_all' => '',

    'filters' => [
        '_' => '',
        'user' => '',
        'beatmapset' => '',
        'forum_topic' => '',
        'news_post' => '',
        'build' => '',
        'channel' => '',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap tartışması',
                'beatmapset_discussion_lock' => 'Beatmap ":title" tartışmak için kilitlendi.',
                'beatmapset_discussion_lock_compact' => 'Tartışma kilitlenmiş',
                'beatmapset_discussion_post_new' => ':username ":title" beatmapinin tartışmasında yeni mesaj attı.',
                'beatmapset_discussion_post_new_empty' => ':title için :username tarafından gönderi',
                'beatmapset_discussion_post_new_compact' => ':username tarafından yeni gönderi',
                'beatmapset_discussion_post_new_compact_empty' => ':username tarafından yeni gönderi',
                'beatmapset_discussion_unlock' => '":title" beatmapinin kilidi tartışmak için açıldı.',
                'beatmapset_discussion_unlock_compact' => 'Tartışmanın kilidi açılmış',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => ':username tarafından rapor edildi: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => ':username tarafından rapor edildi',
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
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
