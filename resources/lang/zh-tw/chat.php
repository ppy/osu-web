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
    'limitation_notice' => '注意: 只有使用 <a href=":lazer_link">osu! lazer</a> 或新網站的人才能在此系統收到私訊。<br/>如果您不確定, 請使用 <a href=":oldpm_link">舊論壇</a> 私訊他們。',
    'talking_in' => '在 :channel 聊天',
    'talking_with' => '與 :name 聊天',
    'title_compact' => '聊天',

    'cannot_send' => [
        'channel' => '您現在無法在頻道中發送訊息。可能是Bug或是以下原因:',
        'user' => '您現在無法對這個玩家發送訊息。可能是Bug或是以下原因:',
        'reasons' => [
            'blocked' => '您已被收件者封鎖了',
            'channel_moderated' => '此頻道已經被管理員接管。',
            'friends_only' => '收件者只接受朋友發送的訊息',
            'restricted' => '您的帳號已被限制。',
            'target_restricted' => '該使用者的帳號已被限制。',
        ],
    ],
    'input' => [
        'disabled' => '無法傳送訊息...',
        'placeholder' => '輸入訊息...',
        'send' => '發送',
    ],
    'no-conversations' => [
        'howto' => "在使用者個人資料或卡片的彈出方塊上點擊信封圖案以開始聊天。",
        'lazer' => '您通過 <a href=":link">osu! lazer</a> 加入的公開頻道也會顯示在這裡。',
        'pm_limitations' => '只有使用 <a href=":link">osu! lazer</a> 或是新網站的人才會收到才會收到訊息',
        'title' => '還沒有聊天過',
    ],
];
