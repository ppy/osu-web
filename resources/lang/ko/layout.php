<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '다음 트랙 자동 재생',
    ],

    'defaults' => [
        'page_description' => 'osu! - 리듬은 단순한 *클릭*만으로도 만들어질 수 있습니다! 응원단/리듬히어로, 태고와 이외 독자적인 게임플레이 모드, 완벽한 기능을 갖춘 맵 에디터까지 준비되어 있습니다.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => '비트맵셋',
            'beatmapset_covers' => '비트맵셋 커버',
            'contest' => '콘테스트',
            'contests' => '콘테스트',
            'root' => '콘솔',
        ],

        'artists' => [
            'index' => '목록',
        ],

        'changelog' => [
            'index' => '목록',
        ],

        'help' => [
            'index' => '목록',
            'sitemap' => '사이트맵',
        ],

        'store' => [
            'cart' => '장바구니',
            'orders' => '주문 내역',
            'products' => '상품',
        ],

        'tournaments' => [
            'index' => '목록',
        ],

        'users' => [
            'modding' => '모딩',
            'playlists' => '',
            'realtime' => '',
            'show' => '정보',
        ],
    ],

    'gallery' => [
        'close' => '닫기 (Esc)',
        'fullscreen' => '전체화면 전환',
        'zoom' => '확대 / 축소',
        'previous' => '이전 (왼쪽 방향키)',
        'next' => '다음 (오른쪽 방향키)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => '비트맵',
        ],
        'community' => [
            '_' => '커뮤니티',
            'dev' => '개발',
        ],
        'help' => [
            '_' => '도움말',
            'getAbuse' => '악용 사례 신고',
            'getFaq' => 'FAQ',
            'getRules' => '규칙',
            'getSupport' => '지원 센터',
        ],
        'home' => [
            '_' => '메인',
            'team' => '운영진',
        ],
        'rankings' => [
            '_' => '순위',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => '상점',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '일반',
            'home' => '메인',
            'changelog-index' => '변경 사항',
            'beatmaps' => '비트맵 목록',
            'download' => 'osu! 다운로드',
        ],
        'help' => [
            '_' => '도움말 & 커뮤니티',
            'faq' => '자주 묻는 질문',
            'forum' => '커뮤니티 포럼',
            'livestreams' => '라이브 스트림',
            'report' => '문제 신고하기',
            'wiki' => '위키',
        ],
        'legal' => [
            '_' => '법률 & 상태',
            'copyright' => '저작권 (DMCA)',
            'privacy' => '개인 정보 보호 정책',
            'server_status' => '서버 상태 확인',
            'source_code' => '소스 코드',
            'terms' => '서비스 이용약관',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '요청 매개변수가 올바르지 않습니다',
            'description' => '',
        ],
        '404' => [
            'error' => '페이지를 찾을 수 없음',
            'description' => "죄송하지만, 저희는 요청하신 페이지를 갖고있질 않네요!",
        ],
        '403' => [
            'error' => "여기 계시면 안됩니다.",
            'description' => '다시 돌아가보세요.',
        ],
        '401' => [
            'error' => "여기 계시면 안됩니다.",
            'description' => '다시 돌아가보세요. 로그인하시면 해결될지도요...',
        ],
        '405' => [
            'error' => '페이지를 찾을 수 없음',
            'description' => "죄송하지만, 저희는 요청하신 페이지를 갖고있질 않네요!",
        ],
        '422' => [
            'error' => '요청 매개변수가 올바르지 않습니다.',
            'description' => '',
        ],
        '429' => [
            'error' => '요청 제한 초과됨',
            'description' => '',
        ],
        '500' => [
            'error' => '이런! 뭔가 잘못 되었네요! ;_;',
            'description' => "저희는 모든 오류를 자동으로 보고받고 있습니다.",
        ],
        'fatal' => [
            'error' => '이런! 뭔가 잘못 되었네요! (심각한데요...) ;_;',
            'description' => "저희는 모든 오류를 자동으로 보고받고 있습니다.",
        ],
        '503' => [
            'error' => '서비스 점검중입니다!',
            'description' => "점검은 보통 5분 내지 10분 동안 이루어집니다. 만약 더 오래 걸린다면 :link에서 더 많은 정보를 확인하실 수 있습니다.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "만약을 위해, 지원팀에게 보낼 수 있는 코드를 알려드릴게요!",
    ],

    'popup_login' => [
        'button' => '로그인 / 등록',

        'login' => [
            'forgot' => "계정 정보를 잊어버렸어요.",
            'password' => '비밀번호',
            'title' => '로그인하여 계속하기',
            'username' => '사용자 이름',

            'error' => [
                'email' => "존재하지 않는 유저이름 또는 이메일입니다.",
                'password' => '잘못된 비밀번호입니다.',
            ],
        ],

        'register' => [
            'download' => '다운로드',
            'info' => 'osu!를 다운로드하여 계정을 만들어보세요.',
            'title' => "아직 계정이 없으신가요?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '설정',
            'follows' => '관심 목록',
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
