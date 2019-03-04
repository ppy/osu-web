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
    'availability' => [
        'disabled' => '이 비트맵은 현재 다운로드할 수 없습니다.',
        'parts-removed' => '이 비트맵의 일부가 콘텐츠 제작자 또는 제삼자 권리자의 저작권 주장으로 인해 삭제되었습니다.',
        'more-info' => '더 많은 정보를 보려면 여기를 확인하세요.',
    ],

    'index' => [
        'title' => '비트맵 목록',
        'guest_title' => '비트맵',
    ],

    'show' => [
        'discussion' => '토론',

        'details' => [
            'approved' => 'approved된 날짜: ',
            'favourite' => '즐겨찾기',
            'favourited_count' => '및 +1명의 사람!|및 +:count명의 사람들!',
            'logged-out' => '로그인 후 비트맵을 다운로드하세요!',
            'loved' => 'loved된 날짜: ',
            'mapped_by' => ':mapper님의 맵',
            'qualified' => 'qualified된 날짜: ',
            'ranked' => 'ranked된 날짜: ',
            'submitted' => '만든 날짜: ',
            'unfavourite' => '즐겨찾기 해제',
            'updated' => '마지막 수정 날짜: ',
            'updated_timeago' => ':timeago에 마지막으로 수정됨',

            'download' => [
                '_' => '다운로드',
                'direct' => 'osu!다이렉트',
                'no-video' => '영상 미포함',
                'video' => '영상 포함',
            ],

            'login_required' => [
                'bottom' => '하여 더 많은 기능 사용',
                'top' => '로그인',
            ],
        ],

        'favourites' => [
            'limit_reached' => '즐겨찾기 한 비트맵이 너무 많습니다! 계속하기 전에 즐겨찾기 수를 줄여주세요.',
        ],

        'hype' => [
            'action' => '이 맵을 즐기셨다면 홍보해서 <strong>Ranked</strong> 상태가 될 수 있게 도와주세요.',

            'current' => [
                '_' => '이 맵은 현재 :status 상태입니다.',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => '제작 중',
                ],
            ],
        ],

        'info' => [
            'description' => '설명',
            'genre' => '장르',
            'language' => '언어',
            'no_scores' => '데이터를 수집중입니다...',
            'points-of-failure' => '실패 지점',
            'source' => '원작',
            'success-rate' => '클리어 비율',
            'tags' => '태그',
            'unranked' => 'Unranked beatmap',
        ],

        'scoreboard' => [
            'achieved' => ':when에 달성함',
            'country' => '국가 순위',
            'friend' => '친구 순위',
            'global' => '전체 순위',
            'supporter-link' => '서포터로서 누릴 수 있는 다른 멋진 기능들을 확인하려면 <a href=":link">여기</a>를 클릭해주세요!',
            'supporter-only' => '서포터가 되어야 국가 및 친구 간 순위를 확인할 수 있습니다!',
            'title' => '점수판',

            'headers' => [
                'accuracy' => '정확도',
                'combo' => '최대 콤보',
                'miss' => 'Miss',
                'mods' => '모드',
                'player' => '플레이어',
                'pp' => '',
                'rank' => '순위',
                'score_total' => '총 점수',
                'score' => '점수',
            ],

            'no_scores' => [
                'country' => '아직 소속 국가에서 점수를 기록한 사람이 없습니다!',
                'friend' => '아직 친구들 중 점수를 기록한 사람이 없습니다!',
                'global' => '아직 기록된 점수가 없네요. 한 번 기록해보시는 건 어때요?',
                'loading' => '점수 불러오는 중...',
                'unranked' => '랭크되지 않은 비트맵입니다.',
            ],
            'score' => [
                'first' => '순위권',
                'own' => '내 최고 점수',
            ],
        ],

        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => '키 개수',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => 'Star Difficulty',
            'total_length' => '길이',
            'bpm' => 'BPM',
            'count_circles' => 'Circle Count',
            'count_sliders' => 'Slider Count',
            'user-rating' => '유저 평점',
            'rating-spread' => '평점 분포도',
            'nominations' => '지명',
            'playcount' => '플레이 횟수',
        ],
    ],
];
