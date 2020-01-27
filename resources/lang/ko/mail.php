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
        'new' => '지난 방문 이후로 ":title" 비트맵에 새로운 업데이트가 있었다는 것을 알려드립니다.',
        'subject' => '":title"에 새로운 변경사항이 있습니다.',
        'unwatch' => '이 비트맵의 소식을 그만 받으시려면 위 페이지에 있는 "구독 해제하기" 링크를 클릭하거나, 다음 모딩 구독 페이지에서 설정하실 수 있습니다:',
        'visit' => '토론 페이지 방문하기:',
    ],

    'common' => [
        'closing' => '항상 감사드리며,',
        'hello' => ':user 님, 안녕하세요.',
        'report' => '만약 귀하가 이 변경사항을 요청하지 않으셨다면 이 이메일로 지금 즉시 답장해주세요.',
    ],

    'forum_new_reply' => [
        'new' => '지난 방문 이후로 ":title" 게시글에 새로운 답글이 달렸다는 것을 알려드립니다.',
        'subject' => '[osu!] ":title"주제에 대한 새로운 답변이 달렸습니다',
        'unwatch' => '이 주제의 소식을 그만 받으시려면 위 페이지에 있는 "구독 해제" 링크를 클릭하거나, 다음 구독 관리 페이지에서 설정하실 수 있습니다:',
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
        'check' => '향후 osu! 계정에 접근하지 못하는 사태를 막기 위해 새로운 이메일 계정으로 이 메일을 수신하셨다는 것을 확인해 주세요.',
        'sent' => '이 이메일은 보안상의 이유로 새로운 이메일과 이전 이메일에 동일하게 전송되었습니다.',
        'subject' => 'osu! 이메일 주소 변경 확인',
    ],

    'user_force_reactivation' => [
        'main' => '최근 수상한 활동이나 취약한 비밀번호로 인하여 계정 도용이 의심되는 상황입니다. 이로 인해 새로 비밀번호를 설정하셔야 하오니, 안전한 비밀번호로 설정해 주시길 바랍니다.',
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
        'code_hint' => '공백을 포함하거나 하지 않아도 됩니다.',
        'link' => '아니면, 아래 링크를 방문하여 확인 절차를 끝낼 수 있습니다:',
        'report' => '만약 이를 요청하지 않으셨다면, 계정 도용의 가능성이 있으니 즉시 회답하시길 바랍니다.',
        'subject' => 'osu! 계정 인증',

        'action_from' => [
            '_' => ':country에서 귀하의 계정을 사용한 활동이 있었으므로, 확인 절차가 필요합니다.',
            'unknown_country' => '알 수 없는 국가',
        ],
    ],
];
