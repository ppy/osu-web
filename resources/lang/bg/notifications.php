<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Всички известия са прочетени!',
    'delete' => '',
    'loading' => '',
    'mark_read' => 'Изчисти :type',
    'none' => 'Няма известия',
    'see_all' => 'виж всички известия',
    'see_channel' => '',
    'verifying' => '',

    'filters' => [
        '_' => 'всички',
        'user' => 'профил',
        'beatmapset' => 'бийтмапове',
        'forum_topic' => 'форум',
        'news_post' => 'новини',
        'build' => 'версии',
        'channel' => 'чат',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Бийтмап',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'Бийтмап дискусия',
                'beatmapset_discussion_lock' => 'Бийтмапът ":title" бе заключен за дискусии',
                'beatmapset_discussion_lock_compact' => 'Дискусията бе заключена',
                'beatmapset_discussion_post_new' => 'Нова публикация на ":title" от :username": ":content"',
                'beatmapset_discussion_post_new_empty' => 'Нова публикация на ":title" от :username',
                'beatmapset_discussion_post_new_compact' => 'Нова публикация от :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Нова публикация от :username',
                'beatmapset_discussion_review_new' => 'Ново ревю на ":title" от :username, съдържащ проблеми: :problems, предложения: :suggestions, похвали: :praises',
                'beatmapset_discussion_review_new_compact' => 'Ново ревю от :username, съдържащ проблеми: :problems, предложения: :suggestions, похвали: :praises',
                'beatmapset_discussion_unlock' => 'Бийтмапът ":title" бе отключен за дискусии',
                'beatmapset_discussion_unlock_compact' => 'Дискусията бе отключена',
            ],

            'beatmapset_problem' => [
                '_' => 'Проблем на квалифициран бийтмап',
                'beatmapset_discussion_qualified_problem' => 'Докладвано от :username на":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Докладвано от :username на":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Докладвано от :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Докладвано от :username',
            ],

            'beatmapset_state' => [
                '_' => 'Промяна в статуса на бийтмапа',
                'beatmapset_disqualify' => '":title" бе дисквалифициран',
                'beatmapset_disqualify_compact' => 'Бийтмапът бе дисквалифициран',
                'beatmapset_love' => '":title" бе повишен до обичан',
                'beatmapset_love_compact' => 'Бийтмапът бе повишен до обичан',
                'beatmapset_nominate' => '":title" бе номиниран',
                'beatmapset_nominate_compact' => 'Бийтмапът бе номиниран',
                'beatmapset_qualify' => '":title" получи достатъчно номинации и влезе в опашката за класиране',
                'beatmapset_qualify_compact' => 'Бийтмапът влезе на опашката за класиране',
                'beatmapset_rank' => '":title" бе класиран',
                'beatmapset_rank_compact' => 'Бийтмапът бе класиран',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => 'Бийтмапът бе премахнат от Обичани',
                'beatmapset_reset_nominations' => 'Номинацията на ":title" бе анулирана',
                'beatmapset_reset_nominations_compact' => 'Номинацията бе анулирана',
            ],

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в темата ":title"',
                'comment_new_compact' => ':username коментира ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => ':username отговори в темата ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Чат',

            'channel' => [
                '_' => 'Ново съобщение',
                'pm' => [
                    'channel_message' => ':username казва ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'от :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Списък на промените',

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в темата ":title"',
                'comment_new_compact' => ':username коментира ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Новини',

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в темата ":title"',
                'comment_new_compact' => ':username коментира ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тема на форума',

            'forum_topic_reply' => [
                '_' => 'Нов форум отговор',
                'forum_topic_reply' => ':username отговори в темата ":title"',
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
                '_' => '',

                'user_beatmapset_new' => '',
                'user_beatmapset_new_compact' => '',
                'user_beatmapset_new_group' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Медали',

            'user_achievement_unlock' => [
                '_' => 'Нов медал',
                'user_achievement_unlock' => 'Отключихте ":title"!',
                'user_achievement_unlock_compact' => 'Отключихте ":title"!',
                'user_achievement_unlock_group' => 'Медали отключени!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_unlock' => '',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '',
                'beatmapset_love' => '',
                'beatmapset_nominate' => '',
                'beatmapset_qualify' => '',
                'beatmapset_rank' => '',
                'beatmapset_remove_from_loved' => '":title" бе премахнат от Обичани',
                'beatmapset_reset_nominations' => 'Номинацията на ":title" бе анулирана',
            ],

            'comment' => [
                'comment_new' => 'Бийтмап ":title" има нови коментари',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Ти получи ново съобщение от :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Новини ":title" има нови коментари ',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Има нови отговори от ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username отключи нов медал, ":title"!',
                'user_achievement_unlock_self' => 'Вие отключихте нов медал, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => '',
            ],
        ],
    ],
];
