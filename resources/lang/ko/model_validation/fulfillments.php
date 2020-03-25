<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
