<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'missing_route' => '',
    'no_restricted_access' => '账户处于限制模式，无法执行该操作。',
    'supporter_only' => '要使用此功能，请先成为 osu! Supporter 。',
    'unknown' => '发生了未知的错误。',

    'codes' => [
        'http-401' => '请先登录。',
        'http-403' => '拒绝访问。',
        'http-404' => '找不到页面。',
        'http-429' => '请求过多，请稍后再试。',
    ],
    'account' => [
        'profile-order' => [
            'generic' => '发生未知错误，请尝试刷新页面。',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => '指定的游戏模式无效。',
        'standard_converts_only' => '此谱面难度在请求的游戏模式下分数不可用。',
    ],
    'checkout' => [
        'generic' => '结账时发生了一个错误',
    ],
    'search' => [
        'default' => '无法获得任何结果，请稍后再试。',
        'operation_timeout_exception' => '搜索目前比平常较繁忙，稍后再试。',
    ],
];
