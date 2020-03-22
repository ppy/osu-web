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
    'limitation_notice' => '참고: <a href=":lazer_link">osu!lazer</a> 나 새 웹사이트를 쓰는 유저만 이 시스템을 통해서 PM을 받습니다.<br/>상대방이 사용하는지에 대한 여부가 불확실하다면, <a href=":oldpm_link">예전 포럼 PM 페이지</a>에서 메시지를 보내세요.',
    'talking_in' => ':channel에서 대화 중',
    'talking_with' => ':name님과 대화 중',
    'title_compact' => '채팅',

    'cannot_send' => [
        'channel' => '이 채널에서 메시지를 보낼 수 없습니다. 다음과 같은 이유 때문일 수도 있습니다:',
        'user' => '이 유저에게 메시지를 보낼 수 없습니다. 다음과 같은 이유 때문일 수도 있습니다:',
        'reasons' => [
            'blocked' => '당신은 상대방에게 차단되었습니다.',
            'channel_moderated' => '채널이 중재되는 중입니다',
            'friends_only' => '상대방이 친구 목록에 있는 사람들에게서만 메시지를 받고 있습니다.',
            'restricted' => '계정이 제한되어 있습니다',
            'target_restricted' => '상대방의 계정이 제한되어 있습니다',
        ],
    ],
    'input' => [
        'disabled' => '메시지를 보낼 수 없습니다...',
        'placeholder' => '메시지를 입력하세요...',
        'send' => '전송',
    ],
    'no-conversations' => [
        'howto' => "유저의 프로필 혹은 유저 카드 팝업에서 대화를 시작할 수 있습니다.",
        'lazer' => '<a href=":link">osu!lazer</a>에서 참가하는 공개 채널이 여기서도 보입니다.',
        'pm_limitations' => '<a href=":link">osu!lazer</a> 나 새 웹사이트를 쓰는 유저만 PM을 받습니다.',
        'title' => '아직 아무런 대화가 없습니다',
    ],
];
