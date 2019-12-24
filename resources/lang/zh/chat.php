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
    'limitation_notice' => '注：只有使用 <a href=":lazer_link">osu! lazer</a> 或新官网的人才能通过该系统接收私聊消息。<br/>如果你不确定对方是否使用，请通过<a href=":oldpm_link">旧论坛私聊页面</a>向他们发送消息。',
    'talking_in' => '在 :channel 中聊天',
    'talking_with' => '与 :name 聊天',
    'title_compact' => '聊天',

    'cannot_send' => [
        'channel' => '现在无法向该频道发送消息，这可能是由于以下原因：',
        'user' => '现在不能向该玩家发送消息，这可能是由于以下原因：',
        'reasons' => [
            'blocked' => '你已被对方屏蔽',
            'channel_moderated' => '该频道正在被管制中',
            'friends_only' => '对方只接受来自好友的消息',
            'restricted' => '你正处于限制状态',
            'target_restricted' => '对方正处于限制状态',
        ],
    ],
    'input' => [
        'disabled' => '无法发送消息……',
        'placeholder' => '输入消息……',
        'send' => '发送',
    ],
    'no-conversations' => [
        'howto' => "点击用户的个人资料/卡片上的信封图标以开始聊天",
        'lazer' => '在 <a href=":link">osu!lazer</a> 中加入的频道将会被显示在这里。',
        'pm_limitations' => '只有使用 <a href=":link">osu!lazer</a> 或新官网的玩家才能收到私聊消息。',
        'title' => '暂无对话',
    ],
];
