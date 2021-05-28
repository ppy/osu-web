<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Усе апавяшчэнні прачытаныя!',
    'delete' => '',
    'loading' => '',
    'mark_read' => 'Ачысціць :type',
    'none' => 'Няма апавяшчэнняў',
    'see_all' => 'гл. усе апавяшчэнні',
    'see_channel' => '',
    'verifying' => '',

    'filters' => [
        '_' => 'усе',
        'user' => 'профіль',
        'beatmapset' => 'бітмапы',
        'forum_topic' => 'форум',
        'news_post' => 'навіны',
        'build' => 'зборкі',
        'channel' => 'чат',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Бітмапа',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'Абмеркаванне бітмапы',
                'beatmapset_discussion_lock' => 'Бітмапа ":title" заблакавана для абмеркавання.',
                'beatmapset_discussion_lock_compact' => 'Абмеркаванне было закрыта',
                'beatmapset_discussion_post_new' => ':username размясціў новае паведамленне ў абмеркаванні бітмапы ":title".',
                'beatmapset_discussion_post_new_empty' => 'Новы допіс у ":title" ад :username',
                'beatmapset_discussion_post_new_compact' => 'Новы допіс ад :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Новы допіс ад :username',
                'beatmapset_discussion_review_new' => 'Новы водгук  на ":title" ад :username, які змяшчае праблемы: :problems, прапановы: :suggestions, хвалы: :praises',
                'beatmapset_discussion_review_new_compact' => 'Новы водгук ад :username, які змяшчае праблемы: :problems, прапановы: :suggestions, хвалы: :praises',
                'beatmapset_discussion_unlock' => 'Бітмапа ":title" разблакава для абмеркавання.',
                'beatmapset_discussion_unlock_compact' => 'Абмеркаванне было адкрыта',
            ],

            'beatmapset_problem' => [
                '_' => 'Праблема з кваліфікаванай картай',
                'beatmapset_discussion_qualified_problem' => 'Скарга ад :username: на ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Скарга ад :username на ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Скарга ад :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Скарга ад :username',
            ],

            'beatmapset_state' => [
                '_' => 'Стан бітмапы зменены',
                'beatmapset_disqualify' => 'Бітмапа ":title" была дыскваліфікавана :username.',
                'beatmapset_disqualify_compact' => 'Бітмапа была дыскваліфікавана',
                'beatmapset_love' => ':username надаў стан loved бітмапе ":title".',
                'beatmapset_love_compact' => 'Бітмапа атрымала стан loved',
                'beatmapset_nominate' => 'Бітмапа ":title" была намінавана :username.',
                'beatmapset_nominate_compact' => 'Бітмапа была намінава',
                'beatmapset_qualify' => 'Бітмапа ":title" было надана дастаткова намінацый для чакання ранга.',
                'beatmapset_qualify_compact' => 'Бітмапа далучылася да чаргі рэйтынгу',
                'beatmapset_rank' => '":title" была ранкавана',
                'beatmapset_rank_compact' => 'Бітмапа была ранкавана',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => 'Праблема, якую размясціў :username выклікала скід намінацыі бітмапы ":title" ',
                'beatmapset_reset_nominations_compact' => 'Намінацыя была скінута',
            ],

            'comment' => [
                '_' => 'Новы каментарый',

                'comment_new' => ':username пракаментаваў ":content" у ":title"',
                'comment_new_compact' => ':username пракаментаваў ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'Чат',

            'channel' => [
                '_' => 'Новае паведамленне',
                'pm' => [
                    'channel_message' => ':username сказаў ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'ад :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Спic змен',

            'comment' => [
                '_' => 'Новы каментарый',

                'comment_new' => ':username пракаментаваў ":content" у ":title"',
                'comment_new_compact' => ':username пракаментаваў ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Навіны',

            'comment' => [
                '_' => 'Новы каментарый',

                'comment_new' => ':username пракаментаваў ":content" у ":title"',
                'comment_new_compact' => ':username пракаментаваў ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тэма форуму',

            'forum_topic_reply' => [
                '_' => 'Новы адказ на форуме',
                'forum_topic_reply' => 'карыстальнік :username адказаў у тэме ":title".',
                'forum_topic_reply_compact' => ':username адказаў',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Правілы Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited непрачытанае паведамленне.|:count_delimited ннепрачытанныя паведамленні.',
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
            '_' => 'Медалі',

            'user_achievement_unlock' => [
                '_' => 'Новая медаль',
                'user_achievement_unlock' => 'Адкрыта ":title"!',
                'user_achievement_unlock_compact' => 'Адкрыта ":title"!',
                'user_achievement_unlock_group' => '',
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
                'beatmapset_remove_from_loved' => '',
                'beatmapset_reset_nominations' => '',
            ],

            'comment' => [
                'comment_new' => '',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => '',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => '',
                'user_achievement_unlock_self' => '',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => '',
            ],
        ],
    ],
];
