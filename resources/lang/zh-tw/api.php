<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => '無法傳送空白訊息。',
            'limit_exceeded' => '您傳送訊息的速度太快了，請稍後再試。',
            'too_long' => '您要傳送的訊息太長了。',
        ],
    ],

    'scopes' => [
        'bot' => '作為聊天機器人。',
        'identify' => '識別您的身分並閱讀您的公開個人資料。',

        'chat' => [
            'read' => '以您的身分閱讀訊息。',
            'write' => '以你的身分傳送訊息。',
            'write_manage' => '以您的身分加入或離開頻道。',
        ],

        'forum' => [
            'write' => '以你的身分建立或編輯論壇主題和貼文。',
        ],

        'friends' => [
            'read' => '查看您追蹤的玩家。',
        ],

        'public' => '以你的身分讀取公開資料。',
    ],
];
