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
        'only_one' => '주문이 성사될 때 마다 한 번씩만 유저 이름을 바꿀 수 있습니다.',
        'insufficient_paid' => '지불하신 금액이 유저 이름을 변경하는데 필요한 금액보다 적습니다 (:expected > :actual)',
        'reverting_username_mismatch' => '현재 유저 이름 (:current)이 철회시 적용될 유저 이름(:username)과 일치하지 않습니다',
    ],
    'supporter_tag' => [
        'insufficient_paid' => '기부액이 서포터 권한을 얻는데 필요한 최소액보다 적습니다 (:actual > :expected)',
    ],
];
