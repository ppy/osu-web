<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'username_change' => [
        'only_one' => '一个订单中只能更改一个用户名',
        'insufficient_paid' => '支付金额不足以更改用户名（ :expected > :actual ）',
        'reverting_username_mismatch' => '当前用户名（:current）与要撤销更改的用户名不一致（:username）',
    ],
    'supporter_tag' => [
        'insufficient_paid' => '捐赠数量少于 osu!support 所需的最小数额（:actual > :expected）',
    ],
];
