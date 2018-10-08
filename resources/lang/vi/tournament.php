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
    'index' => [
        'none_running' => 'Hiên tại không có giải đấu nào đang diễn ra, vui lòng kiểm tra lại sau!',
        'registration_period' => 'Đăng kí: :start đến :end',

        'header' => [
            'subtitle' => 'Danh sách các giải đấu chính thức đang hoạt động',
            'title' => 'Giải Đấu Cộng Đồng',
        ],

        'item' => [
            'registered' => 'Người chơi đã đăng kí',
        ],

        'state' => [
            'current' => 'Giải Đấu Đang Diễn Ra',
            'previous' => 'Giải Đấu Trước',
        ],
    ],

    'show' => [
        'banner' => 'Ủng Hộ Đội Của Bạn',
        'entered' => 'Bạn đã đăng kí cuộc thi này.<br><br>Lưu ý rằng điều này không có nghĩa là bạn đã được chia đội.<br><br>Hướng dẫn thêm sẽ được gửi cho bạn qua email vào khoảng thời gian gần ngày thi đấu, vì thế hãy chắc chắn rằng email của tài khoản osu! của bạn hợp lệ',
        'info_page' => 'Trang Thông Tin',
        'login_to_register' => 'Vui lòng :login để xem chi tiết đăng kí!',
        'not_yet_entered' => 'Bạn chưa đăng kí cuộc thi này.',
        'rank_too_low' => 'Xin lỗi, bạn không đáp ứng yêu cầu về thứ hạng cho giải đấu này!',
        'registration_ends' => 'Đăng kí sẽ kết thúc vào :date',

        'button' => [
            'cancel' => 'Hủy Đăng Kí',
            'register' => 'Đăng kí!',
        ],

        'state' => [
            'before_registration' => 'Giải đấu này hiện chưa mở đăng ký.',
            'ended' => 'Giải đấu này đã kết thúc. Kiểm tra trang thông tin để biết kết quả.',
            'registration_closed' => 'Đăng ký cho giải đấu này đã kết thúc. Kiểm tra trang thông tin để biết các cập nhật mới nhất.',
            'running' => 'Giải đấu này hiện đang diễn ra. Kiểm tra trang thông tin để biết thêm chi tiết.',
        ],
    ],
    'tournament_period' => ':start đến :end',
];
