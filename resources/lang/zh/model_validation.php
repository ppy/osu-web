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
    'not_negative' => ':attribute 不能为负数。',
    'required' => '需要 :attribute 。',
    'too_long' => ':attribute 超出最大长度——最多允许 :limit 个字符。',
    'wrong_confirmation' => '确认信息不匹配。',

    'beatmap_discussion_post' => [
        'discussion_locked' => '讨论被锁定。',
        'first_post' => '无法删除第一个讨论。',

        'attributes' => [
            'message' => '消息',
        ],
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => '指定了时间戳但是谱面不存在。',
        'beatmapset_no_hype' => "无法推荐谱面。",
        'hype_requires_null_beatmap' => '只能在 常规（全难度） 中推荐。',
        'invalid_beatmap_id' => '指定的难度无效。',
        'invalid_beatmapset_id' => '指定的谱面无效。',
        'locked' => '讨论被锁定。',

        'attributes' => [
            'message_type' => '消息类型',
            'timestamp' => '时间戳',
        ],

        'hype' => [
            'guest' => '登录后才能推荐',
            'hyped' => '你已经推荐了这张谱面',
            'limit_exceeded' => '你已经用光了推荐次数',
            'not_hypeable' => '这张谱面无法推荐',
            'owner' => '不能推荐你自己的谱面',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '指定的时间戳不在谱面范围内。',
            'negative' => "无法定位时间戳。",
        ],
    ],

    'comment' => [
        'deleted_parent' => '不能回复已删除的评论。',

        'attributes' => [
            'message' => '消息',
        ],
    ],

    'follow' => [
        'invalid' => '指定的 :attribute 无效。',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '只能给新特性请求投票。',
            'not_enough_feature_votes' => '票数不足。',
        ],

        'poll_vote' => [
            'invalid' => '指定的选项无效。',
        ],

        'post' => [
            'beatmapset_post_no_delete' => '不允许删除谱面信息帖。',
            'beatmapset_post_no_edit' => '不允许编辑谱面信息帖。',
            'only_quote' => '你的回复仅包含引用',

            'attributes' => [
                'post_text' => '帖子主体',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => '主题标题',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => '不允许重复的选项。',
            'grace_period_expired' => '不能编辑发起已经超过 :limit 小时的投票',
            'hiding_results_forever' => '不能隐藏尚未结束投票的结果。',
            'invalid_max_options' => '每人可选的选项不能超出总选项数。',
            'minimum_one_selection' => '每人至少可选一项。',
            'minimum_two_options' => '需要至少两个选项。',
            'too_many_options' => '选项数量超出限制。',

            'attributes' => [
                'title' => '投票标题',
            ],
        ],

        'topic_vote' => [
            'required' => '至少选择一项以投票',
            'too_many' => '选项数量超出限制。',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'OAuth 应用数量超出限制。',
            'url' => '请输入一个有效的 URL。',

            'attributes' => [
                'name' => '应用名称',
                'redirect' => '应用回调 URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => '密码不能包含用户名。',
        'email_already_used' => '邮箱已被使用。',
        'invalid_country' => '国家未被数据库收录。',
        'invalid_discord' => 'Discord 用户名无效。',
        'invalid_email' => "无效的邮箱地址。",
        'too_short' => '新密码太短。',
        'unknown_duplicate' => '用户名或邮箱已被使用。',
        'username_available_in' => '该用户名将在 :duration 后可用。',
        'username_available_soon' => '该用户名即将可用！',
        'username_invalid_characters' => '用户名中包含非法字符。',
        'username_in_use' => '用户名已经被使用！',
        'username_locked' => '用户名已被使用！', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => '请在下划线和空格间选一个，不要混用！',
        'username_no_spaces' => "用户名不能以空格开头或结束。",
        'username_not_allowed' => '不允许使用该用户名。',
        'username_too_short' => '用户名太短。',
        'username_too_long' => '用户名太长。',
        'weak' => '弱密码。',
        'wrong_current_password' => '当前密码错误。',
        'wrong_email_confirmation' => '重复新邮箱与新邮箱不一致。',
        'wrong_password_confirmation' => '重复新密码与新密码不一致。',
        'too_long' => '超出长度限制——最多为 :limit 个字符。',

        'attributes' => [
            'username' => '用户名',
            'user_email' => '电子邮件地址',
            'password' => '密码',
        ],

        'change_username' => [
            'restricted' => '账户受限时不能变更用户名。',
            'supporter_required' => [
                '_' => '你必须 :link 才能更改用户名！',
                'link_text' => '支持 osu!',
            ],
            'username_is_same' => '这就是你的用户名，Baka！',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => ':reason 不符合此报告类型。',
        'self' => "无法举报自己",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => '数量',
                'cost' => '价格',
            ],
        ],
    ],
];
