<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'all_read' => 'Все уведомления прочтены!',
    'mark_all_read' => 'Очистить все',

    'item' => [
        'beatmapset' => [
            '_' => 'Карта',

            'beatmapset_discussion' => [
                '_' => 'Обсуждение карты',
                'beatmapset_discussion_lock' => 'Карта ":title" заблокирована для обсуждений.',
                'beatmapset_discussion_lock_compact' => 'Обсуждение было заблокировано',
                'beatmapset_discussion_post_new' => ':username опубликовал новое сообщение в обсуждениях карты ":title".',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Новый пост от :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Карта ":title" разблокирована для обсуждений.',
                'beatmapset_discussion_unlock_compact' => 'Обсуждение было разблокировано',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Статус карты изменен',
                'beatmapset_disqualify' => 'Карта ":title" была дисквалифицирована :username.',
                'beatmapset_disqualify_compact' => 'Карта была дисквалифицирована',
                'beatmapset_love' => ':username присвоил статус loved карте ":title".',
                'beatmapset_love_compact' => 'Карта была повышена до любимых',
                'beatmapset_nominate' => 'Карта ":title" была номинирована :username.',
                'beatmapset_nominate_compact' => 'Карта была номинирована',
                'beatmapset_qualify' => 'Карте ":title" было присвоено достаточно номинаций для ожидания ранка.',
                'beatmapset_qualify_compact' => 'Карта вошла в рейтинговую очередь',
                'beatmapset_rank' => '":title" был оценен',
                'beatmapset_rank_compact' => 'Карта была оценена',
                'beatmapset_reset_nominations' => 'Проблема опубликованная :username вызвала сброс процесса номинации карты ":title" ',
                'beatmapset_reset_nominations_compact' => 'Номинация была сброшена',
            ],

            'comment' => [
                '_' => 'Новый комментарий',

                'comment_new' => ':username прокомментировал ":content" на ":title"',
                'comment_new_compact' => ':username прокомментировал ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Чат',

            'channel' => [
                '_' => 'Новое сообщение',
                'pm' => [
                    'channel_message' => ':username говорит ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'от :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Список изменений',

            'comment' => [
                '_' => 'Новый комментарий',

                'comment_new' => ':username прокомментировал ":content" на ":title"',
                'comment_new_compact' => ':username прокомментировал ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Новости',

            'comment' => [
                '_' => 'Новый комментарий',

                'comment_new' => ':username прокомментировал ":content" на ":title"',
                'comment_new_compact' => ':username прокомментировал ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тема форума',

            'forum_topic_reply' => [
                '_' => 'Новый ответ на форуме',
                'forum_topic_reply' => ':username ответил в теме ":title".',
                'forum_topic_reply_compact' => ':username ответил',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Старая система ЛС',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited непрочитанное сообщение.|:count_delimited непрочитанные сообщения.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Медали',

            'user_achievement_unlock' => [
                '_' => 'Новая медаль',
                'user_achievement_unlock' => 'Разблокировано ":title"!',
            ],
        ],
    ],
];
