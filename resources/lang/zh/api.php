<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => '无法发送空消息。',
            'limit_exceeded' => '您发送消息的频率太快了，坐下来泡杯茶休息会儿吧。',
            'too_long' => '你要发送的消息太长。',
        ],
    ],

    'scopes' => [
        'bot' => '作为聊天机器人。',
        'identify' => '鉴别你的身份并读取你的公开个人资料',

        'chat' => [
            'write' => '以您的名义发送消息。',
        ],

        'forum' => [
            'write' => '以你的名义创建和编辑论坛的主题与帖子。',
        ],

        'friends' => [
            'read' => '看看你关注了谁。',
        ],

        'public' => '以你的身份读取公开数据。',
    ],
];
