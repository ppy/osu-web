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
    'box' => [
        'sent' => '인증 코드가 들어있는 메일이 :mail로 발송되었습니다. 인증 코드를 입력해주세요.',
        'title' => '계정 인증',
        'verifying' => '인증하는 중...',
        'issuing' => '새 코드 발급 중...',

        'info' => [
            'check_spam' => "아직 메일을 받지 못하셨다면, 스팸 메일함을 확인해보세요.",
            'recover' => "현재 이메일을 확인할 수 없거나, 이전에 사용하시던 이메일을 잊어버리셨다면, :link을 따라주시기 바랍니다.",
            'recover_link' => '이메일 복구 과정',
            'reissue' => ':reissue_link받거나, :logout_link하실 수도 있습니다.',
            'reissue_link' => '새 코드를 발급',
            'logout_link' => '로그아웃',
        ],
    ],

    'errors' => [
        'expired' => '인증 코드가 만료되었습니다, 새 인증용 메일을 발송했습니다.',
        'incorrect_key' => '인증 코드가 잘못되었습니다.',
        'retries_exceeded' => '인증 코드가 잘못되었습니다. 재시도 횟수를 초과하여, 새 인증용 메일을 발송했습니다.',
        'reissued' => '인증 코드가 재발급되었습니다, 새 인증용 메일을 발송했습니다.',
        'unknown' => '알 수 없는 문제가 발생했습니다, 새 인증용 메일을 발송했습니다.',
    ],
];
