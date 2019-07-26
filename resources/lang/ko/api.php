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
    'error' => [
        'chat' => [
            'empty' => '빈 메시지는 보낼 수 없습니다.',
            'limit_exceeded' => '메시지를 너무 빠르게 보내고 있습니다, 다시 보내기 전에 잠시 기다려주세요.',
            'too_long' => '전송하려는 메시지가 너무 깁니다.',
        ],
    ],

    'scopes' => [
        'identify' => '당신을 식별하고 공개 프로필을 읽습니다.',

        'friends' => [
            'read' => '당신이 팔로우 중인 사람들을 봅니다.',
        ],
    ],
];
