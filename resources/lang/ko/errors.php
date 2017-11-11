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
    'codes' => [
        'http-401' => '계속하려면 로그인해주세요.',
        'http-403' => '접근이 거부됨.',
        'http-429' => '시도 횟수가 너무 많습니다. 나중에 다시 시도해주세요.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => '문제가 발생했습니다. 페이지를 새로고침 해보세요.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => '잘못된 모드 종류입니다.',
        'standard_converts_only' => '선택하신 모드로는 현재 난이도에서 점수를 사용할 수 없습니다.',
    ],
    'beatmapsets' => [
        'too-many-favourites' => '즐겨찾기한 비트맵이 너무 많습니다! 계속하려면 즐겨찾기를 하나 해제해주세요.',
    ],
    'logged_out' => '로그아웃 되었습니다. 로그인하시고 다시 시도해보세요.',
    'supporter_only' => '서포터가 아니면 이 기능을 사용할 수 없습니다.',
    'no_restricted_access' => '계정이 제한된 상태에서는 이 작업을 수행할 수 없습니다.', // 딱딱한 번역 (not able to perform this action -> 작업을 수행할 수 없습니다)
    'unknown' => '알 수 없는 문제가 발생했습니다.',
];
