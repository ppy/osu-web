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
    'beatmapset_update_notice' => [
        'new' => '',
        'subject' => '":title"에 새로운 변경사항이 있습니다.',
        'unwatch' => '',
        'visit' => '',
    ],

    'common' => [
        'closing' => '',
        'hello' => '',
        'report' => '만약 귀하가 이 변경사항을 요청하지 않으셨다면 이 이메일로 지금 즉시 답장해주세요.',
    ],

    'donation_thanks' => [
        'benefit_more' => '더 많은 새로운 서포터 혜택이 계속해서 생겨날겁니다!',
        'feedback' => "만약 질문이나 피드백이 있으시다면, 이 메일로 답장하는걸 주저하지 마세요. 최대한 빠르게 답해드리겠습니다!",
        'keep_free' => 'osu! 가 광고나 결제 강요 없이 게임과 커뮤니티를 운영할 수 있는것은 당신같은 사람들 덕분입니다.',
        'keep_running' => '',
        'subject' => '감사합니다, osu!는 여러분을 ❤합니다',

        'benefit' => [
            'gift' => '',
            'self' => '이제 :duration 동안 osu!direct와 다른 서포터 혜택을 누리실 수 있습니다.',
        ],

        'support' => [
            '_' => 'osu!를 향한 당신의 :support에 감사드립니다!',
            'first' => '지원',
            'repeat' => '계속된 지원',
        ],
    ],

    'forum_new_reply' => [
        'new' => '',
        'subject' => '[osu!] ":title"주제에 대한 새로운 답변이 달렸습니다',
        'unwatch' => '',
        'visit' => '다음의 링크를 사용해 가장 최근 답장으로 즉시 이동하세요.',
    ],

    'password_reset' => [
        'code' => '인증 코드:',
        'requested' => '귀하 또는 귀하인 척 하는 다른 누군가가 귀하의 osu! 계정의 비밀번호 초기화를 요청했습니다.',
        'subject' => 'osu! 계정 복구',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => '결제 정보를 제공받았으며 현재 배송을 위한 준비중에 있습니다. 주문 수량에 따라 배송에 며칠이 소요될 수 있습니다. 다음의 링크를 통해 주문 진행 상황을 확인할 수 있으며, 준비되는 대로 배송 추적 정보도 확인할 수 있습니다:',
        'processing' => '결제 정보를 제공받았으며 현재 주문 처리중에 있습니다. 다음의 링크를 통해 주문 진행 상황을 확인할 수 있습니다:',
        'questions' => "질문이 있으시거나 도움이 필요하시면 본 이메일을 통해 회신해주시기 바랍니다.",
        'shipping' => '배송중',
        'subject' => '귀하의 osu!store 주문을 받았습니다!',
        'thank_you' => 'osu!store에서 주문해주셔서 감사합니다!',
        'total' => '합계',
    ],

    'supporter_gift' => [
        'anonymous_gift' => '서포터 태그를 선물해주신 분은 본인을 익명으로 남기셨습니다. 따라서 이 알림에 언급되지 않았습니다.',
        'anonymous_gift_maybe_not' => '뭐... 이미 누군지 눈치첸 것 같기도 하네요^^',
        'duration' => '선물해주신 분 덕분에 :duration 동안 osu!direct와 다른 osu! 서포터 혜택을 누리실 수 있습니다.',
        'features' => '자세한 기능은 다음 링크를 통해 확인하실 수 있습니다:',
        'gifted' => '누군가가 당신에게 osu! 서포터 태그를 선물했습니다!',
        'subject' => 'osu! 서포터 권한을 선물 받았습니다!',
    ],

    'user_email_updated' => [
        'changed_to' => '이는 귀하의 osu! 이메일 주소가 ":email" 로 변경되었음을 알리기 위한 확인 이메일입니다.',
        'check' => '',
        'sent' => '이 이메일은 보안상의 이유로 새로운 이메일과 이전 이메일에 동일하게 전송되었습니다.',
        'subject' => 'osu! 이메일 주소 변경 확인',
    ],

    'user_force_reactivation' => [
        'main' => '',
        'perform_reset' => ':url 에서 초기화를 진행할 수 있습니다.',
        'reason' => '사유:',
        'subject' => 'osu! 계정 재활성화가 필요합니다',
    ],

    'user_password_updated' => [
        'confirmation' => '이는 귀하의 osu! 비밀번호 변경되었음을 알리기 위한 확인 이메일입니다.',
        'subject' => 'osu! 비밀번호 변경 확인',
    ],

    'user_verification' => [
        'code' => '인증 코드:',
        'code_hint' => '',
        'link' => '',
        'report' => '',
        'subject' => 'osu! 계정 인증',

        'action_from' => [
            '_' => '',
            'unknown_country' => '알 수 없는 국가',
        ],
    ],
];
