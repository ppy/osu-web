<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'has_reply' => '无法删除有回复的讨论',
        ],
        'nominate' => [
            'exhausted' => '您今天的提名次数已达上限，请明天再试。',
        ],
        'resolve' => [
            'not_owner' => '只有楼主和谱面所有者才能标记为已解决。',
        ],

        'vote' => [
            'limit_exceeded' => '在投更多票之前请稍等一会',
            'owner' => '不能为自己的讨论投票！',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => '无法编辑自动回复。',
            'not_owner' => '只有发帖人可以编辑。',
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
                    'not_lazer' => '您当前只能在 #lazer 聊天。',
                ],

                'not_allowed' => '无法在受限制时发言。',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => '您不能在投票结束后变更您的投票。',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => '只有最后的回复可以被删除。',
                'locked' => '不能删除被锁定主题的回复。',
                'no_forum_access' => '没有权限进入该板块。',
                'not_owner' => '只有发表此回复的人才能删除此回复。',
            ],

            'edit' => [
                'locked' => '此回复已被锁定。',
                'no_forum_access' => '没有权限进入该板块。',
                'not_owner' => '只有发表此回复的人才能编辑此回复。',
                'topic_locked' => '不能编辑被锁定主题的回复。',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '您刚刚发表过回复了，请稍等一会，或者编辑您的上一条回复。',
                'locked' => '不能回复被锁定的主题。',
                'no_forum_access' => '没有权限进入该板块。',
                'no_permission' => '没有回复的权限。',

                'user' => [
                    'require_login' => '回复前请先登录。',
                    'restricted' => '账户受限制时不能回复。',
                    'silenced' => '被禁言时不能回复。',
                ],
            ],

            'store' => [
                'no_forum_access' => '没有权限进入该板块。',
                'no_permission' => '没有创建新主题的权限。',
                'forum_closed' => '该板块被关闭，不能发表新主题。',
            ],

            'vote' => [
                'no_forum_access' => '没有权限进入该板块。',
                'over' => '投票已经结束，无法投票。',
                'voted' => '不允许改变投票。',

                'user' => [
                    'require_login' => '投票前请先登录。',
                    'restricted' => '账户受限制时不能投票。',
                    'silenced' => '被禁言时不能回复。',
                ],
            ],

            'watch' => [
                'no_forum_access' => '没有权限进入该板块。',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '指定的封面不可用。',
                'not_owner' => '只有楼主才能编辑封面。',
            ],
        ],

        'view' => [
            'admin_only' => '只有管理员才能查看该板块。',
        ],
    ],

    'require_login' => '请先登录以进行操作。',

    'unauthorized' => '没有权限。',

    'silenced' => '您已被禁言，无法进行该操作。',

    'restricted' => '您已受限制，无法进行该操作。',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '用户界面被锁定。',
                'not_owner' => '只能编辑自己的用户界面。',
                'require_supporter_tag' => '需要成为支持者。',
            ],
        ],
    ],
];
