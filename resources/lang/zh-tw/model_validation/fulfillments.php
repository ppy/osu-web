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
    'username_change' => [
        'only_one' => '每一筆訂單僅能變更一個使用者名稱',
        'insufficient_paid' => '餘額不足以支付變更使用者名稱所需的費用（ :expected > :actual ）',
        'reverting_username_mismatch' => '目前的使用者名稱（:current）與要撤銷變更的使用者名稱不一致（:username）',
    ],
    'supporter_tag' => [
        'insufficient_paid' => '要獲得 osu!supporter 的標籤，你的贊助金額還不夠喔。 (:actual > :expected)',
    ],
];
