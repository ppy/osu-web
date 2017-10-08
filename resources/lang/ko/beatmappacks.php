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
    'index' => [
        'blurb' => [
            'important' => '[[ 다운로드 하기 전에 읽어주세요 ]]',
            'instruction' => [
                '_' => "설치 방법: 맵팩 다운로드가 끝나면, .rar 파일안의 내용물을 osu!의 Songs폴더에 압축 해제합니다.
                    맵팩에 동봉된 모든 곡들은 .zip 또는 .osz로 압축된 상태입니다. 따라서, 플레이하기 전에 osu! 프로그램이 이 비트맵들을 압축 해제할 필요가 있습니다.
                    :scary 여러분이 직접 압축을 풀지 마세요. 직접 풀게되면,
                    osu! 프로그램이 이를 비정상적으로 받아들이고 제대로 작동하지 않을 수 있습니다.",
                'scary' => '절대',
            ],
            'note' => [
                '_' => '또한, 저희는 :scary을 강력히 추천합니다. 정말 오래된 맵들은 요즘 나온 맵보다 질적으로 떨어질 수 있으니까요.',
                'scary' => '최신 맵팩부터 다운로드 하는것',
            ],
        ],
        'title' => '비트맵 팩',
        'description' => 'Pre-packaged collections of beatmaps based around a common theme.', // 공통된 주제를 기준으로 가포장된 모음집. (부드러운 번역 필요)
    ],

    'show' => [
        'download' => '다운로드',
        'item' => [
            'cleared' => 'cleared',
            'not_cleared' => 'not cleared',
        ],
    ],

    'mode' => [
        'artist' => '가수/앨범별',
        'chart' => '차트별',
        'standard' => '표준',
        'theme' => '테마별',
    ],

    'require_login' => [
        '_' => '다운로드하려면 :link하셔야 합니다',
        'link_text' => '로그인',
    ],
];
