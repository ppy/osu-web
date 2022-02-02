<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Все уведомления прочитаны!',
    'delete' => 'Очистить :type',
    'loading' => 'Загрузка непрочитанных уведомлений...',
    'mark_read' => 'Очистить :type',
    'none' => 'Уведомлений нет',
    'see_all' => 'см. все уведомления',
    'see_channel' => 'перейти в чат',
    'verifying' => 'Пожалуйста, проверьте сессию для просмотра уведомлений',

    'filters' => [
        '_' => 'все',
        'user' => 'профиль',
        'beatmapset' => 'карты',
        'forum_topic' => 'форум',
        'news_post' => 'новости',
        'build' => 'билды',
        'channel' => 'чат',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Карта',

            'beatmap_owner_change' => [
                '_' => 'Гостевая сложность',
                'beatmap_owner_change' => 'Вы назначены владельцем сложности ":beatmap" в карте ":title"',
                'beatmap_owner_change_compact' => 'Вы назначены владельцем сложности ":beatmap" ',
            ],

            'beatmapset_discussion' => [
                '_' => 'Обсуждение карты',
                'beatmapset_discussion_lock' => 'Карта ":title" заблокирована для обсуждений.',
                'beatmapset_discussion_lock_compact' => 'Обсуждение было заблокировано',
                'beatmapset_discussion_post_new' => ':username опубликовал новое сообщение в обсуждениях карты ":title".',
                'beatmapset_discussion_post_new_empty' => 'Новый пост в ":title" от :username',
                'beatmapset_discussion_post_new_compact' => 'Новый пост от :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Новый пост от :username',
                'beatmapset_discussion_review_new' => 'Новый отзыв на ":title" от :username, содержащий проблемы: :problems, предложения: :suggestions, похвалы: :praises',
                'beatmapset_discussion_review_new_compact' => 'Новый отзыв от :username, содержащий проблемы: :problems, предложения: :suggestions, похвалы: :praises',
                'beatmapset_discussion_unlock' => 'Карта ":title" разблокирована для обсуждений.',
                'beatmapset_discussion_unlock_compact' => 'Обсуждение было разблокировано',
            ],

            'beatmapset_problem' => [
                '_' => 'Проблема с квалифицированной картой',
                'beatmapset_discussion_qualified_problem' => 'Жалоба от :username на ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Жалоба от :username на ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Жалоба от :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Жалоба от :username',
            ],

            'beatmapset_state' => [
                '_' => 'Статус карты изменен',
                'beatmapset_disqualify' => 'Карта ":title" была дисквалифицирована',
                'beatmapset_disqualify_compact' => 'Карта была дисквалифицирована',
                'beatmapset_love' => 'Карте ":title" была присвоена категория Любимая',
                'beatmapset_love_compact' => 'Карте была присвоена категория Любимая',
                'beatmapset_nominate' => 'Карта ":title" была номинирована :username.',
                'beatmapset_nominate_compact' => 'Карта была номинирована',
                'beatmapset_qualify' => 'Карте ":title" было присвоено достаточно номинаций для вхождения в очередь ранка',
                'beatmapset_qualify_compact' => 'Карта вошла очередь ранка',
                'beatmapset_rank' => 'Карта ":title" стала Рейтинговой',
                'beatmapset_rank_compact' => 'Карта стала Рейтинговой',
                'beatmapset_remove_from_loved' => 'Карта ":title" потеряла категорию Любимая',
                'beatmapset_remove_from_loved_compact' => 'Карта была удалена из категории Любимая',
                'beatmapset_reset_nominations' => 'Номинации карты ":title"  была сброшена',
                'beatmapset_reset_nominations_compact' => 'Номинация была сброшена',
            ],

            'comment' => [
                '_' => 'Новый комментарий',

                'comment_new' => ':username прокомментировал ":content" на ":title"',
                'comment_new_compact' => ':username прокомментировал ":content"',
                'comment_reply' => ':username ответил ":content" на ":title"',
                'comment_reply_compact' => ':username ответил ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Чат',

            'announcement' => [
                '_' => '',

                'announce' => [
                    'channel_announcement' => '',
                    'channel_announcement_compact' => '',
                    'channel_announcement_group' => '',
                ],
            ],

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
                'comment_reply' => ':username ответил ":content" на ":title"',
                'comment_reply_compact' => ':username ответил ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Новости',

            'comment' => [
                '_' => 'Новый комментарий',

                'comment_new' => ':username прокомментировал ":content" на ":title"',
                'comment_new_compact' => ':username прокомментировал ":content"',
                'comment_reply' => ':username ответил ":content" на ":title"',
                'comment_reply_compact' => ':username ответил ":content"',
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

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Новая карта',

                'user_beatmapset_new' => 'Новая карта ":title" от :username',
                'user_beatmapset_new_compact' => 'Новая карта ":title"',
                'user_beatmapset_new_group' => 'Новые карты от :username',

                'user_beatmapset_revive' => 'Карта ":title" была воскрешена :username',
                'user_beatmapset_revive_compact' => 'Карта ":title" воскрешена',
            ],
        ],

        'user_achievement' => [
            '_' => 'Медали',

            'user_achievement_unlock' => [
                '_' => 'Новая медаль',
                'user_achievement_unlock' => 'Разблокировано ":title"!',
                'user_achievement_unlock_compact' => 'Разблокировано: «:title»!',
                'user_achievement_unlock_group' => 'Медали открыты!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Вы приглашены в ":title" ',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Обсуждение ":title" было закрыто',
                'beatmapset_discussion_post_new' => 'Обсуждение ":title" имеет новые ответы',
                'beatmapset_discussion_unlock' => 'Обсуждение ":title" было открыто',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Сообщена новая проблема в ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => 'Карта ":title" дисквалифицирована',
                'beatmapset_love' => '":title" был повышен до любимого',
                'beatmapset_nominate' => 'Карта ":title" номинирована',
                'beatmapset_qualify' => '":title" получило достаточно номинаций и вступило в очередь ранка',
                'beatmapset_rank' => 'Карта ":title" получила категорию Рейтинговая',
                'beatmapset_remove_from_loved' => '":title" был удален из Любимых',
                'beatmapset_reset_nominations' => 'Номинация ":title" была сброшена',
            ],

            'comment' => [
                'comment_new' => 'Карта ":title" имеет новые комментарии',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Вы получили новое сообщение от :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Список изменений ":title" содержит новые комментарии',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Новость ":title" имеет новые комментарии',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Есть новые ответы в ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username открыл новую медаль: ":title"!',
                'user_achievement_unlock_self' => 'Вы открыли новую медаль: ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username создал новую карту',
            ],
        ],
    ],
];
