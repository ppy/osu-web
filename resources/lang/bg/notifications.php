<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Всички известия са прочетени!',
    'delete' => 'Изтрий :type',
    'loading' => 'Зареждане на непрочетени известия...',
    'mark_read' => 'Изчисти :type',
    'none' => 'Няма известия',
    'see_all' => 'виж всички известия',
    'see_channel' => 'към чат',
    'verifying' => 'Моля, потвърдете сесията, за преглед на известия',

    'filters' => [
        '_' => 'всички',
        'user' => 'профил',
        'beatmapset' => 'бийтмапове',
        'forum_topic' => 'форум',
        'news_post' => 'новини',
        'build' => 'промени',
        'channel' => 'чат',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Бийтмап',

            'beatmap_owner_change' => [
                '_' => 'Бийтмап трудност',
                'beatmap_owner_change' => 'Вече притежавате трудността за ":beatmap" от бийтмап ":title"',
                'beatmap_owner_change_compact' => 'Вече притежавате трудността за ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Бийтмап дискусия',
                'beatmapset_discussion_lock' => 'Дискусията е заключена за ":title"',
                'beatmapset_discussion_lock_compact' => 'Дискусията е заключена',
                'beatmapset_discussion_post_new' => 'Нова публикация в ":title" от :username": ":content"',
                'beatmapset_discussion_post_new_empty' => 'Нова публикация в ":title" от :username',
                'beatmapset_discussion_post_new_compact' => 'Нова публикация от :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Нова публикация от :username',
                'beatmapset_discussion_review_new' => 'Ново ревю в ":title" от :username, съдържащи проблеми: :problems, предложения: :suggestions, похвали: :praises',
                'beatmapset_discussion_review_new_compact' => 'Ново ревю от :username, съдържащи проблеми: :problems, предложения: :suggestions, похвали: :praises',
                'beatmapset_discussion_unlock' => 'Дискусията е отключена за ":title"',
                'beatmapset_discussion_unlock_compact' => 'Дискусията е отключена',
            ],

            'beatmapset_problem' => [
                '_' => 'Проблем с Квалифициран Бийтмап',
                'beatmapset_discussion_qualified_problem' => 'Докладвано от :username в ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Докладвано от :username в ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Докладвано от :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Докладвано от :username',
            ],

            'beatmapset_state' => [
                '_' => 'Промяна в статуса на бийтмап',
                'beatmapset_disqualify' => '":title" е дисквалифициран',
                'beatmapset_disqualify_compact' => 'Бийтмапът е дисквалифициран',
                'beatmapset_love' => '":title" е избран като Обичан',
                'beatmapset_love_compact' => 'Бийтмапът е избран като Обичан',
                'beatmapset_nominate' => '":title" е номиниран',
                'beatmapset_nominate_compact' => 'Бийтмапът е номиниран',
                'beatmapset_qualify' => '":title" получи достатъчно номинации и влезе в опашката за класиране',
                'beatmapset_qualify_compact' => 'Бийтмапът влезе в опашката за класиране',
                'beatmapset_rank' => '":title" е класиран',
                'beatmapset_rank_compact' => 'Бийтмапът е класиран',
                'beatmapset_remove_from_loved' => '":title" е премахнат от Обичани',
                'beatmapset_remove_from_loved_compact' => 'Бийтмапът е премахнат от Обичани',
                'beatmapset_reset_nominations' => 'Номинацията на ":title" е анулирана',
                'beatmapset_reset_nominations_compact' => 'Номинацията е анулирана',
            ],

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в ":title"',
                'comment_new_compact' => ':username коментира ":content"',
                'comment_reply' => ':username отговори ":content" в ":title"',
                'comment_reply_compact' => ':username отговори в ":content"',
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
                '_' => 'Ново съобщение',

                'pm' => [
                    'channel_message' => ':username каза ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'от :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Списък с промени',

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в дискусията ":title"',
                'comment_new_compact' => ':username коментира ":content"',
                'comment_reply' => ':username отговори ":content" в ":title"',
                'comment_reply_compact' => ':username отговори ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Новини',

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в ":title"',
                'comment_new_compact' => ':username коментира ":content"',
                'comment_reply' => ':username отговори ":content" в ":title"',
                'comment_reply_compact' => ':username отговори ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Дискусия',

            'forum_topic_reply' => [
                '_' => 'Отговор във форум',
                'forum_topic_reply' => ':username отговори в ":title"',
                'forum_topic_reply_compact' => ':username отговори',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Стар форум за ЛС',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited непрочетено съобщение|:count_delimited непрочетени съобщения',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Нов бийтмап',

                'user_beatmapset_new' => 'Нов бийтмап ":title" от :username',
                'user_beatmapset_new_compact' => 'Нов бийтмап ":title"',
                'user_beatmapset_new_group' => 'Нов бийтмап от :username',

                'user_beatmapset_revive' => 'Бийтмапът ":title" е съживен от :username',
                'user_beatmapset_revive_compact' => 'Бийтмапът ":title" е съживен',
            ],
        ],

        'user_achievement' => [
            '_' => 'Медали',

            'user_achievement_unlock' => [
                '_' => 'Нов медал',
                'user_achievement_unlock' => 'Отключихте ":title"!',
                'user_achievement_unlock_compact' => 'Отключихте ":title"!',
                'user_achievement_unlock_group' => 'Отключен е медал!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Вече притежавате бийтмапа ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Дискусията за ":title" е заключена',
                'beatmapset_discussion_post_new' => 'Дискусията за ":title" има новости',
                'beatmapset_discussion_unlock' => 'Дискусията за ":title" е отключена',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Докладван е проблем за ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" е дисквалифициран',
                'beatmapset_love' => '":title" е избран като Обичан',
                'beatmapset_nominate' => '":title" е номиниран',
                'beatmapset_qualify' => '":title" получи достатъчно номинации и влезе в опашката за класиране',
                'beatmapset_rank' => '":title" е класиран',
                'beatmapset_remove_from_loved' => '":title" е премахнат от Обичани',
                'beatmapset_reset_nominations' => 'Номинацията на ":title" е анулирана',
            ],

            'comment' => [
                'comment_new' => 'Бийтмап ":title" има нов коментар',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Получи ново съобщение от :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'В списък с промените ":title" има нов коментар',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Новина ":title" има нов коментар',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Има нов отговор в ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username отключи нов медал, ":title"!',
                'user_achievement_unlock_self' => 'Отключихте нов медал, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username създаде нов бийтмап',
            ],
        ],
    ],
];
