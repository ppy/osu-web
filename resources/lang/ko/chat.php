<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
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
            'not_enough_plays' => '게임을 충분히 하지 않으셨네요',
            'not_verified' => '세션이 유효하지 않습니다.',
            'restricted' => '계정이 제한되어 있습니다',
            'silenced' => '침묵 상태에서는 전송할 수 없습니다',
            'target_restricted' => '상대방의 계정이 제한되어 있습니다',
        ],
    ],
    'input' => [
        'disabled' => '메시지를 보낼 수 없습니다...',
        'disconnected' => '',
        'placeholder' => '메시지를 입력하세요...',
        'send' => '전송',
    ],
    'no-conversations' => [
        'howto' => "유저의 프로필 혹은 유저 카드 팝업에서 대화를 시작할 수 있습니다.",
        'lazer' => '<a href=":link">osu!lazer</a>에서 참가하는 공개 채널이 여기서도 보입니다.',
        'title' => '아직 아무런 대화가 없습니다',
    ],
];
