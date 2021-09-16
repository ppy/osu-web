<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => '이 비트맵은 현재 다운로드할 수 없습니다.',
        'parts-removed' => '이 비트맵의 일부가 콘텐츠 제작자 또는 제삼자 권리자의 저작권 주장으로 인해 삭제되었습니다.',
        'more-info' => '더 많은 정보를 보려면 여기를 확인하세요.',
        'rule_violation' => '이 맵에 포함된 일부 요소는 osu!에서 사용하기에 적합하지 않다고 판단되어 제거되었습니다.',
    ],

    'download' => [
        'limit_exceeded' => '잠시 멈추시고, 좀 더 플레이해보세요.',
    ],

    'featured_artist_badge' => [
        'label' => '',
    ],

    'index' => [
        'title' => '비트맵 목록',
        'guest_title' => '비트맵',
    ],

    'panel' => [
        'empty' => '비트맵 없음',

        'download' => [
            'all' => '다운로드',
            'video' => '영상 포함된 것으로 받기',
            'no_video' => '영상 없는 것으로 받기',
            'direct' => 'osu!direct에서 열기',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '하이브리드 비트맵 셋을 사용하려면 추천할 플레이 모드를 하나 이상 선택해야 합니다.',
        'incorrect_mode' => '이 모드 (:mode)를 추천할 권한을 가지고 있지 않습니다.',
        'full_bn_required' => '완전한 Nominator가 되어야만 이 qualify 추천을 할 수 있습니다.',
        'too_many' => '비트맵 추천 요구 사항을 이미 만족했습니다.',

        'dialog' => [
            'confirmation' => '정말로 이 비트맵을 추천하시겠어요?',
            'header' => '비트맵 추천',
            'hybrid_warning' => '주의: 오직 한 번만 추천할 수 있기에 원하는 게임 모드 전체를 선택했는지 확인해주세요.',
            'which_modes' => '어떤 모드로 추천하시겠어요?',
        ],
    ],

    'nsfw_badge' => [
        'label' => '19금',
    ],

    'show' => [
        'discussion' => '토론',

        'details' => [
            'by_artist' => ':artist 님이 만듦',
            'favourite' => '즐겨찾기',
            'favourite_login' => '로그인하여 이 비트맵을 즐겨찾기 하세요.',
            'logged-out' => '로그인 후 비트맵을 다운로드하세요!',
            'mapped_by' => ':mapper님의 맵',
            'unfavourite' => '즐겨찾기 해제',
            'updated_timeago' => ':timeago에 마지막으로 수정',

            'download' => [
                '_' => '다운로드',
                'direct' => '',
                'no-video' => '영상 미포함',
                'video' => '영상 포함',
            ],

            'login_required' => [
                'bottom' => '하여 더 많은 기능 사용',
                'top' => '로그인',
            ],
        ],

        'details_date' => [
            'approved' => ':timeago에 approved 됨',
            'loved' => ':timeago에 loved 됨',
            'qualified' => ':timeago에 qualified 됨',
            'ranked' => ':timeago에 ranked 됨',
            'submitted' => ':timeago에 제출됨',
            'updated' => ':timeago에 마지막으로 수정',
        ],

        'favourites' => [
            'limit_reached' => '즐겨찾기 한 비트맵이 너무 많아요. 추가하기 전에 즐겨찾기 한 곡들의 수를 줄여주세요.',
        ],

        'hype' => [
            'action' => '이 맵이 마음에 드신다면 <strong>Ranked</strong> 상태가 될 수 있도록 도움을 주게 Hype 해주세요.',

            'current' => [
                '_' => '이 맵은 현재 :status 상태입니다.',

                'status' => [
                    'pending' => '보류',
                    'qualified' => 'qualified',
                    'wip' => '제작 중',
                ],
            ],

            'disqualify' => [
                '_' => '이 비트맵에 문제가 있다면, :link해 주세요.',
            ],

            'report' => [
                '_' => '이 비트맵에 문제가 있다면 :link에서 저희에게 신고해 주세요.',
                'button' => '문제 보고',
                'link' => '여기',
            ],
        ],

        'info' => [
            'description' => '설명',
            'genre' => '장르',
            'language' => '언어',
            'no_scores' => '데이터를 수집중입니다...',
            'nsfw' => '부적절한 내용',
            'points-of-failure' => '실패 지점',
            'source' => '원작',
            'storyboard' => '이 비트맵은 스토리보드를 포함합니다.',
            'success-rate' => '클리어 비율',
            'tags' => '태그',
            'video' => '이 비트맵은 영상을 포함합니다.',
        ],

        'nsfw_warning' => [
            'details' => '이 비트맵은 노골적, 폭력적 혹은 혐오감을 들게 하는 내용이 포함되어 있습니다. 그래도 보시겠습니까?',
            'title' => '부적절한 내용',

            'buttons' => [
                'disable' => '경고 비활성화',
                'listing' => '비트맵 목록',
                'show' => '표시',
            ],
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
                'time' => '시간',
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
            'nominations' => '추천',
            'playcount' => '플레이 횟수',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => '제작 중',
            'pending' => 'Pending',
            'graveyard' => '무덤에 감',
        ],
    ],
];
