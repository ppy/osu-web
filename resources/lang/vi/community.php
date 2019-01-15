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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Yêu thích osu!?<br/>
                                Hãy ủng hộ quá trình phát triển của osu! :D',
            'small_description' => '',
            'support_button' => 'Tôi muốn ủng hộ osu!',
        ],

        'dev_quote' => 'osu! là một trò chơi hoàn toàn miễn phí, nhưng để cho osu! hoạt động được thì lại không hề miễn phí. Giữa chi phí cho các máy chủ hoạt động và băng thông quốc tế chất lượng cao, thời gian dành ra để bảo trì hệ thống và cộng đồng osu!, việc cung cấp giải thưởng cho các cuộc thi, việc trả lời các câu hỏi giúp đỡ và giữ được sự vui vẻ cho mọi người như thường lệ, số lượng tiền mà osu! tiêu tốn khá là khổng lồ. Ồ, và chưa kể chúng tôi làm mà không nhờ đến quảng cáo nào hay hợp tác với nhưng thanh công cụ vớ vẩn và những thứ tương tự!
            <br/><br/>Suy cho cùng thì osu! hoạt động được là phần lớn nhờ vào tôi, người mà bạn có thể biết đến với cái tên "peppy".
            Tồi đã phải nghỉ công việc của mình để mà bắt kịp với osu!,
            và cùng lúc cố gắng để duy trì những tiêu chuẩn mà tôi đặt ra.
            Tôi muốn biếu tặng trực tiếp sự cảm tạ của tôi đối những người đã ủng hộ osu!,
            và cũng như những người đang hỗ trợ trò chơi tuyệt với này cùng với cộng đồng của nó trong tương lai :).',

        'supporter_status' => [
            'contribution' => 'Cảm ơn về sự hỗ trợ của bạn! Bạn đã đóng góp tổng cộng :dollars với :tags tag đã mua!',
            'gifted' => ':giftedTags tag đã mua của bạn đã được tặng (với tổng cộng :giftedDollars được tặng), thật hào phóng!',
            'not_yet' => "Bạn chưa có supporter tag nào hết :(",
            'title' => 'Trạng thái hỗ trợ',
            'valid_until' => 'Supporter tag hiện tại của bạn có giá trị đến :date!',
            'was_valid_until' => 'Supporter tag của bạn đã hết hạn vào :date.',
        ],

        'why_support' => [
            'title' => 'Tại sao tôi nên ủng hộ osu!?',
            'blocks' => [
                'dev' => 'Được phát triển và duy trì một cách vượt trội bởi một gã sống ở Úc',
                'time' => 'Dành quá nhiều thời gian để trò chơi hoạt động được đến mức không còn gọi nó là một "thú vui" nữa.',
                'ads' => 'Không có quảng cáo ở bất cứ đâu. <br/><br/>
                        Khác với 99.95% của web, chúng tôi không kiếm lợi nhuận bẳng cách ném đồ vào mặt bạn.',
                'goodies' => 'Bạn sẽ được nhận thêm nhiều phần quà hấp dẫn!',
            ],
        ],

        'perks' => [
            'title' => 'Ồ, Vậy tôi sẽ nhận được gì?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Truy cập nhanh và dễ dàng để tìm beatmap mà không cần thoát trò chơi.',
            ],

            'auto_downloads' => [
                'title' => 'Tải Tự Động',
                'description' => 'Tự tải khi đang chơi multiplayer, theo dõi người chơi khác, hay chỉ nhấn link trong chat!',
            ],

            'upload_more' => [
                'title' => 'Tải Lên Thêm',
                'description' => 'Thêm số lượng beatmap chờ (cho mỗi beatmap được rank) tới tối đa là 10.',
            ],

            'early_access' => [
                'title' => 'Tiếp Cận Sớm',
                'description' => 'Tiếp cận những bản release sớm mà bạn có thể dùng thử các tính năng mới trước khi nó được ra mắt công khai!',
            ],

            'customisation' => [
                'title' => 'Tùy Biến',
                'description' => 'Tùy biến trang cá nhân của bạn bằng cách thêm một user page đầy đủ có thể chỉnh sửa.',
            ],

            'beatmap_filters' => [
                'title' => 'Lọc Beatmap',
                'description' => 'Tìm kiếm beatmap được lọc theo đã chơi, chưa chơi và rank đạt được (nếu có).',
            ],

            'yellow_fellow' => [
                'title' => 'Anh Bạn Màu Vàng',
                'description' => 'Được nhận diện trong game bằng màu vàng sáng trên tên tài khoản của bạn trong chat.',
            ],

            'speedy_downloads' => [
                'title' => 'Tải Nhanh',
                'description' => 'Tải ít bị giới hạn hơn, đặc biệt là khi dùng osu!direct.',
            ],

            'change_username' => [
                'title' => 'Đổi Tên Tài Khoản',
                'description' => 'Được đổi tên tài khoản miễn phí. (tối đa một lần)',
            ],

            'skinnables' => [
                'title' => 'Thêm Skin',
                'description' => 'Thêm in-game skin, như là màn hình background ở menu chính.',
            ],

            'feature_votes' => [
                'title' => 'Bầu Chọn Tính Năng',
                'description' => 'Bầu chọn cho các tính năng theo yêu cầu. (2 lần mỗi tháng)',
            ],

            'sort_options' => [
                'title' => 'Tùy Chọn Sắp Xếp',
                'description' => 'Cho phép xem xếp hạng theo quốc gia / bạn bè / theo-mod của beatmap trong game.',
            ],

            'feel_special' => [
                'title' => 'Cảm Thấy Đặc Biệt',
                'description' => 'Cảm giác ấm áp và dễ chịu khi chung tay giúp cho osu! chạy một cách trơn tru!',
            ],

            'more_to_come' => [
                'title' => 'Còn hơn thế nữa',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Tôi đã tin! :D',
            'support' => 'hỗ trợ osu!',
            'gift' => 'hay gửi support đến người chơi khác',
            'instructions' => 'nhấp vào nút trái tim để đi đến osu!store',
        ],
    ],
];
