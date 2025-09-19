<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'osu! 공식 아티스트',
    'title' => '공식 아티스트',

    'admin' => [
        'hidden' => '아티스트가 현재 감춰져 있습니다',
    ],

    'beatmaps' => [
        '_' => '비트맵',
        'download' => '비트맵 템플릿 다운로드',
        'download-na' => '비트맵 템플릿 준비중',
    ],

    'index' => [
        'description' => '공식 아티스트란 원곡과 새로운 곡을 osu!에 사용할 수 있도록 협력 중인 작곡가 분들을 의미해요. 이 작곡가 분들과 트랙의 모음들은 모두 osu! 운영 팀이 맵 제작에 적절한지와 멋드러지는 곡인지를 판단한 후 직접 고른 것이예요. 일부 공식 아티스트는 osu!에서만 사용할 수 있는 독점 곡들을 제작해 주시기도 했답니다.<br><br>여기에 있는 모든 곡들은 타이밍이 맞춰진 .osz 파일과 함께 제공되며 osu!와 osu!와 관련된 컨텐츠에 사용할 수 있도록 공식적으로 라이선싱이 되어 있어요.',
    ],

    'links' => [
        'beatmaps' => 'osu! 비트맵',
        'osu' => 'osu! 프로필',
        'site' => '공식 웹사이트',
    ],

    'songs' => [
        '_' => '곡',
        'count' => ':count 곡',
        'original' => 'osu! 오리지널',
        'original_badge' => '오리지널',
    ],

    'tracklist' => [
        'title' => '제목',
        'length' => '길이',
        'bpm' => 'bpm',
        'genre' => '장르',
    ],

    'tracks' => [
        'index' => [
            '_' => '트랙 검색',

            'exclusive_only' => [
                'all' => '전체',
                'exclusive_only' => 'osu! 오리지널',
            ],

            'form' => [
                'advanced' => '고급 검색',
                'album' => '앨범',
                'artist' => '아티스트',
                'bpm_gte' => '최소 BPM',
                'bpm_lte' => '최대 BPM',
                'empty' => '검색 조건과 일치하는 곡을 찾을 수 없었어요.',
                'exclusive_only' => '타입',
                'genre' => '장르',
                'genre_all' => '전체',
                'length_gte' => '최소 길이',
                'length_lte' => '최대 길이',
            ],
        ],
    ],
];
