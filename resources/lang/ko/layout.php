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
    'defaults' => [
        'page_description' => 'osu! - Rhythm is just a *click* away!  With Ouendan/EBA, Taiko and original gameplay modes, as well as a fully functional level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => '메인',
            'account-edit' => '설정',
            'friends' => '친구',
            'friends-index' => '친구',
            'changelog-index' => '변경 사항',
            'changelog-show' => '빌드 버전',
            'getDownload' => '다운로드',
            'getIcons' => '아이콘',
            'groups-show' => '그룹',
            'index' => 'osu!',
            'legal-show' => '정보',
            'news-index' => '뉴스',
            'news-show' => '뉴스',
            'password-reset-index' => '비밀번호 재설정',
            'search' => '검색',
            'supportTheGame' => '게임 지원하기',
        ],
        'help' => [
            '_' => '도움말',
            'getFaq' => 'FAQ',
            'getSupport' => '지원 센터', // osu!support와 혼동될까봐 "센터"를 추가
            'getWiki' => '위키',
            'wiki-show' => '위키',
        ],
        'beatmaps' => [
            '_' => '비트맵',
            'show' => '정보',
            'index' => '목록',
            'artists' => '주요 아티스트',
            'packs' => '모음집',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => '비트맵',
            'discussion' => 'modding',
        ],
        'rankings' => [ // TODO: 확인 후 뒤에 ~별 을 붙일지 결정...
            '_' => '순위',
            'index' => '퍼포먼스',
            'performance' => '퍼포먼스',
            'charts' => '차트',
            'score' => '점수',
            'country' => '국가',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => '커뮤니티',
            'dev' => 'osu!dev',
            'getForum' => '포럼',
            'getChat' => '채팅',
            'getSupport' => '지원',
            'getLive' => '라이브 스트림',
            'contests' => '콘테스트',
            'profile' => '프로필',
            'tournaments' => '대회',
            'tournaments-index' => '대회',
            'tournaments-show' => '대회 정보',
            'forum-topic-watches-index' => '구독',
            'forum-topics-create' => '포럼',
            'forum-topics-show' => '포럼',
            'forum-forums-index' => '포럼',
            'forum-forums-show' => '포럼',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'match',
        ],
        'error' => [
            '_' => 'error',
            '404' => 'missing',
            '403' => 'forbidden',
            '401' => 'unauthorized',
            '405' => 'missing',
            '500' => 'something broke',
            '503' => 'maintenance',
        ],
        'user' => [
            '_' => '유저',
            'getLogin' => '로그인',
            'disabled' => 'disabled',

            'register' => '회원 가입',
            'reset' => '복원',
            'new' => '새',

            'messages' => '메세지',
            'settings' => '설정',
            'logout' => '로그아웃',
            'help' => '도움말',
        ],
        'store' => [
            '_' => '상점',
            'getListing' => '목록',
            'getCart' => '장바구니',

            'getCheckout' => '결제',
            'getInvoice' => '청구서',
            'getProduct' => '상품',

            'new' => 'new',
            'home' => 'home',
            'index' => 'home',
            'thanks' => 'thanks',
        ],
        'admin-forum' => [
            '_' => '관리자::포럼',
            'forum-covers-index' => '포럼 표지',
        ],
        'admin-store' => [
            '_' => '관리자::상점',
            'orders-index' => '주문',
            'orders-show' => '주문',
        ],
        'admin' => [
            '_' => '관리자',
            'root' => 'index',
            'logs-index' => 'log',
            'beatmapsets' => [
                '_' => '비트맵', // beatmapsets
                'covers' => '표지',
                'show' => '세부 정보',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '일반',
            'home' => '메인',
            'changelog' => '변경 사항',
            'beatmaps' => '비트맵 목록',
            'download' => 'osu! 다운로드',
            'wiki' => '위키',
        ],
        'help' => [
            '_' => '도움말 & 커뮤니티',
            'faq' => '자주 묻는 질문',
            'forum' => '커뮤니티 포럼',
            'livestreams' => '라이브 스트림',
            'report' => '문제 신고하기',
        ],
        'support' => [
            '_' => 'osu! 지원',
            'tags' => '서포터 태그',
            'merchandise' => '상품',
        ],
        'legal' => [
            '_' => '법률 & 상태',
            'copyright' => '저작권 (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => '서버 상태 확인',
            'terms' => '서비스 이용약관',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Page Missing',
            'description' => 'Sorry, but the page you requested isn\'t here!',
            'link' => false,
        ],
        '403' => [
            'error' => 'You shouldn\'t be here.',
            'description' => 'You could try going back, though.',
            'link' => false,
        ],
        '401' => [
            'error' => 'You shouldn\'t be here.',
            'description' => 'You could try going back, though. Or maybe logging in.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Page Missing',
            'description' => 'Sorry, but the page you requested isn\'t here!',
            'link' => false,
        ],
        '500' => [
            'error' => 'Oh no! Something broke! ;_;',
            'description' => 'We\'re automatically notified of every error.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Oh no! Something broke (badly)! ;_;',
            'description' => 'We\'re automatically notified of every error.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Down for maintenance!',
            'description' => 'Maintenance usually takes anywhere from 5 seconds to 10 minutes. If we\'re down for longer, see :link for more information.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Just in case, here\'s a code you can give to support!',
    ],

    'popup_login' => [
        'login' => [
            'email' => '이메일 주소',
            'forgot' => '계정 정보를 잊어버렸어요.',
            'password' => '비밀번호',
            'title' => '로그인하여 계속하기',

            'error' => [
                'email' => '존재하지 않는 유저이름 또는 이메일입니다.',
                'password' => '비밀번호가 틀렸습니다.',
            ],
        ],

        'register' => [
            'info' => '계정이 필요합니다, 하나 만들어보시는 건 어때요?',
            'title' => '아직 계정이 없으신가요?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '설정',
            'friends' => '친구',
            'logout' => '로그아웃',
            'profile' => '내 프로필',
        ],
    ],

    'popup_search' => [
        'initial' => '검색어를 입력해주세요!',
        'retry' => '검색에 실패했습니다. 다시 시도하려면 클릭해주세요.',
    ],
];
