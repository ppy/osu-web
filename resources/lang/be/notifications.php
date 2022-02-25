<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Усе апавяшчэнні прачытаныя!',
    'delete' => 'Выдаліць :type',
    'loading' => 'Загрузка непрачытаных апавяшчэнняў...',
    'mark_read' => 'Ачысціць :type',
    'none' => 'Няма апавяшчэнняў',
    'see_all' => 'гл. усе апавяшчэнні',
    'see_channel' => 'схадзіць у чат',
    'verifying' => 'Калі ласка, пацвердзіце сеанс для прагляду апавяшчэнняў',

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
                '_' => 'Гасцявая цяжкасць',
                'beatmap_owner_change' => 'Цяпер вы ўладальнік цяжкасці ":beatmap" на бітмапе ":title"',
                'beatmap_owner_change_compact' => 'Цяпер вы ўладальнік цяжкасці ":beatmap"',
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
                'beatmapset_remove_from_loved' => '":title" была выдаленая з Любімых',
                'beatmapset_remove_from_loved_compact' => 'Бітмапа была выдаленая з Любімых',
                'beatmapset_reset_nominations' => 'Праблема, якую размясціў :username выклікала скід намінацыі бітмапы ":title" ',
                'beatmapset_reset_nominations_compact' => 'Намінацыя была скінута',
            ],

            'comment' => [
                '_' => 'Новы каментарый',

                'comment_new' => ':username пракаментаваў ":content" у ":title"',
                'comment_new_compact' => ':username пракаментаваў ":content"',
                'comment_reply' => ':username адказаў ":content" ў ":title"',
                'comment_reply_compact' => ':username адказаў ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Чат',

            'announcement' => [
                '_' => 'Новая аб\'ява',

                'announce' => [
                    'channel_announcement' => ':username сказаў ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Аб\'ява ад :username',
                ],
            ],

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
            '_' => 'Гісторыя змен',

            'comment' => [
                '_' => 'Новы каментарый',

                'comment_new' => ':username пракаментаваў ":content" у ":title"',
                'comment_new_compact' => ':username пракаментаваў ":content"',
                'comment_reply' => ':username адказаў ":content" ў ":title"',
                'comment_reply_compact' => ':username адказаў ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Навіны',

            'comment' => [
                '_' => 'Новы каментарый',

                'comment_new' => ':username пракаментаваў ":content" у ":title"',
                'comment_new_compact' => ':username пракаментаваў ":content"',
                'comment_reply' => ':username адказаў ":content" ў ":title"',
                'comment_reply_compact' => ':username адказаў ":content"',
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
                '_' => 'Новая бітмапа',

                'user_beatmapset_new' => 'Новая бітмапа ":title" ад :username',
                'user_beatmapset_new_compact' => 'Новая бітмапа ":title"',
                'user_beatmapset_new_group' => 'Новая бітмапа ад :username',

                'user_beatmapset_revive' => 'Бітмапа ":title" адноўлена :username',
                'user_beatmapset_revive_compact' => 'Бітмапа ":title" адноўлена',
            ],
        ],

        'user_achievement' => [
            '_' => 'Медалі',

            'user_achievement_unlock' => [
                '_' => 'Новая медаль',
                'user_achievement_unlock' => 'Адкрыта ":title"!',
                'user_achievement_unlock_compact' => 'Адкрыта ":title"!',
                'user_achievement_unlock_group' => 'Медалі разблакаваны!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Цяпер вы госць бітмапы ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Дыскусія пра ":title" была зачынена',
                'beatmapset_discussion_post_new' => 'Дыскусія пра ":title" мае новыя абнаўленні',
                'beatmapset_discussion_unlock' => 'Дыскусія пра ":title" была разблакавана',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Была выяўлена новая праблема на ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" была дыскваліфікавана',
                'beatmapset_love' => '":title" была павышана да Любімых',
                'beatmapset_nominate' => '":title" была намінавана',
                'beatmapset_qualify' => '":title" набраў дастатковую колькасць намінацый і ўвайшоў у чаргу рэйтынгу',
                'beatmapset_rank' => '":title" была ранкавана',
                'beatmapset_remove_from_loved' => '":title" была выдаленая з Любімых',
                'beatmapset_reset_nominations' => 'Намінацыя ":title" была скідана',
            ],

            'comment' => [
                'comment_new' => 'Бітмапа ":title" мае новыя каментарыі',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Вы атрымалі новае паведамленне ад :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Гісторыя зменаў ":title" мае новыя каментарыі',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Навіны ":title" маюць новыя каментарыі',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Ёсць новыя адказы ў ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username разблакаваў нову медаль, ":title"!',
                'user_achievement_unlock_self' => 'Вы разблакавалі нову медаль, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username стварыў новыя бітмапы',
            ],
        ],
    ],
];
