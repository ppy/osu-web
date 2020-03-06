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
    'index' => [
        'description' => '비슷한 테마를 기준으로 모아놓은 비트맵 모음집입니다.',
        'nav_title' => '목록',
        'title' => '비트맵 팩',

        'blurb' => [
            'important' => '[[ 다운로드 하기 전에 읽어주세요 ]]',
            'instruction' => [
                '_' => "설치 방법: 맵팩 다운로드가 끝나면 .rar 파일을 osu!의 Songs 폴더에 압축 해제하세요.
                    맵팩에 동봉된 모든 곡은 .zip 또는 .osz로 압축된 상태입니다. 플레이하기 전 osu!가 직접 비트맵들을 압축 해제할 것입니다.
                    :scary 여러분이 직접 압축을 해제하지 마세요. 그렇게 되면
                    osu!가 이를 비정상적으로 받아들이고 제대로 작동하지 않을 수 있습니다.",
                'scary' => '절대',
            ],
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
