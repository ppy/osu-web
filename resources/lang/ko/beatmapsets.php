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

    'cover' => [
        'deleted' => '삭제된 비트맵',
    ],

    'download' => [
        'limit_exceeded' => '잠시 멈추시고, 좀 더 플레이해보세요.',
        'no_mirrors' => '다운로드를 할 서버가 존재하지 않습니다.',
    ],

    'featured_artist_badge' => [
        'label' => '공식 아티스트',
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
            'no_video' => '영상이 없는 것으로 받기',
            'direct' => 'osu!direct에서 열기',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => '견습 노미네이터는 여러 게임 모드를 가진 비트맵을 노미네이트 할 수 없습니다.',
        'full_nomination_required' => '이 게임 모드를 최종 노미네이션 하려면 정식 노미네이터여야 합니다.',
        'hybrid_requires_modes' => '하이브리드 비트맵 셋은 노미네이트 할 플레이 모드를 하나 이상 선택해야 합니다.',
        'incorrect_mode' => ':mode 모드를 노미네이트 할 권한을 가지고 있지 않습니다.',
        'invalid_limited_nomination' => '이 비트맵에 적합하지 않은 노미네이션이 있어 Qualify 할 수 없는 상태입니다.',
        'invalid_ruleset' => '이 노미네이션의 게임 모드가 잘못되었습니다.',
        'too_many' => '노미네이션 요구 사항을 이미 만족했습니다.',
        'too_many_non_main_ruleset' => '메인이 아닌 모드에 대한 노미네이션 조건이 충족되었습니다.',

        'dialog' => [
            'confirmation' => '정말로 이 비트맵을 노미네이트 하시겠어요?',
            'different_nominator_warning' => '다른 노미네이터가 이 비트맵을 Qualify하면 Qualification 대기열의 순서가 초기화됩니다.',
            'header' => '비트맵 노미네이트',
            'hybrid_warning' => '주의: 딱 한 번만 노미네이트 할 수 있으므로 자신이 노미네이트 하려는 모든 게임 모드를 선택했는지 확인해주세요.',
            'current_main_ruleset' => '메인 모드는 현재 :ruleset입니다.',
            'which_modes' => '어떤 모드를 노미네이트 하겠습니까?',
        ],
    ],

    'nsfw_badge' => [
        'label' => '19금',
    ],

    'show' => [
        'discussion' => '토론',

        'admin' => [
            'full_size_cover' => '전체 사이즈 커버 이미지 보기',
        ],

        'deleted_banner' => [
            'title' => '이 비트맵은 삭제되었습니다.',
            'message' => '(관리자만 볼 수 있습니다)',
        ],

        'details' => [
            'by_artist' => 'by :artist',
            'favourite' => '즐겨찾기',
            'favourite_login' => '로그인하여 이 비트맵을 즐겨찾기 하세요.',
            'logged-out' => '로그인 후 비트맵을 다운로드하세요!',
            'mapped_by' => ':mapper님의 맵',
            'mapped_by_guest' => ':mapper님의 게스트 난이도',
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
            'approved' => ':timeago에 Approved 상태가 됨',
            'loved' => ':timeago에 Loved 상태가 됨',
            'qualified' => ':timeago에 Qualified 상태가 됨',
            'ranked' => ':timeago에 Ranked 상태가 됨',
            'submitted' => ':timeago에 제출됨',
            'updated' => ':timeago에 마지막으로 수정',
        ],

        'favourites' => [
            'limit_reached' => '즐겨찾기 한 비트맵이 너무 많아요. 추가하기 전에 즐겨찾기 한 곡들의 수를 줄여주세요.',
        ],

        'hype' => [
            'action' => '이 맵이 마음에 드신다면 <strong>Ranked</strong> 상태가 될 수 있도록 Hype 하여 도움을 주세요.',

            'current' => [
                '_' => '이 맵은 현재 :status 상태입니다.',

                'status' => [
                    'pending' => '대기',
                    'qualified' => 'Qualified',
                    'wip' => '제작 중',
                ],
            ],

            'disqualify' => [
                '_' => '이 비트맵에 문제가 있다면 :link에서 디스퀄리파이 해 주세요.',
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
            'mapper_tags' => '맵 제작자 태그',
            'no_scores' => '데이터를 수집중입니다...',
            'nominators' => '노미네이터',
            'nsfw' => '부적절한 내용',
            'offset' => '온라인 오프셋',
            'points-of-failure' => '실패 지점',
            'source' => '출처',
            'storyboard' => '이 비트맵은 스토리보드를 포함합니다.',
            'success-rate' => '클리어 비율',
            'user_tags' => '사용자 태그',
            'video' => '이 비트맵은 영상을 포함합니다.',
        ],

        'nsfw_warning' => [
            'details' => '이 비트맵은 노골적, 폭력적 혹은 혐오감이 들 수 있는 내용을 포함하고 있습니다. 그래도 보시겠어요?',
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
            'error' => '랭킹 로딩에 실패했습니다',
            'friend' => '친구 순위',
            'global' => '전체 순위',
            'supporter-link' => '서포터로서 누릴 수 있는 다른 멋진 기능들을 확인하려면 <a href=":link">여기</a>를 클릭해주세요!',
            'supporter-only' => 'osu! 서포터가 되어야 국가 및 친구 간 순위를 확인할 수 있습니다!',
            'team' => '팀 순위',
            'title' => '점수판',

            'headers' => [
                'accuracy' => '정확도',
                'combo' => '최대 콤보',
                'miss' => 'Miss',
                'mods' => '모드',
                'pin' => '고정',
                'player' => '플레이어',
                'pp' => '',
                'rank' => '순위',
                'score' => '점수',
                'score_total' => '총 점수',
                'time' => '시간',
            ],

            'no_scores' => [
                'country' => '아직 소속 국가에서 점수를 기록한 사람이 없습니다!',
                'friend' => '아직 친구들 중 점수를 기록한 사람이 없습니다!',
                'global' => '아직 기록된 점수가 없네요. 한 번 기록해보시는 건 어때요?',
                'loading' => '점수 불러오는 중...',
                'team' => '이 맵에서 점수를 낸 팀원이 없어요!',
                'unranked' => '랭크되지 않은 비트맵입니다.',
            ],
            'score' => [
                'first' => '순위권',
                'own' => '내 최고 점수',
            ],
            'supporter_link' => [
                '_' => '서포터가 누릴 수 있는 다른 멋진 기능들을 확인하려면 :here를 클릭해주세요!',
                'here' => '여기',
            ],
        ],

        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => '키 개수',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => 'Star Rating',
            'total_length' => '길이 (소비 길이: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => '서클 개수',
            'count_sliders' => '슬라이더 개수',
            'offset' => '온라인 오프셋 :offset',
            'user-rating' => '유저 평점',
            'rating-spread' => '평점 분포도',
            'nominations' => '노미네이션',
            'playcount' => '플레이 횟수',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => '퀄리파이 됨',
            'wip' => '제작 중',
            'pending' => '대기 중',
            'graveyard' => '무덤에 감',
        ],
    ],

    'spotlight_badge' => [
        'label' => '스포트라이트',
    ],
];
