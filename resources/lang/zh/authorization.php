<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '为何不先玩几局 osu! 呢？',
    'require_login' => '登录以继续。',
    'require_verification' => '请验证以继续。',
    'restricted' => "账户处于限制模式，无法进行该操作。",
    'silenced' => "账户被禁言，无法进行该操作。",
    'unauthorized' => '拒绝访问。',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => '无法撤销推荐。',
            'has_reply' => '无法删除有回复的讨论。',
        ],
        'nominate' => [
            'exhausted' => '你今天的提名次数已达上限，请明天再试。',
            'incorrect_state' => '操作出错了，请尝试刷新页面。',
            'owner' => "不能提名自己的谱面。",
            'set_metadata' => '您必须在提名之前设置流派和语言。',
        ],
        'resolve' => [
            'not_owner' => '只有楼主和谱面所有者才能标记为已解决。',
        ],

        'store' => [
            'mapper_note_wrong_user' => '只有谱面作者或谱面管理团队、质量保证团队成员可以发布备注。',
        ],

        'vote' => [
            'bot' => "不能对机器人的讨论投票",
            'limit_exceeded' => '在投更多票之前请稍等一会。',
            'owner' => "不能为自己的讨论投票！",
            'wrong_beatmapset_state' => '只能给 pending 谱面的讨论投票。',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '你只能删除你自己的帖子。',
            'resolved' => '你不能删除已解决的讨论帖。',
            'system_generated' => '自动生成的帖子无法删除。',
        ],

        'edit' => [
            'not_owner' => '只有作者可以编辑。',
            'resolved' => '你不能编辑已解决讨论里的帖子。',
            'system_generated' => '无法编辑自动回复。',
        ],

        'store' => [
            'beatmapset_locked' => '该谱面因需要探讨而被锁定。',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => '您不能更改已提名的谱面信息。如果您认为其不正确，请联系谱面管理团队或质量保障团队进行更改。',
        ],
    ],

    'chat' => [
        'blocked' => '无法向你已拉黑的用户发消息，或者你已经被对方拉黑了。',
        'friends_only' => '用户阻止了来自非好友的消息。',
        'moderated' => '该频道现在正在被管制中。',
        'no_access' => '你没有权限访问该频道。',
        'restricted' => '账户被禁言、受限或封禁期间不能发消息。',
        'silenced' => '账户被禁言、受限或封禁期间不能发消息。',
    ],

    'comment' => [
        'update' => [
            'deleted' => "无法编辑已删除的回复。",
        ],
    ],

    'contest' => [
        'voting_over' => '投票已结束，无法修改投票。',

        'entry' => [
            'limit_reached' => '您提交的参赛文件大小超出限制',
            'over' => '感谢参与！提交已经关闭，投票即将开始。',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => '没有权限编辑该板块。',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => '只有最后的回复可以被删除。',
                'locked' => '无法删除已锁定主题的回复。',
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
                'play_more' => '在发帖之前先玩上两局吧！如果你在游戏时遇到问题，请在 Help 或 中文 版块发帖求助。',
                'too_many_help_posts' => "如果你想发更多的帖子，再多玩几把吧！如果你仍然在游戏时遇到问题请邮件联系 support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '请编辑您的最后一条评论，而不是再发一遍。',
                'locked' => '无法回复被锁定的主题。',
                'no_forum_access' => '没有权限进入该板块。',
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
                'play_more' => '你需要再多玩一会游戏才能在论坛中投票。',
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
                'uneditable' => '指定的封面不可用。',
                'not_owner' => '只有楼主可以编辑封面。',
            ],
            'store' => [
                'forum_not_allowed' => '本论坛不接受主题涵盖范围。',
            ],
        ],

        'view' => [
            'admin_only' => '该板块仅限管理员查看。',
        ],
    ],

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
