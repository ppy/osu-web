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
    'support' => [
        'convinced' => [
            'title' => '납득했습니다! :D',
            'support' => 'osu! 지원하기',
            'gift' => '아니면 osu!를 지원하여 다른 플레이어에게 선물할 수도 있습니다.',
            'instructions' => '하트 버튼을 누르면 osu!상점으로 이동합니다.',
        ],
        'why-support' => [
            'title' => '왜 osu! 를 지원해야하죠? 제 돈은 어디로 가나요?',

            'team' => [
                'title' => '팀 지원하기',
                'description' => '소규모의 팀이 osu! 를 개발하고 운영합니다. 여러분의 도움은, 네... 저희가 먹고사는데 도움을 준답니다.',
            ],
            'infra' => [
                'title' => '서버 인프라',
                'description' => '여러분의 지원은 웹사이트나 멀티플레이 서비스, 온라인 리더보드 등을 구동하는데 필요한 서버를 계속 운영할 수 있게 합니다.',
            ],
            'featured-artists' => [
                'title' => '공식 아티스트',
                'description' => '여러분의 지원으로, 더 많은 놀라운 아티스트를 만나 osu! 에 사용할 굉장한 음악의 사용권을 취득할 수 있습니다!',
                'link_text' => '현재 아티스트 명단 보기 &raquo;',
            ],
            'ads' => [
                'title' => 'osu!를 자립하게 유지합니다',
                'description' => '여러분의 기여가 게임을 독립적이고, 일체의 광고와 외부 스폰서 없이 유지할 수 있도록 돕습니다.',
            ],
            'tournaments' => [
                'title' => '공식 토너먼트',
                'description' => 'osu! 공식 월드컵 토너먼트의 운영비 (그리고 상금) 를 마련할 수 있도록 돕습니다.',
                'link_text' => '토너먼트 찾아보기 &raquo;',
            ],
            'bounty-program' => [
                'title' => '오픈 소스 포상금 프로그램',
                'description' => '시간과 노력을 투자하여 osu! 를 더 좋게 만들 수 있도록 도와주시는 커뮤니티 기여자를 지원합니다.',
                'link_text' => '더 알아보기 &raquo;',
            ],
        ],
        'perks' => [
            'title' => '오? 뭘 받을 수 있나요?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => '게임 밖에서 비트맵을 찾을 필요 없이, 게임 내에서 쉽고 빠르게 다운로드 받을 수 있습니다.',
            ],

            'friend_ranking' => [
                'title' => '친구 순위',
                'description' => "게임 안과 웹사이트의 비트맵 리더보드에서 친구보다 얼마나 한수 위인지 볼 수 있습니다.",
            ],

            'country_ranking' => [
                'title' => '국가 순위',
                'description' => '세계 정복 전에는 국가 정복이죠.',
            ],

            'mod_filtering' => [
                'title' => '모드순 필터링',
                'description' => 'HDHR을 플레이하는 사람들만 찾고 싶으신가요? 문제없어요!',
            ],

            'auto_downloads' => [
                'title' => '자동 다운로드',
                'description' => '멀티플레이, 관전, 채팅에 올라온 링크를 누를 때 자동으로 비트맵을 다운로드합니다!',
            ],

            'upload_more' => [
                'title' => '업로드 제한 감소',
                'description' => '최대 10개까지 (랭크된 비트맵 당) 비트맵을 추가로 업로드할 수 있습니다.',
            ],

            'early_access' => [
                'title' => '얼리 엑세스',
                'description' => 'osu!에 새 기능을 패치하기 전에, 미리 기능을 체험해볼 수 있습니다!',
            ],

            'customisation' => [
                'title' => '커스터마이징',
                'description' => "여러분의 유저 페이지를 원하는 기호에 맞게 수정할 수 있습니다.",
            ],

            'beatmap_filters' => [
                'title' => '비트맵 필터',
                'description' => '비트맵을 플레이한 맵, 플레이하지 않은 맵, 점수가 등록된 맵을 기준으로 필터링하여 검색할 수 있습니다.',
            ],

            'yellow_fellow' => [
                'title' => '노란색 이름 태그',
                'description' => '게임 내에서 여러분의 유저이름이 노란색으로 표시되어 자신이 서포터임을 과시합니다.',
            ],

            'speedy_downloads' => [
                'title' => '빠른 다운로드',
                'description' => '비트맵 다운로드 속도 제한이 느슨해집니다. 특히 osu!direct를 사용할 때에는요.',
            ],

            'change_username' => [
                'title' => '사용자 이름 변경',
                'description' => '추가 비용없이 사용자 이름을 바꿀 수 있습니다. (1회 한정)',
            ],

            'skinnables' => [
                'title' => '스킨 옵션 추가',
                'description' => '메인 메뉴 배경 변경과 같은 추가적인 스킨 옵션을 게임 내에서 사용할 수 있습니다.',
            ],

            'feature_votes' => [
                'title' => '기능 요청',
                'description' => '원하는 기능을 요청하는 글에 투표할 수 있습니다. (매월 2번 투표 가능)',
            ],

            'sort_options' => [
                'title' => '정렬 옵션',
                'description' => '게임 내에서 비트맵 랭킹을 국가 / 친구 / 모드별 랭킹 기준으로 볼 수 있습니다.',
            ],

            'more_favourites' => [
                'title' => '더 많은 즐겨찾기',
                'description' => '즐겨 찾을 수 있는 비트맵의 수가 :normally &rarr; :supporter 으로 늘어납니다.',
            ],
            'more_friends' => [
                'title' => '더 많은 친구 수',
                'description' => '사귈 수 있는 친구의 숫자가 :normally &rarr; :supporter 으로 늘어납니다.',
            ],
            'more_beatmaps' => [
                'title' => '더 많은 비트맵 업로드',
                'description' => '한 번에 가질 수 있는 Ranked 되지 않은 비트맵의 수는 기본 값 + 현재 소유하고 있는 각 Ranked 된 비트맵 (한계치까지) 의 추가적 보너스로 계산됩니다. <br/><br/>일반적으로 이 값은 Ranked 된 비트맵 당 4 + 1입니다 (최대 2). 서포터가 있으면, 이 값이 Ranked 된 비트맵 당 8 + 1로 증가합니다 (최대 12).',
            ],
            'friend_filtering' => [
                'title' => '친구 리더보드',
                'description' => '친구와 경쟁하고 친구보다 얼마나 더 한수 위인지 알아보세요!*<br/><br/><small>* 신 사이트에는 아직 사용할 수 없습니다. 커밍 순(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => '지금까지 지원해 주셔서 감사합니다! 총 :tags번의 결제로 :dollars를 후원하셨습니다.',
            'gifted' => ":giftedTags번의 후원자 태그를 선물했습니다. (총 :giftedDollars 달러 선물 됨), 엄청나게 관대하시네요!",
            'not_yet' => "아직 후원자가 아니시군요 :(",
            'valid_until' => '당신의 현재 서포터는 :date까지 유효합니다!',
            'was_valid_until' => '당신의 서포터는 :date까지였습니다.',
        ],
    ],
];
