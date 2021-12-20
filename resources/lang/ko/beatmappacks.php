<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => '비슷한 테마를 기준으로 모아놓은 비트맵 모음집입니다.',
        'nav_title' => '목록',
        'title' => '비트맵 팩',

        'blurb' => [
            'important' => '[[ 다운로드 하기 전에 읽어주세요 ]]',
            'install_instruction' => '',
            'note' => [
                '_' => '옛날 맵들은 최신 맵보다 질적으로 떨어질 수 있기 때문에 저희는 :scary을 강력히 추천합니다.',
                'scary' => '최근에 나온 맵팩 순으로 내려받는 것',
            ],
        ],
    ],

    'show' => [
        'download' => '다운로드',
        'item' => [
            'cleared' => '클리어한 맵',
            'not_cleared' => '클리어 기록 없음',
        ],
        'no_diff_reduction' => [
            '_' => ':link는 이 팩을 지우는 데 사용할 수 없습니다.',
            'link' => '난이도 감소 모드',
        ],
    ],

    'mode' => [
        'artist' => '아티스트/앨범',
        'chart' => '스포트라이트',
        'standard' => '표준',
        'theme' => '테마',
    ],

    'require_login' => [
        '_' => '다운로드하려면 :link하셔야 합니다',
        'link_text' => '로그인',
    ],
];
