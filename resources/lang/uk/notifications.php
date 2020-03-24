<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Всі сповіщення прочитані!',
    'mark_read' => '',
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
            '_' => 'Карта',

            'beatmapset_discussion' => [
                '_' => 'Обговорення карти',
                'beatmapset_discussion_lock' => 'Карта ":title" заблокована для обговорень.',
                'beatmapset_discussion_lock_compact' => 'Обговорення закрито',
                'beatmapset_discussion_post_new' => ':username опублікував нове повідомлення в обговореннях карти ":title".',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Нова публікація від :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Карта ":title" розблокована для обговорень.',
                'beatmapset_discussion_unlock_compact' => 'Обговорення відкрито',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Статус карти змінений',
                'beatmapset_disqualify' => 'Карта ":title" була дискваліфікована :username.',
                'beatmapset_disqualify_compact' => 'Карту було дискваліфіковано',
                'beatmapset_love' => ':username присвоїв статус улюблена карті ":title".',
                'beatmapset_love_compact' => 'Карту внесено до улюблених',
                'beatmapset_nominate' => 'Карта ":title" була номінована :username.',
                'beatmapset_nominate_compact' => 'Карту було номіновано',
                'beatmapset_qualify' => 'Карта ":title" отримала достатньо номінацій, і очікує отримання рейтингу.',
                'beatmapset_qualify_compact' => 'Карта увійшла до черги рейтингу',
                'beatmapset_rank' => '":title" оцінено',
                'beatmapset_rank_compact' => '',
                'beatmapset_reset_nominations' => 'Проблема опублікована :username викликала скидання процесу номінації карти ":title" ',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => 'Новий коментар',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'Чат',

            'channel' => [
                '_' => 'Нове повідомлення',
                'pm' => [
                    'channel_message' => ':username сказав ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'від :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Список змін',

            'comment' => [
                '_' => 'Новий коментар',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Новини',

            'comment' => [
                '_' => 'Новий коментар',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тема форуму',

            'forum_topic_reply' => [
                '_' => 'Нова відповідь на форумі',
                'forum_topic_reply' => ':username відповів в темі ":title".',
                'forum_topic_reply_compact' => '',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Вхідні повідомлення старого форуму',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited непрочитане повідомлення.|:count_delimited непрочитані повідомлення.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Досягнення',

            'user_achievement_unlock' => [
                '_' => '',
                'user_achievement_unlock' => '',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
