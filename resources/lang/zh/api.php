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
            'empty' => '无法发送空消息。',
            'limit_exceeded' => '您发送消息的频率太快了，坐下来泡杯茶休息会儿吧。',
            'too_long' => '你要发送的消息太长。',
        ],
    ],

    'scopes' => [
        'identify' => '鉴别你的身份并读取你的公开个人资料',

        'friends' => [
            'read' => '查看你关注了谁',
        ],
    ],
];
