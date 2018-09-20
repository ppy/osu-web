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
    'not_negative' => ':attribute 不能為負數。',
    'required' => '需要 :attribute 。',
    'too_long' => ':attribute 超出最大長度——最多允許 :limit 個字符。',
    'wrong_confirmation' => '確認信息不匹配。',

    'beatmap_discussion_post' => [
        'discussion_locked' => '討論被鎖定。',
        'first_post' => '無法刪除第一個討論。',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => '指定了時間戳但是譜面不存在。',
        'beatmapset_no_hype' => "無法推薦譜面。",
        'hype_requires_null_beatmap' => '只能在 常規（全難度） 中推薦。',
        'invalid_beatmap_id' => '指定的難度無效。',
        'invalid_beatmapset_id' => '指定的譜面無效。',
        'locked' => '討論被鎖定。',

        'hype' => [
            'guest' => '登錄後才能推薦',
            'hyped' => '你已經推薦了這張譜面',
            'limit_exceeded' => '你已經用光了推薦次數',
            'not_hypeable' => '這張譜面無法推薦',
            'owner' => '不能推薦你自己的譜面',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '指定的時間戳不在譜面範圍內。',
            'negative' => "無法定位時間戳。",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '只能給新特性請求投票。',
            'not_enough_feature_votes' => '票數不足。',
        ],

        'poll_vote' => [
            'invalid' => '指定的選項無效。',
        ],

        'post' => [
            'beatmapset_post_no_delete' => '不允許刪除譜面信息帖。',
            'beatmapset_post_no_edit' => '不允許編輯譜面信息帖。',
        ],

        'topic_poll' => [
            'duplicate_options' => '不允許重複的選項。',
            'invalid_max_options' => '每人可選的選項不能超出總選項數。',
            'minimum_one_selection' => '每人至少可選一項。',
            'minimum_two_options' => '需要至少兩個選項。',
            'too_many_options' => '選項數量超出限制。',
        ],

        'topic_vote' => [
            'required' => '至少選擇一項以投票',
            'too_many' => '選項數量超出限制。',
        ],
    ],

    'user' => [
        'contains_username' => '密碼不能包含用戶名。',
        'email_already_used' => '郵箱已被使用。',
        'invalid_country' => '國家未被數據庫收錄。',
        'invalid_discord' => 'Discord 用户名无效。',
        'invalid_email' => "無效的郵箱地址。",
        'too_short' => '新密碼太短。',
        'unknown_duplicate' => '用戶名或郵箱已被使用。',
        'username_available_in' => '该用户名将在 :duration 后可用。',
        'username_available_soon' => '该用户名即将可用！',
        'username_invalid_characters' => '用户名中包含非法字符。',
        'username_in_use' => '用户名已经被使用！',
        'username_no_space_userscore_mix' => '请在下划线和空格间选一个，不要混用！',
        'username_no_spaces' => "用户名不能以空格开头或结束。",
        'username_not_allowed' => '不允许使用该用户名。',
        'username_too_short' => '用戶名太短。',
        'username_too_long' => '用户名太长。',
        'weak' => '弱密碼。',
        'wrong_current_password' => '密碼不正確.',
        'wrong_email_confirmation' => '重複新郵箱與新郵箱不一致。',
        'wrong_password_confirmation' => '重複新密碼與新密碼不一致。',
        'too_long' => '超出長度限制——最多為 :limit 個字符。',

        'change_username' => [
            'supporter_required' => [
                '_' => '你必须 :link 才能更改用户名！',
                'link_text' => '支持 osu!',
            ],
            'username_is_same' => '这就是你的用户名，Baka！',
        ],
    ],
];
