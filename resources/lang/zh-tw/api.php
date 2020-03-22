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
    'error' => [
        'chat' => [
            'empty' => '無法傳送沒有內容的訊息。',
            'limit_exceeded' => '您發送訊息的速度太快了，請稍後再試。',
            'too_long' => '你要發送的訊息太長。',
        ],
    ],

    'scopes' => [
        'identify' => '識別您的身份並閱讀您的公開個人資料。',

        'friends' => [
            'read' => '查看您追蹤的玩家們。',
        ],
    ],
];
