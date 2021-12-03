<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => '在 :channel 聊天',
    'talking_with' => '與 :name 聊天',
    'title_compact' => '聊天',

    'cannot_send' => [
        'channel' => '您現在無法在頻道中發送訊息。可能是Bug或是以下原因:',
        'user' => '您現在無法對這個玩家發送訊息。可能是Bug或是以下原因:',
        'reasons' => [
            'blocked' => '您已被收件者封鎖了',
            'channel_moderated' => '此頻道已經被管理員接管',
            'friends_only' => '收件者只接受朋友發送的訊息',
            'not_enough_plays' => '您的遊玩次數不夠',
            'not_verified' => '您的會話未經驗證',
            'restricted' => '您的帳號已被限制',
            'silenced' => '您正被禁言',
            'target_restricted' => '該使用者的帳號已被限制',
        ],
    ],
    'input' => [
        'disabled' => '無法傳送訊息...',
        'disconnected' => '',
        'placeholder' => '輸入訊息...',
        'send' => '發送',
    ],
    'no-conversations' => [
        'howto' => "在使用者個人資料或卡片的彈出方塊上點擊信封圖案以開始聊天。",
        'lazer' => '您通過 <a href=":link">osu! lazer</a> 加入的公開頻道也會顯示在這裡。',
        'title' => '還沒有聊天過',
    ],
];
