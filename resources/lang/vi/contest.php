<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'header' => [
        'small' => 'Cạnh tranh bằng nhiều cách khác nhau hơn là chỉ bấm vòng tròn.',
        'large' => 'Cuộc Thi Cộng Đồng',
    ],
    'voting' => [
        'over' => 'Bình chọn đã kết thúc cho cuộc thi này',
        'login_required' => 'Hãy đăng nhập để bình chọn.',
        'best_of' => [
            'none_played' => "Dường như bạn chưa chơi bất kì beatmap nào đủ điều kiện cho cuộc thi này!",
        ],
    ],
    'entry' => [
        '_' => 'entry',
        'login_required' => 'Hãy đăng nhập để tham gia cuộc thi.',
        'silenced_or_restricted' => 'Bạn không thể tham gia cuộc thi trong khi bị hạn chế hoặc bị im lặng.',
        'preparation' => 'Chúng tôi đang chuẩn bị cho cuộc thi này. Xin hãy kiên nhẫn chờ đợi!',
        'over' => 'Cảm ơn về bài dự thi của bạn! Cuộc thi đã không còn nhận thêm mục nào nữa và sẽ sớm mở bình chọn.',
        'limit_reached' => 'Bạn đã đạt giới hạn bài dự thi cho cuộc thi này',
        'drop_here' => 'Thả bài dự thi của bạn vào đây',
        'wrong_type' => [
            'art' => 'Chỉ những file .jpg và .png mới được chấp nhận cho cuộc thi này.',
            'beatmap' => 'Chỉ những file .osu mới được chấp nhận cho cuộc thi này.',
            'music' => 'Chỉ những file .mp3 mới được chấp nhận cho cuộc thi này.',
        ],
        'too_big' => 'Số bài dự thi cho cuộc thi này tối đa là :limit.',
    ],
    'beatmaps' => [
        'download' => 'Tải Xuống Bài Dự Thi',
    ],
    'vote' => [
        'list' => 'phiếu',
        'count' => ':count phiếu',
    ],
    'dates' => [
        'ended' => 'Đã kết thúc :date',

        'starts' => [
            '_' => 'Bắt đầu :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => 'Nhận Bài Dự Thi',
        'voting' => 'Bắt Đầu Bình Chọn',
        'results' => 'Đã Có Kết Quả',
    ],
];
