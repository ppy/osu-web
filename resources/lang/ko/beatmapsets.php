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
    'availability' => [
        'disabled' => '이 비트맵은 현재 다운로드할 수 없습니다.',
        'parts-removed' => '이 비트맵의 일부가 컨텐츠 제작자 또는 제삼자권리자의 저작권 주장으로 인해 삭제되었습니다.',
        'more-info' => '더 많은 정보를 보려면 여기를 확인하세요.',
    ],

    'index' => [
        'title' => '비트맵 목록',
        'guest_title' => '비트맵',
    ],

    'show' => [
        'discussion' => '토론',

        'details' => [
            'mapped_by' => ':mapper님이 제작한 맵',
            'submitted' => '맵 제출일: ',
            'updated' => '마지막 업데이트: ',
            'updated_timeago' => ':timeago에 마지막으로 업데이트됨',
            'ranked' => '랭크된 날짜: ',
            'approved' => 'approved된 날짜: ',
            'qualified' => 'qualified된 날짜: ',
            'loved' => 'loved된 날짜: ',
            'logged-out' => '비트맵을 받으려면 먼저 로그인하셔야 합니다!',
            'download' => [
                '_' => '다운로드',
                'video' => '영상 포함',
                'no-video' => '영상 미포함',
                'direct' => 'osu!다이렉트',
            ],
            'favourite' => '이 비트맵을 즐겨찾기에 등록',
            'unfavourite' => '이 비트맵을 즐겨찾기에서 제거',
            'favourited_count' => '및 +1명의 사람!|및 +:count명의 사람들!',
        ],
        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => 'Key Amount',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => '난이도(★)',
            'total_length' => 'Length',
            'bpm' => 'BPM',
            'count_circles' => 'Circle Count',
            'count_sliders' => 'Slider Count',
            'user-rating' => '유저 평점',
            'rating-spread' => '평점 분포도',
            'nominations' => '추천',
            'playcount' => '플레이 횟수',
        ],
        'info' => [
            'description' => '설명',
            'genre' => '장르',
            'language' => '언어',
            'no_scores' => '데이터가 여전히 계산되고 있습니다...',
            'points-of-failure' => '실패 지점',
            'source' => '원 작품',
            'success-rate' => '성공률',
            'tags' => '태그',
            'unranked' => '랭크되지 않은 비트맵',
        ],
        'scoreboard' => [
            'achieved' => ':when에 달성함',
            'country' => '국가별 순위',
            'friend' => '친구 순위',
            'global' => '전체 순위',
            'supporter-link' => '서포터로서 누릴 수 있는 다른 멋진 기능들을 확인하려면 <a href=":link">여기</a>를 클릭해주세요!',
            'supporter-only' => '서포터만 국가별 및 친구 간 순위를 확인할 수 있습니다!',
            'title' => '스코어보드',

            'headers' => [
                'accuracy' => '정확도',
                'combo' => '최대 콤보',
                'miss' => 'Miss',
                'mods' => '모드',
                'player' => '플레이어',
                'pp' => '',
                'rank' => '랭크',
                'score_total' => '총 점수',
                'score' => '점수',
            ],

            'no_scores' => [
                'country' => '아직 소속 국가에서 점수를 기록한 사람이 없습니다!',
                'friend' => '아직 친구들 중 점수를 기록한 사람이 없습니다!',
                'global' => '아직 기록된 점수가 없네요. 한 번 기록해보시는 건 어때요?',
                'loading' => '점수 불러오는 중...',
                'unranked' => '랭크되지 않은 비트맵.',
            ],
            'score' => [
                'first' => '순위권',
                'own' => '내 최고 점수',
            ],
        ],
    ],
];
