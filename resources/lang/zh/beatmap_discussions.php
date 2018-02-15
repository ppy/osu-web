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
    'authorizations' => [
        'update' => [
            'null_user' => '编辑前请先登录。',
            'system_generated' => '无法编辑系统回复。',
            'wrong_user' => '只有作者可以编辑。',
        ],
    ],

    'nearby_posts' => [
        'confirm' => '在这个时间点上没有相关的讨论记录。',
        'notice' => '在 :timestamp 附近（:existing_timestamps）有讨论记录，发表前请检查。',
    ],

    'reply' => [
        'open' => [
            'guest' => '登录以回复',
            'user' => '回复',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '被 :user 标记为 “已解决”',
            'false' => '被 :user 标记为 “未解决”',
        ],
    ],

    'user' => [
        'admin' => '管理员',
        'bng' => '谱面管理团队',
        'owner' => '谱面作者',
        'qat' => '质量保证团队',
    ],
];
