<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Всі сповіщення прочитані!',
    'delete' => 'Видалити :type',
    'loading' => 'Завантажити непрочитані сповіщення...',
    'mark_read' => 'Очистити :type',
    'none' => 'Немає повідомлень',
    'see_all' => 'див. всі сповіщення ',
    'see_channel' => 'перейти до чату',
    'verifying' => 'Будь ласка, перевірте сеанс, щоб переглянути сповіщення',

    'filters' => [
        '_' => 'усе',
        'user' => 'профіль',
        'beatmapset' => 'карти',
        'forum_topic' => 'форум',
        'news_post' => 'новини',
        'build' => 'збiрки',
        'channel' => 'чат',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Карта',

            'beatmap_owner_change' => [
                '_' => 'Гостьова складність',
                'beatmap_owner_change' => 'Тепер ви власник складності ":beatmap" для карти ":title"',
                'beatmap_owner_change_compact' => 'Тепер ви власник складності ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Обговорення карти',
                'beatmapset_discussion_lock' => 'Карта ":title" заблокована для обговорень.',
                'beatmapset_discussion_lock_compact' => 'Обговорення закрито',
                'beatmapset_discussion_post_new' => ':username опублікував нове повідомлення в обговореннях карти ":title".',
                'beatmapset_discussion_post_new_empty' => 'Новий пост в ":title" вiд :username',
                'beatmapset_discussion_post_new_compact' => 'Нова публікація від :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Нова публікація від :username',
                'beatmapset_discussion_review_new' => 'Новий відгук на ":title" від :username, що містить проблеми: :problems, пропозиції: :suggestions, похвали: :praises',
                'beatmapset_discussion_review_new_compact' => 'Новий відгук від :username, що містить проблеми: :problems, пропозиції: :suggestions, похвали: :praises',
                'beatmapset_discussion_unlock' => 'Карта ":title" розблокована для обговорень.',
                'beatmapset_discussion_unlock_compact' => 'Обговорення відкрито',
            ],

            'beatmapset_problem' => [
                '_' => 'Проблема з кваліфікованої картою',
                'beatmapset_discussion_qualified_problem' => 'Скарга від :username на ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Скарга від :username на ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Скарга від :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Скарга від :username',
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
                'beatmapset_rank_compact' => 'Карта була ранкнута',
                'beatmapset_remove_from_loved' => '":title" вилучений з Улюблені',
                'beatmapset_remove_from_loved_compact' => 'Бітмапа була вилучена з Улюблені',
                'beatmapset_reset_nominations' => 'Проблема опублікована :username викликала скидання процесу номінації карти ":title" ',
                'beatmapset_reset_nominations_compact' => 'Номінацію було скинуто',
            ],

            'comment' => [
                '_' => 'Новий коментар',

                'comment_new' => ':username прокоментував ":content" у ":title"',
                'comment_new_compact' => ':username прокоментував ":content"',
                'comment_reply' => ':username відповів ":content" на ":title"',
                'comment_reply_compact' => ':username відповів ":content"',
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

                'comment_new' => ':username прокоментував ":content" на ":title"',
                'comment_new_compact' => ':username прокоментував ":content"',
                'comment_reply' => ':username відповів ":content" на ":title"',
                'comment_reply_compact' => ':username відповів: ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Новини',

            'comment' => [
                '_' => 'Новий коментар',

                'comment_new' => ':username прокоментував ":content" на ":title"',
                'comment_new_compact' => ':username прокоментував ":content"',
                'comment_reply' => ':username відповів ":content" на ":title"',
                'comment_reply_compact' => ':username відповів: ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тема форуму',

            'forum_topic_reply' => [
                '_' => 'Нова відповідь на форумі',
                'forum_topic_reply' => ':username відповів в темі ":title".',
                'forum_topic_reply_compact' => ':username відповів',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Вхідні повідомлення старого форуму',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited непрочитане повідомлення.|:count_delimited непрочитані повідомлення.',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Нова бітмапа',

                'user_beatmapset_new' => 'Нова бітмапа ":title" від :username',
                'user_beatmapset_new_compact' => 'Нова бітмапа ":title"',
                'user_beatmapset_new_group' => 'Нова бітмапа від :username',

                'user_beatmapset_revive' => '',
                'user_beatmapset_revive_compact' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Досягнення',

            'user_achievement_unlock' => [
                '_' => 'Нова медаль',
                'user_achievement_unlock' => 'Розблоковано ":title"!',
                'user_achievement_unlock_compact' => 'Розблоковано ":title"!',
                'user_achievement_unlock_group' => 'Медалі розблоковано!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Ви тепер гість на карті ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Обговорення в ":title" закрито',
                'beatmapset_discussion_post_new' => 'Обговорення на ":title" має нові оновлення',
                'beatmapset_discussion_unlock' => 'Тема ":title" була розблокована',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Повідомлено про нову проблему на ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" було дискваліфіковано',
                'beatmapset_love' => '":title" підвищено до коханого',
                'beatmapset_nominate' => '":title" було номіновано',
                'beatmapset_qualify' => '":title" отримав достатню кількість номінацій і увійшов до черги рейтингу',
                'beatmapset_rank' => '":title" було оцінено',
                'beatmapset_remove_from_loved' => '":title" видалений з Улюблені',
                'beatmapset_reset_nominations' => 'Номінація ":title" була скинута',
            ],

            'comment' => [
                'comment_new' => 'У карті ":title" були знайдені нові коментарі',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Ви отримали нове повідомлення від :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'У changelog\'а ":title" були знайдені нові коментарі',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'У новини ":title" були знайдені нові комментарі',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Є нові відповіді в ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username розблокував нову медаль, ":title"!',
                'user_achievement_unlock_self' => 'Ви розблокували нову медаль, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username створив нову бітмапу',
            ],
        ],
    ],
];
