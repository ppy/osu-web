<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => '지금 바로 다운로드하기',
        'online' => '<strong>:players</strong>명이 현재 접속 중이며, <strong>:games</strong>개의 게임이 개설되어 있습니다.',
        'peak' => '최다 동시 접속자 수: :count명',
        'players' => '<strong>:count</strong>명이 가입되어 있고',
        'title' => '환영합니다',
        'see_more_news' => '뉴스 더 보기',

        'slogan' => [
            'main' => '최고의 무료 리듬 게임',
            'sub' => '리듬은 이미, 그 손끝에',
        ],
    ],

    'search' => [
        'advanced_link' => '고급 검색',
        'button' => '검색',
        'empty_result' => '아무것도 찾지 못했습니다!',
        'keyword_required' => '검색 키워드가 필요합니다',
        'placeholder' => '검색어를 입력하세요',
        'title' => '검색',

        'artist_track' => [
            'more_simple' => '공식 아티스트 곡 검색 결과 더 보기',
        ],
        'beatmapset' => [
            'login_required' => '비트맵을 검색하기 위해서 로그인',
            'more' => ':count개의 비트맵 검색 결과 더 보기',
            'more_simple' => '비트맵 검색 결과 더 보기',
            'title' => '비트맵',
        ],

        'forum_post' => [
            'all' => '모든 포럼',
            'link' => '포럼 검색하기',
            'login_required' => '포럼을 검색하기 위해서 로그인',
            'more_simple' => '포럼 검색 결과 더 보기',
            'title' => '포럼',

            'label' => [
                'forum' => '포럼에서 검색하기',
                'forum_children' => '서브포럼을 포함하여 검색',
                'include_deleted' => '삭제된 글 포함',
                'topic_id' => '주제 #',
                'username' => '글쓴이',
            ],
        ],

        'mode' => [
            'all' => '모두',
            'artist_track' => '공식 아티스트 곡',
            'beatmapset' => '비트맵',
            'forum_post' => '포럼',
            'team' => '팀',
            'user' => '플레이어',
            'wiki_page' => '위키',
        ],

        'team' => [
            'more_simple' => '팀 검색 결과 더 보기',
        ],

        'user' => [
            'login_required' => '유저를 검색하기 위해서 로그인',
            'more' => ':count명의 플레이어 검색 결과 더 보기',
            'more_simple' => '플레이어 검색 결과 더 보기',
            'more_hidden' => '플레이어 검색은 최대 :max명 까지 가능합니다. 다른 검색어로 시도해보세요.',
            'title' => '플레이어',
        ],

        'wiki_page' => [
            'link' => '위키에서 검색하기',
            'more_simple' => '위키 검색 결과 더 보기',
            'title' => '위키',
        ],
    ],

    'download' => [
        'action' => 'osu! 다운로드',
        'action_lazer' => 'osu!(lazer) 다운로드',
        'action_lazer_description' => 'osu!의 다음 메이저 업데이트',
        'action_lazer_info' => '이 페이지에서 자세한 정보를 확인해보세요.',
        'action_lazer_title' => 'osu!(lazer) 체험하기',
        'action_title' => 'osu! 다운로드',
        'for_os' => ':os 전용',
        'macos-fallback' => 'macOS 유저',
        'mirror' => '미러',
        'or' => '혹은',
        'os_version_or_later' => ':os_version 이상',
        'other_os' => '다른 플랫폼',
        'quick_start_guide' => '빠른 시작 안내',
        'tagline' => "시작해 보세요!",
        'video-guide' => '영상 가이드',

        'help' => [
            '_' => '만약 게임 시작이나 계정 등록에 문제가 발생했다면, :help_forum_link 하거나 :support_button 해 주세요.',
            'help_forum_link' => '도움말 포럼을 확인',
            'support_button' => '지원 팀에 연락',
        ],

        'os' => [
            'windows' => 'Windows 용',
            'macos' => 'macOS 용',
            'linux' => 'Linux 용',
        ],
        'steps' => [
            'register' => [
                'title' => '계정 만들기',
                'description' => '로그인을 하시거나 새로운 계정을 생성하시려면 게임 시작 시 나타나는 절차를 따라주세요.',
            ],
            'download' => [
                'title' => '게임 다운로드!',
                'description' => '위의 버튼을 클릭해서 프로그램을 다운로드받고, 실행해 보세요!',
            ],
            'beatmaps' => [
                'title' => '비트맵 받기',
                'description' => [
                    '_' => '유저들이 만든 비트맵의 광대한 라이브러리를 :browse하고 시작해 보세요!',
                    'browse' => '탐색',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => '대시보드',
        'news' => [
            'title' => '뉴스',
            'error' => '뉴스를 불러오는 도중 문제가 발생했습니다, 페이지를 한 번 새로고침 해보시겠어요?...',
        ],
        'header' => [
            'stats' => [
                'friends' => '접속 중인 친구',
                'games' => '게임 수',
                'online' => '접속 중인 플레이어',
            ],
        ],
        'beatmaps' => [
            'daily_challenge' => '일일 도전 비트맵',
            'new' => '새로 랭크된 비트맵',
            'popular' => '인기 비트맵',
            'by_user' => ':user님이 만듦',
            'resets' => ':ends 후에 초기화',
        ],
        'buttons' => [
            'download' => 'osu! 다운로드',
            'support' => 'osu! 지원하기',
            'store' => 'osu!store',
        ],
        'show' => [
            'admin' => [
                'page' => '관리자 콘솔 열기',
            ],
        ],
    ],
];
