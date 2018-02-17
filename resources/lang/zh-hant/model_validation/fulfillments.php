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
        'only_one' => '一個訂單中只能更改一個用戶名',
        'insufficient_paid' => '支付金額不足以更改用戶名（ :expected > :actual ）',
        'reverting_username_mismatch' => '當前用戶名（:current）與要撤銷更改的用戶名不一致（:username）', //需要幫助
    ],
    'supporter_tag' => [
        'insufficient_paid' => '捐贈少於支持者標籤所需要求（:actual > :expected）', //需要幫助
    ],
];
