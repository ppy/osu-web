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
            'exhausted' => '今天的提名次数已达上限，请明天再试。',
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

                'not_allowed' => '无法在受限制时发言。',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => '无法在投票结束后更改。',
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
        ],

        'topic' => [
            'reply' => [
                'double_post' => '刚刚发表过回复了，喝口水休息一下，或者编辑上一条回复。',
                'locked' => '无法回复被锁定的主题。',
                'no_forum_access' => '没有权限进入该板块。',
                'no_permission' => '没有回复的权限。',

                'user' => [
                    'require_login' => '回复前请先登录。',
                    'restricted' => '无法在账户受限时回复。',
                    'silenced' => '无法在被禁言时回复。',
                ],
            ],

            'store' => [
                'no_forum_access' => '没有权限进入该板块。',
                'no_permission' => '没有创建新主题的权限。',
                'forum_closed' => '该板块已经关闭，无法发表新主题。',
            ],

            'vote' => [
                'no_forum_access' => '没有权限进入该板块。',
                'over' => '投票已经结束！',
                'voted' => '不允许修改投票。',

                'user' => [
                    'require_login' => '投票前请先登录。',
                    'restricted' => '无法在账户受限时投票。',
                    'silenced' => '无法在账户被禁言时投票。',
                ],
            ],

            'watch' => [
                'no_forum_access' => '没有权限进入该板块。',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '指定的封面不可用。',
                'not_owner' => '只有作者才能编辑封面。',
            ],
        ],

        'view' => [
            'admin_only' => '只有管理员才能查看该板块。',
        ],
    ],

    'require_login' => '登录以进行操作。',

    'unauthorized' => '没有权限。',

    'silenced' => '禁言时无法进行该操作。',

    'restricted' => '受限制时无法进行该操作。',

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
