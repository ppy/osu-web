<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Все уведомления прочитаны!',
    'delete' => 'Очистить',
    'loading' => 'Загрузка непрочитанных уведомлений...',
    'mark_read' => 'Прочитать',
    'none' => 'Уведомлений нет',
    'see_all' => 'список всех уведомлений',
    'see_channel' => 'перейти в чат',
    'verifying' => 'Пожалуйста, подтвердите текущую сессию, чтобы посмотреть уведомления',

    'action_type' => [
        '_' => 'все',
        'beatmapset' => 'карты',
        'build' => 'билды',
        'channel' => 'чат',
        'forum_topic' => 'форум',
        'news_post' => 'новости',
        'team' => 'команда',
        'user' => 'игроки',
    ],

    'filters' => [
        '_' => 'все',
        'beatmapset' => 'карты',
        'build' => 'билды',
        'channel' => 'чат',
        'forum_topic' => 'форум',
        'news_post' => 'новости',
        'team' => 'команда',
        'user' => 'игроки',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Карта',

            'beatmap_owner_change' => [
                '_' => 'Гостевая сложность',
                'beatmap_owner_change' => 'Вас назначили владельцем сложности ":beatmap" на карте ":title"',
                'beatmap_owner_change_compact' => 'Вас назначили владельцем сложности ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Обсуждение карты',
                'beatmapset_discussion_lock' => 'Закрыто обсуждение карты ":title"',
                'beatmapset_discussion_lock_compact' => 'Обсуждение закрыто',
                'beatmapset_discussion_post_new' => 'Новый отзыв на карту ":title" от :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Новый отзыв на карту ":title" от :username',
                'beatmapset_discussion_post_new_compact' => 'Новый отзыв от :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Новый отзыв от :username',
                'beatmapset_discussion_review_new' => 'Новый отзыв на карту ":title" от :username, содержащий :review_counts',
                'beatmapset_discussion_review_new_compact' => 'Новый отзыв от :username, содержащий :review_counts',
                'beatmapset_discussion_unlock' => 'Открыто обсуждение карты ":title"',
                'beatmapset_discussion_unlock_compact' => 'Обсуждение открыто',

                'review_count' => [
                    'praises' => ':count_delimited похвалу|:count_delimited похвалы|:count_delimited похвал',
                    'problems' => ':count_delimited проблему|:count_delimited проблемы|:count_delimited проблем',
                    'suggestions' => ':count_delimited предложение|:count_delimited предложения|:count_delimited предложений',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Проблема с квалифицированной картой',
                'beatmapset_discussion_qualified_problem' => 'Жалоба от :username на карту ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Жалоба от :username на карту ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Жалоба от :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Жалоба от :username',
            ],

            'beatmapset_state' => [
                '_' => 'Категория карты изменена',
                'beatmapset_disqualify' => 'Карта ":title" дисквалифицирована',
                'beatmapset_disqualify_compact' => 'Карта дисквалифицирована',
                'beatmapset_love' => 'Карте ":title" присвоена категория Любимая',
                'beatmapset_love_compact' => 'Карте присвоена категория Любимая',
                'beatmapset_nominate' => 'Карта ":title" номинирована',
                'beatmapset_nominate_compact' => 'Карта номинирована',
                'beatmapset_qualify' => 'Карта ":title" получила достаточно номинаций и вошла в очередь получения рейтинга',
                'beatmapset_qualify_compact' => 'Карта поставлена в очередь получения рейтинга',
                'beatmapset_rank' => 'Карта ":title" стала Рейтинговой',
                'beatmapset_rank_compact' => 'Карта стала Рейтинговой',
                'beatmapset_remove_from_loved' => 'Карта ":title" исключена из категории Любимая',
                'beatmapset_remove_from_loved_compact' => 'Карта исключена из категории Любимая',
                'beatmapset_reset_nominations' => 'Сброшена номинация карты ":title"',
                'beatmapset_reset_nominations_compact' => 'Номинация сброшена',
            ],

            'comment' => [
                '_' => 'Новый комментарий',

                'comment_new' => ':username оставил комментарий ":content" под картой ":title"',
                'comment_new_compact' => ':username оставил комментарий ":content"',
                'comment_reply' => ':username ответил ":content" под картой ":title"',
                'comment_reply_compact' => ':username ответил ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Чат',

            'announcement' => [
                '_' => 'Новое объявление',

                'announce' => [
                    'channel_announcement' => ':username сообщает: ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Объявление от :username',
                ],
            ],

            'channel' => [
                '_' => 'Новое сообщение',

                'pm' => [
                    'channel_message' => ':username написал: ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'от :username',
                ],
            ],

            'channel_team' => [
                '_' => 'Новое сообщение от команды',

                'team' => [
                    'channel_team' => ':username написал: ":title"',
                    'channel_team_compact' => ':username написал: ":title"',
                    'channel_team_group' => ':username написал: ":title"',
                ],
            ],
        ],

        'build' => [
            '_' => 'Список изменений',

            'comment' => [
                '_' => 'Новый комментарий',

                'comment_new' => ':username оставил комметарий ":content" под обновлением ":title"',
                'comment_new_compact' => ':username оставил комментарий ":content"',
                'comment_reply' => ':username ответил ":content" под обновлением ":title"',
                'comment_reply_compact' => ':username ответил ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Новости',

            'comment' => [
                '_' => 'Новый комментарий',

                'comment_new' => ':username оставил комметарий ":content" под новостью ":title"',
                'comment_new_compact' => ':username оставил комментарий ":content"',
                'comment_reply' => ':username ответил ":content" под новостью ":title"',
                'comment_reply_compact' => ':username ответил ":content"',
            ],

            'news_post' => [
                '_' => 'Новости (:series)',

                'news_post_new' => ':title',
                'news_post_new_compact' => ':title',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тема форума',

            'forum_topic_reply' => [
                '_' => 'Новый ответ на форуме',
                'forum_topic_reply' => ':username ответил в теме ":title"',
                'forum_topic_reply_compact' => ':username ответил',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Запрос на вступление в команду',

                'team_application_accept' => "Вы стали участником команды :title",
                'team_application_accept_compact' => "Вы стали участником команды :title",

                'team_application_group' => 'Обновления по запросам на вступление в команду',

                'team_application_reject' => 'Ваш запрос на вступление в команду :title отклонён',
                'team_application_reject_compact' => 'Ваш запрос на вступление в команду :title отклонён',
                'team_application_store' => ':title подал запрос на вступление в вашу команду',
                'team_application_store_compact' => ':title подал запрос на вступление в вашу команду',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Новая карта',

                'user_beatmapset_new' => 'Новая карта ":title" от :username',
                'user_beatmapset_new_compact' => 'Новая карта ":title"',
                'user_beatmapset_new_group' => 'Новые карты от :username',

                'user_beatmapset_revive' => 'Воскрешена карта ":title" от :username',
                'user_beatmapset_revive_compact' => 'Воскрешена карта ":title"',
            ],
        ],

        'user_achievement' => [
            '_' => 'Медали',

            'user_achievement_unlock' => [
                '_' => 'Новая медаль',
                'user_achievement_unlock' => 'Получена медаль ":title"!',
                'user_achievement_unlock_compact' => 'Получена медаль ":title"!',
                'user_achievement_unlock_group' => 'Получены новые медали!',
            ],
        ],
    ],

    'mail' => [
        'news' => '',

        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Вас назначили владельцем сложности на карте ":title" ',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Закрыто обсуждение карты ":title"',
                'beatmapset_discussion_post_new' => 'Новые отзывы в обсуждении карты ":title"',
                'beatmapset_discussion_unlock' => 'Открыто обсуждение карты ":title"',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Новое сообщение о проблеме на карте ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => 'Карта ":title" дисквалифицирована',
                'beatmapset_love' => 'Карте ":title" присвоена категория Любимая',
                'beatmapset_nominate' => 'Карта ":title" номинирована',
                'beatmapset_qualify' => 'Карта ":title" получила достаточно номинаций и вошла в очередь получения рейтинга',
                'beatmapset_rank' => 'Карта ":title" стала Рейтинговой',
                'beatmapset_remove_from_loved' => 'Карта ":title" исключена из категории Любимая',
                'beatmapset_reset_nominations' => 'Сброшена номинация карты ":title"',
            ],

            'comment' => [
                'comment_new' => 'Новые комментарии под картой ":title"',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'Новое объявление в канале ":name"',
            ],
            'channel' => [
                'channel_message' => 'Вы получили новое сообщение от :username',
            ],
            'channel_team' => [
                'channel_team' => 'Новое сообщение в чате команды ":name"',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Новые комментарии под обновлением ":title"',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Новые комментарии под новостью ":title"',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Новые ответы в теме ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Вы стали участником команды :title",
                'team_application_reject' => 'Ваш запрос на вступление в команду :title отклонён',
                'team_application_store' => ':title подал запрос на вступление в вашу команду',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username создал новые карты',
                'user_beatmapset_revive' => ':username воскресил карты',
            ],
        ],
    ],
];
