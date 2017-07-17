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
    'required' => '需要 :attribute.',
    'wrong_confirmation' => '确认信息不匹配。', //需要上下文,

    'beatmap_discussion_post' => [
        'first_post' => '无法删除第一个提交。',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '只能投票给新特性请求。',
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
            'too_many' => '选择了太多的选项。',
        ],
    ],

    'user_email' => [
        'invalid' => '似乎不是有效的邮箱地址。',
        'already_used' => '邮箱已被使用。',
        'wrong_confirmation' => '重复新邮箱与新邮箱不一致。',
        'wrong_current_password' => '当前密码错误。',
    ],

    'user_password' => [
        'contains_username' => '密码不能包含用户名。',
        'too_short' => '新密码太短。',
        'weak' => '弱密码。',
        'wrong_confirmation' => '重复新密码与新密码不一致。',
        'wrong_current_password' => '当前密码错误。',
    ],
];
