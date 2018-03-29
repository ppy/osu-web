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
        'page_description' => 'osu! - 리듬은 단순한 *클릭*만으로도 만들어질 수 있습니다! 응원단/리듬히어로, 태고와 이외 독자적인 게임플레이 모드, 완벽한 기능을 갖춘 맵 에디터까지 준비되어 있습니다.',
    ],

    'menu' => [
        'home' => [
            '_' => '메인',
            'account-edit' => '설정',
            'friends-index' => '친구',
            'changelog-index' => '변경 사항',
            'changelog-show' => '빌드 버전',
            'getDownload' => '다운로드',
            'getIcons' => '아이콘',
            'groups-show' => '그룹',
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
            'getSupport' => '지원 센터', // osu!support와 혼동될까봐 "센터"를 추가 (obsolete)
            'getWiki' => '위키',
            'wiki-show' => '위키',
        ],
        'beatmaps' => [
            '_' => '비트맵',
            'show' => '정보',
            'index' => '목록',
            'artists' => '주요 아티스트',
            'packs' => '모음집',
            'beatmapset-watches-index' => '모딩 확인 목록',
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
            'dev' => 'osu!개발진',
            'getForum' => '포럼', // Base text changed to plural, please check.
            'getChat' => '채팅',
            'getLive' => '라이브 스트림',
            'contests' => '콘테스트',
            'profile' => '프로필',
            'tournaments' => '대회',
            'tournaments-index' => '대회',
            'tournaments-show' => '대회 정보',
            'forum-topic-watches-index' => '구독',
            'forum-topics-create' => '포럼', // Base text changed to plural, please check.
            'forum-topics-show' => '포럼', // Base text changed to plural, please check.
            'forum-forums-index' => '포럼', // Base text changed to plural, please check.
            'forum-forums-show' => '포럼', // Base text changed to plural, please check.
        ],
        'multiplayer' => [
            '_' => '멀티플레이어', // 'multiplayer'
            'show' => '매치', // 'match'
        ],
        'error' => [
            '_' => '오류',
            '404' => '찾을 수 없음',
            '403' => '거부됨', // 금지됨
            '401' => '권한 없음',
            '405' => '찾을 수 없음', // '허용되지 않는 방법'에 해당하는 상태 코드가 맞으나, 원문은 missing이므로 404와 같이 번역처리
            '500' => '내부 서버 오류', // 내부 서버 오류, 원문은 'something broke'이었으나, 사용자가 납득할만한 번역을 찾지 못해 서버오류로 표현
            '503' => '서비스 점검 ', // 서버가 오버로드되었거나 유지관리를 위해 다운되었기 때문에 현재 서버를 사용할 수 없는 상태.
        ],
        'user' => [
            '_' => '유저',
            'getLogin' => '로그인',
            'disabled' => '비활성 상태', // disabled

            'register' => '회원 가입',
            'reset' => '복원',
            'new' => '새',

            'messages' => '메세지',
            'settings' => '설정',
            'logout' => '로그아웃', // Base text changed from "Log Out" to "Sign Out", please check.
            'help' => '도움말',
        ],
        'store' => [
            '_' => '상점',
            'getListing' => '목록',
            'cart-show' => '장바구니',

            'getCheckout' => '결제',
            'getInvoice' => '청구서',
            'products-show' => '상품',

            'new' => '새',
            'home' => '메인', // 'home'
            'index' => '메인', // 'home'
            'thanks' => '감사합니다',
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
            'root' => '목록', // 'index'
            'logs-index' => '기록', // 'log'
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
            'tags' => '서포터 권한',
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
            'error' => '페이지를 찾을 수 없음',
            'description' => '죄송하지만, 저희는 요청하신 페이지를 갖고있질 않네요!',
            'link' => false,
        ],
        '403' => [
            'error' => '여기 계시면 안됩니다.',
            'description' => '다시 돌아가보세요.',
            'link' => false,
        ],
        '401' => [
            'error' => '여기 계시면 안됩니다.',
            'description' => '다시 돌아가보세요. 로그인하시면 해결될지도요...',
            'link' => false,
        ],
        '405' => [
            'error' => '페이지를 찾을 수 없음',
            'description' => '죄송하지만, 저희는 요청하신 페이지를 갖고있질 않네요!',
            'link' => false,
        ],
        '500' => [
            'error' => '이런! 뭔가 잘못 되었네요! ;_;',
            'description' => '저희는 모든 에러를 자동으로 보고받고 있습니다.',
            'link' => false,
        ],
        'fatal' => [
            'error' => '이런! 뭔가 잘못 되었네요! (심각한데요...) ;_;',
            'description' => '저희는 모든 에러를 자동으로 보고받고 있습니다.',
            'link' => false,
        ],
        '503' => [
            'error' => '서비스 점검중입니다!',
            'description' => '점검은 보통 5분 내지 10분 동안 이루어집니다. 만약 더 오래 걸린다면, :link에서 더 많은 정보를 확인하실 수 있습니다.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => '만약을 위해, 지원팀에게 보낼 수 있는 코드를 알려드릴게요!',
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
            'logout' => '로그아웃', // Base text changed from "Log Out" to "Sign Out", please check.
            'profile' => '내 프로필',
        ],
    ],

    'popup_search' => [
        'initial' => '검색어를 입력해주세요!',
        'retry' => '검색에 실패했습니다. 다시 시도하려면 클릭해주세요.',
    ],
];
