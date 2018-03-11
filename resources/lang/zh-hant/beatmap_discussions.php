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
    'authorizations' => [
        'update' => [
            'null_user' => '編輯前請先登錄。',
            'system_generated' => '無法編輯系統回覆。',
            'wrong_user' => '只有作者可以編輯。',
        ],
    ],

    'events' => [
        'empty' => '還沒有事件⋯⋯',
    ],

    'index' => [
        'deleted_beatmap' => '刪除',
        'title' => '譜面討論',

        'form' => [
            'deleted' => '包含已經刪除的討論',

            'user' => [ //上下文
                'label' => '用戶',
                'overview' => '活動總覽',
            ],
        ],
    ],

    'item' => [
        'created_at' => '發帖時間',
        'deleted_at' => '刪帖時間',
        'message_type' => '類型',
        'permalink' => '靜態鏈接',
    ],

    'nearby_posts' => [
        'confirm' => '在這個時間點上沒有相關的討論記錄。',
        'notice' => '在 :timestamp 附近（:existing_timestamps）有討論記錄，發表前請檢查。',
    ],

    'reply' => [
        'open' => [
            'guest' => '登錄以回覆',
            'user' => '回覆',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '被 :user 標記爲 “已解決”',
            'false' => '被 :user 標記爲 “未解決”',
        ],
    ],

    'user' => [
        'admin' => '管理員',
        'bng' => '譜面管理團隊',
        'owner' => '譜面作者',
        'qat' => '質量保證團隊',
    ],
];
