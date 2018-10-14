<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'landing' => [
        'download' => '지금 바로 다운로드하기',
        'online' => '<strong>:players</strong>명의 플레이어가 현재 접속 중이며, <strong>:games</strong> 개의 게임이 개설되어 있습니다.',
        'peak' => '최다 동시 접속자 수: :count명',
        'players' => '가입된 플레이어: <strong>:count</strong>명',

        'slogan' => [
            'main' => '무료 리듬 게임',
            'sub' => '리듬은 이미, 그 손끝에',
        ],
    ],

    'search' => [
        'advanced_link' => '고급 검색',
        'button' => '검색',
        'empty_result' => '아무것도 찾지 못했습니다!',
        'missing_query' => '검색하려면 적어도 :n글자는 적어주셔야 합니다.',
        'placeholder' => '검색어를 입력해주세요',
        'title' => '검색',

        'beatmapset' => [
            'more' => ':count개의 비트맵 검색 결과 더 보기',
            'more_simple' => '비트맵 검색 결과 더 보기',
            'title' => '비트맵',
        ],

        'forum_post' => [
            'all' => '모든 포럼',
            'link' => '포럼 검색하기',
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
        'tagline' => "자, 시작해 보자!",
        'action' => 'osu! 다운로드',
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
                'description' => '게임을 시작하면 로그인하거나 계정을 만드는 절차를 따르세요.',
            ],
            'download' => [
                'title' => '게임 다운로드!',
                'description' => '위 버튼을 눌러 설치 프로그램을 다운받고, 실행하세요!',
            ],
            'beatmaps' => [
                'title' => '비트맵 받기',
                'description' => [
                    '_' => '유저들이 만든 비트맵의 광대한 라이브러리를:browse하고 시작해 보세요!',
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
            'welcome' => '<strong>:username</strong>님, 안녕하세요!',
            'messages' => '새로 받은 메시지 :count건이 있습니다',
            'stats' => [
                'friends' => '접속 중인 친구',
                'games' => '게임 수',
                'online' => '접속 중인 플레이어',
            ],
        ],
        'beatmaps' => [
            'new' => '새로 Ranked된 비트맵',
            'popular' => '인기 비트맵',
            'by' => '제작:',
            'plays' => ':count번 플레이됨',
        ],
        'buttons' => [
            'download' => 'osu! 다운로드',
            'support' => 'osu! 지원하기',
            'store' => 'osu!상점',
        ],
    ],

    'support-osu' => [
        'title' => '와!',
        'subtitle' => '즐거운 시간을 보내고 계신 것 같네요! :D',
        'body' => [
            'part-1' => 'osu!가 아무런 광고 수익 없이, 사용자들의 지원으로만 개발 / 운영된다는 사실, 알고 계신가요?',
            'part-2' => '그리고 또, osu!를 지원하면 게임 내 자동 다운로드 같은 다양한 유용한 기능들을 이용할 수 있다는 점도 알고 계세요?',
        ],
        'find-out-more' => '더 알아보려면 여기를 눌러주세요!',
        'download-starting' => "아, 걱정은 하지마세요 - 요청하신 다운로드는 이미 시작됐으니까요 ;)",
    ],
];
