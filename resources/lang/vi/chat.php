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
    'limitation_notice' => 'GHI CHÚ: Chỉ những người đang sử dụng trang web mới hoặc <a href=":lazer_link">osu!lazer</a> mới nhận tin nhắn thông qua hệ thống này.<br/>Nếu bạn không chắc, hãy gửi họ tin nhắn qua <a href=":oldpm_link">trang tin nhắn cũ</a>.',
    'talking_in' => 'đang trò chuyện ở :channel',
    'talking_with' => 'đang trò chuyện với :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Hiện bạn không thế gửi tin nhắn vào kênh này. Điều này có thể vì những lí do sau:',
        'user' => 'Hiện bạn không thế gửi tin nhắn cho người dùng này. Điều này có thể vì những lí do sau:',
        'reasons' => [
            'blocked' => 'Bạn bị chặn bởi người nhận',
            'channel_moderated' => 'Kênh này đang được kiểm duyệt',
            'friends_only' => 'Người nhận chỉ nhận tin nhắn từ những người trong danh sách bạn bè của họ',
            'restricted' => 'Bạn đang bị hạn chế',
            'target_restricted' => 'Người nhận đang bị hạn chế',
        ],
    ],
    'input' => [
        'disabled' => 'không thể gửi tin nhắn...',
        'placeholder' => 'soạn tin nhắn...',
        'send' => 'Gửi',
    ],
    'no-conversations' => [
        'howto' => "Bắt đầu cuộc trò chuyện từ trang cá nhân hoặc usercard của họ.",
        'lazer' => 'Những kênh công khai bạn tham gia qua <a href=":link">osu!lazer</a> cũng sẽ hiển thị tại đây.',
        'pm_limitations' => 'Chỉ những người sử dụng trang web mới hoặc <a href=":link">osu!lazer</a> mới nhận tin nhắn.',
        'title' => 'chưa có cuộc trò chuyện nào',
    ],
];
