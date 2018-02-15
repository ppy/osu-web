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
    'not_negative' => ':attribute 不能为负数。',
    'required' => '需要 :attribute。',
    'wrong_confirmation' => '确认信息不匹配。',

    'beatmap_discussion_post' => [
        'first_post' => '无法删除第一个提交。',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '只能给新特性请求投票。',
            'not_enough_feature_votes' => '票数不足。',
        ],

        'poll_vote' => [
            'invalid' => '指定的选项无效。',
        ],

        'topic_poll' => [
            'duplicate_options' => '不允许重复的选项。',
            'invalid_max_options' => '每人可选的选项不能超出总选项数。',
            'minimum_one_selection' => '每人至少可选一项。',
            'minimum_two_options' => '需要至少两个选项。',
            'too_many_options' => '选项数量超出限制。',
        ],

        'topic_vote' => [
            'too_many' => '选项数量超出限制。',
        ],
    ],

    'user' => [
        'contains_username' => '密码不能包含用户名。',
        'email_already_used' => '邮箱已被使用。',
        'invalid_country' => '国家未被数据库收录。',
        'invalid_email' => '无效的邮箱地址。',
        'too_short' => '新密码太短。',
        'unknown_duplicate' => '用户名或邮箱已被使用。',
        'username_too_short' => '用户名太短。',
        'weak' => '弱密码。',
        'wrong_current_password' => '当前密码错误。',
        'wrong_email_confirmation' => '重复新邮箱与新邮箱不一致。',
        'wrong_password_confirmation' => '重复新密码与新密码不一致。',
        'too_long' => '超出长度限制——最多为 :limit 个字符。',
    ],
];
