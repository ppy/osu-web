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
    'index' => [
        'none_running' => '지금 당장 진행중인 토너먼트가 없군요, 나중에 다시 확인해주세요!',
        'registration_period' => '참가: :start부터 :end까지',

        'header' => [
            'subtitle' => '현재 진행중인, 공식적으로 인정된 토너먼트 목록입니다.',
            'title' => '커뮤니티 토너먼트',
        ],

        'item' => [
            'registered' => '등록된 플레이어',
        ],

        'state' => [
            'current' => '개최 중인 토너먼트',
            'previous' => '지난 토너먼트',
        ],
    ],

    'show' => [
        'banner' => '팀 응원하기',
        'entered' => '이 토너먼트에 참가하셨습니다.<br><br>이는 참가 \'팀\'을 등록했다는 뜻이 아닙니다.<br><br>토너먼트 진행일자가 가까워지면, 이메일을 통해 지침이 보내질 것이므로 osu! 계정의 이메일 주소가 잘못되지는 않았는지 반드시 확인해주시기 바랍니다!',
        'info_page' => '정보 페이지',
        'login_to_register' => '토너먼트 참가에 관한 자세한 사항을 보려면 :login해주세요!',
        'not_yet_entered' => '아직 이 토너먼트에 참가하지 않았습니다.',
        'rank_too_low' => '죄송하지만, 토너먼트에 참가하는데 필요한 순위를 충족하지 못했습니다!',
        'registration_ends' => '참가 신청이 :date에 종료됩니다.',

        'button' => [
            'cancel' => '참가 신청 취소',
            'register' => '참가시켜 주세요!',
        ],

        'state' => [
            'before_registration' => '아직 이 대회의 참가 신청 기간이 아닙니다.',
            'ended' => '이 대회는 종료되었습니다. 정보 페이지를 확인하여 결과를 확인하세요.',
            'registration_closed' => '이 대회의 참가 신청 기간은 끝났습니다. 정보 페이지에서 최신 업데이트를 확인하세요.',
            'running' => '이 대회는 현재 진행 중입니다. 정보 페이지에서 자세한 사항을 확인하세요.',
        ],
    ],
    'tournament_period' => ':start부터 :end까지',
];
