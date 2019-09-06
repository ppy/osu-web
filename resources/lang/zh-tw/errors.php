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
    'codes' => [
        'http-401' => '請登入以繼續.',
        'http-403' => '拒絕存取。',
        'http-404' => '找不到。',
        'http-429' => '嘗試次數過多，請稍後再試。',
    ],
    'account' => [
        'profile-order' => [
            'generic' => '發生未知錯誤，請嘗試重新載入頁面。',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => '指定的遊戲模式無效。',
        'standard_converts_only' => '此遊戲模式下的圖譜難度尚未有分數。',
    ],
    'checkout' => [
        'generic' => '處理您的訂單時發生錯誤。',
    ],
    'search' => [
        'default' => '無法獲得任何結果，請稍後再試。',
        'operation_timeout_exception' => '搜索目前比平常更繁忙，稍後再試。',
    ],

    'logged_out' => '您已登出，請登入後再試。',
    'supporter_only' => '您需要成為 osu!贊助者才能使用此功能 。',
    'no_restricted_access' => '由於您的帳號已受限，故無法執行該操作。',
    'unknown' => '發生了未知的錯誤。',
];
