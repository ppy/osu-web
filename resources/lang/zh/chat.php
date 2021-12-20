<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => '在 :channel 中聊天',
    'talking_with' => '与 :name 聊天',
    'title_compact' => '聊天',

    'cannot_send' => [
        'channel' => '现在你无法在此频道发送消息，这可能是由于以下原因：',
        'user' => '现在你无法向此玩家发送消息，这可能是由于以下原因：',
        'reasons' => [
            'blocked' => '你已被对方拉入黑名单',
            'channel_moderated' => '此频道正在被管制中',
            'friends_only' => '对方只接收好友的消息',
            'not_enough_plays' => '你的游戏次数还不够',
            'not_verified' => '你的会话未认证',
            'restricted' => '你正处于限制状态',
            'silenced' => '你已被禁言',
            'target_restricted' => '对方正处于限制状态',
        ],
    ],
    'input' => [
        'disabled' => '无法发送消息……',
        'disconnected' => '连接中断',
        'placeholder' => '输入消息……',
        'send' => '发送',
    ],
    'no-conversations' => [
        'howto' => "点击用户的个人资料/卡片上的信封图标以开始聊天",
        'lazer' => '在 <a href=":link">osu!lazer</a> 中加入的频道将在这里显示。',
        'title' => '暂无对话',
    ],
];
