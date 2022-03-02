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
        'see_more_news' => '소식 더 보기',

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
        'placeholder' => '검색어를 입력해주세요',
        'title' => '검색',

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
                'topic_id' => '주제 #',
                'username' => '글쓴이',
            ],
        ],

        'mode' => [
            'all' => '모두',
            'beatmapset' => '비트맵',
            'forum_post' => '포럼',
            'user' => '플레이어',
            'wiki_page' => '위키',
        ],

        'user' => [
            'login_required' => '사용자를 검색하기 위해서 로그인',
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
        'tagline' => "시작해봐요!",
        'action' => 'osu! 다운로드',

        'help' => [
            '_' => '게임을 시작하거나 계정을 등록하는데 문제가 있다면, :help_forum_link 하거나 :support_button 해보세요.',
            'help_forum_link' => '도움말 포럼을 확인',
            'support_button' => '지원 팀에 연락',
        ],

        'os' => [
            'windows' => 'Windows 용',
            'macos' => 'macOS 용',
            'linux' => 'Linux 용',
        ],
        'mirror' => '미러',
        'macos-fallback' => 'macOS 사용자',
        'steps' => [
            'register' => [
                'title' => '계정 만들기',
                'description' => '게임을 시작하면 로그인하거나 계정을 만드는 절차를 따라주세요.',
            ],
            'download' => [
                'title' => '게임 다운로드!',
                'description' => '위 버튼을 눌러 설치 프로그램을 다운받고, 실행하세요!',
            ],
            'beatmaps' => [
                'title' => '비트맵 받기',
                'description' => [
                    '_' => '유저들이 만든 비트맵의 광대한 라이브러리를 :browse하고 시작해 보세요!',
                    'browse' => '탐색',
                ],
            ],
        ],
        'video-guide' => '영상 가이드',
    ],

    'user' => [
        'title' => '대시보드',
        'news' => [
            'title' => '소식',
            'error' => '소식을 불러오는 도중 문제가 발생했습니다, 페이지를 한 번 새로고침 해보시겠어요?...',
        ],
        'header' => [
            'stats' => [
                'friends' => '접속 중인 친구',
                'games' => '게임 수',
                'online' => '접속 중인 플레이어',
            ],
        ],
        'beatmaps' => [
            'new' => '새로 Ranked된 비트맵',
            'popular' => '인기 비트맵',
            'by_user' => ':user 님이 만듦',
        ],
        'buttons' => [
            'download' => 'osu! 다운로드',
            'support' => 'osu! 지원하기',
            'store' => 'osu!store',
        ],
    ],
];
