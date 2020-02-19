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
    'all_read' => 'Усе апавяшчэнні прачытаныя!',
    'mark_all_read' => 'Ачысціць усё',
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
            '_' => 'Бітмапа',

            'beatmapset_discussion' => [
                '_' => 'Абмеркаванне бітмапы',
                'beatmapset_discussion_lock' => 'Бітмапа ":title" заблакавана для абмеркавання.',
                'beatmapset_discussion_lock_compact' => 'Абмеркаванне было закрыта',
                'beatmapset_discussion_post_new' => ':username размясціў новае паведамленне ў абмеркаванні бітмапы ":title".',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Новы допіс ад :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Бітмапа ":title" разблакава для абмеркавання.',
                'beatmapset_discussion_unlock_compact' => 'Абмеркаванне было адкрыта',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
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
                'beatmapset_reset_nominations' => 'Праблема, якую размясціў :username выклікала скід намінацыі бітмапы ":title" ',
                'beatmapset_reset_nominations_compact' => 'Намінацыя была скінута',
            ],

            'comment' => [
                '_' => 'Новы каментарый',

                'comment_new' => ':username пракаментаваў ":content" у ":title"',
                'comment_new_compact' => ':username пракаментаваў ":content"',
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
            ],
        ],

        'news_post' => [
            '_' => 'Навіны',

            'comment' => [
                '_' => 'Новы каментарый',

                'comment_new' => ':username пракаментаваў ":content" у ":title"',
                'comment_new_compact' => ':username пракаментаваў ":content"',
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

        'user_achievement' => [
            '_' => 'Медалі',

            'user_achievement_unlock' => [
                '_' => 'Новая медаль',
                'user_achievement_unlock' => 'Адкрыта ":title"!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
