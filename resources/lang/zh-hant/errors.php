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
    'codes' => [
        'http-401' => '請先登錄。',
        'http-403' => '拒絕訪問。',
        'http-429' => '請求過多，請稍後再試。',
    ],
    'account' => [
        'profile-order' => [
            'generic' => '發生未知錯誤，請嘗試刷新頁面。',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => '指定的遊戲模式無效。',
        'standard_converts_only' => '此譜面難度在請求的遊戲模式下分數不可用。',
    ],
    'beatmapsets' => [
        'too-many-favourites' => '譜面收藏數超出限制，請刪除一個後再試。',
    ],
    'logged_out' => '你已退出，請登錄後再試。',
    'supporter_only' => '要使用此功能，請先成爲 osu!支持者 。',
    'no_restricted_access' => '賬戶處於限制模式，無法執行該操作。',
    'unknown' => '發生了未知的錯誤。',
];
