<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'username_change' => [
        'only_one' => 'Chỉ được đổi tên tài khoản 1 lần cho mỗi đơn đặt hàng.',
        'insufficient_paid' => 'Không đủ tiền để đổi tên tài khoản(:expected > :actual)',
        'reverting_username_mismatch' => 'Tên tài khoản hiện tại (:current) không giống với tên đã đổi, không thể hủy tên (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Không đủ tiền để tặng supporter tag (:actual > :expected)',
    ],
];
