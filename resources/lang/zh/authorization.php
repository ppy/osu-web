<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => '无法撤销推荐。',
            'has_reply' => '无法删除有回复的讨论。',
        ],
        'nominate' => [
            'exhausted' => '你今天的提名次数已达上限，请明天再试。',
            'incorrect_state' => '操作出错了，请尝试刷新页面。',
            'owner' => "不能提名自己的谱面。",
        ],
        'resolve' => [
            'not_owner' => '只有楼主和谱面所有者才能标记为已解决。',
        ],

        'store' => [
            'mapper_note_wrong_user' => '只有谱面作者或谱面管理团队、质量保证团队成员可以发布备注。',
        ],

        'vote' => [
            'limit_exceeded' => '在投更多票之前请稍等一会。',
            'owner' => "不能为自己的讨论投票！",
            'wrong_beatmapset_state' => '只能给 pending 谱面的讨论投票。',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => '无法编辑自动回复。',
            'not_owner' => '只有作者可以编辑。',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => '没有权限进入该频道。',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => '需要有指定频道的权限。',
                    'moderated' => '频道已满。',
                    'not_lazer' => '当前只能在 #lazer 聊天。',
                ],

                'not_allowed' => '账户处于限制模式，无法发言。',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => '投票已结束，无法修改投票。',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => '只有最后的回复可以被删除。',
                'locked' => '无法删除被锁定主题的回复。',
                'no_forum_access' => '没有权限进入该板块。',
                'not_owner' => '只有作者能删除此回复。',
            ],

            'edit' => [
                'deleted' => '无法编辑已删除的回复。',
                'locked' => '此回复已被锁定。',
                'no_forum_access' => '没有权限进入该板块。',
                'not_owner' => '只有作者能编辑此回复。',
                'topic_locked' => '无法编辑被锁定主题的回复。',
            ],

            'store' => [
                'play_more' => '在发帖之前先玩上两局吧！如果你在游戏时遇到问题，请在 Help and Support 版块发帖求助。',
                'too_many_help_posts' => "如果你想发更多的帖子，再多玩几把吧！如果你仍然在游戏时遇到问题请邮件联系 support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '请编辑您的最后一条评论, 而不是多次发表。',
                'locked' => '无法回复被锁定的主题。',
                'no_forum_access' => '没有权限，无法进入该板块。',
                'no_permission' => '没有权限，无法回复。',

                'user' => [
                    'require_login' => '回复前请先登录。',
                    'restricted' => "账户处于限制模式，无法回复。",
                    'silenced' => "账户被禁言，无法回复。",
                ],
            ],

            'store' => [
                'no_forum_access' => '没有权限，无法进入该板块。',
                'no_permission' => '没有权限，无法创建新主题。',
                'forum_closed' => '该板块已关闭，无法发表新主题。',
            ],

            'vote' => [
                'no_forum_access' => '没有权限，无法进入该板块。',
                'over' => '投票已结束！',
                'voted' => '不允许修改投票。',

                'user' => [
                    'require_login' => '投票前请先登录。',
                    'restricted' => "账户处于限制模式，无法投票。",
                    'silenced' => "账户被禁言，无法投票。",
                ],
            ],

            'watch' => [
                'no_forum_access' => '没有权限，无法进入该板块。',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '指定的头图不可用。',
                'not_owner' => '只有楼主可以编辑头图。',
            ],
        ],

        'view' => [
            'admin_only' => '该板块仅限管理员查看。',
        ],
    ],

    'require_login' => '登录以继续。',

    'unauthorized' => '没有权限。',

    'silenced' => "账户被禁言，无法进行该操作。",

    'restricted' => "账户处于限制模式，无法进行该操作。",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '个人页面被锁定。',
                'not_owner' => '只能编辑自己的个人页面。',
                'require_supporter_tag' => '需要成为支持者。',
            ],
        ],
    ],
];
