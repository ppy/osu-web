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
    'authorizations' => [
        'update' => [
            'null_user' => '编辑前请先登录.',
            'system_generated' => '不能编辑系统的回复.',
            'wrong_user' => '只有作者才能编辑.',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '被 :user 标记为已解决',
            'false' => '被 :user 重新打开',
        ],
    ],
];
