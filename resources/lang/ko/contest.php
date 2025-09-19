<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => '원을 클릭하는 것 말고도 더 다양한 방법으로 겨뤄보세요.',
        'large' => '커뮤니티 콘테스트',
    ],

    'index' => [
        'nav_title' => '목록',
    ],

    'judge' => [
        'comments' => '코멘트',
        'hide_judged' => '심사된 항목 숨기기',
        'nav_title' => '심사',
        'no_current_vote' => '아직은 투표할 수 없습니다.',
        'update' => '적용',
        'validation' => [
            'missing_score' => '존재하지 않는 점수',
            'contest_vote_judged' => '심사된 콘테스트에는 투표할 수 없습니다',
        ],
        'voted' => '이 출품작에는 이미 투표를 했습니다.',
    ],

    'judge_results' => [
        '_' => '심사 결과',
        'creator' => '제작자',
        'score' => '점수',
        'score_std' => '표준화된 점수',
        'total_score' => '총 점수',
        'total_score_std' => '표준화된 총점',
    ],

    'voting' => [
        'judge_link' => '이 콘테스트의 심사위원입니다. 출품작의 심사는 이곳에서 하세요!',
        'judged_notice' => '이 콘테스트는 심사 시스템을 사용하고 있으며, 심사위원이 현재 출품작을 처리하고 있습니다.',
        'login_required' => '투표하려면 로그인해주세요.',
        'over' => '이 콘테스트의 투표가 종료되었습니다.',
        'show_voted_only' => '투표한 항목만 보기',

        'best_of' => [
            'none_played' => "이 콘테스트에서 평가할 어떤 맵도 플레이하지 않으신 것 같네요.",
        ],

        'button' => [
            'add' => '투표',
            'remove' => '투표 제거',
            'used_up' => '모든 투표권을 사용했습니다',
        ],

        'progress' => [
            '_' => ':max개 중 :used개의 투표권 사용됨',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => '투표하기 전에 지정한 플레이리스트에 있는 모든 비트맵을 플레이하셔야 합니다.',
            ],
        ],
    ],

    'entry' => [
        '_' => '참가',
        'login_required' => '콘테스트에 참가하려면 로그인해주세요.',
        'silenced_or_restricted' => '침묵, 제한 상태에서는 콘테스트에 참가할 수 없습니다.',
        'preparation' => '현재 콘테스트가 준비중에 있습니다. 인내심을 갖고 조금만 더 기다려주세요!',
        'drop_here' => '참가할 작품을 이곳에 끌어넣어주세요.',
        'download' => '.osz 파일 다운로드',

        'wrong_type' => [
            'art' => '이 콘테스트에서는 .jpg 파일과 .png 파일만 등록할 수 있습니다.',
            'beatmap' => '이 콘테스트에서는 .osu 파일만 등록할 수 있습니다.',
            'music' => '이 콘테스트에서는 .mp3 파일만 등록할 수 있습니다.',
        ],

        'wrong_dimensions' => '이 콘테스트의 출품작은 반드시 :widthx:height 여야 합니다.',
        'too_big' => '이 콘테스트의 최대 참가 가능한 작품 수는 :limit개 입니다.',
    ],

    'beatmaps' => [
        'download' => '참가작 다운로드',
    ],

    'vote' => [
        'list' => '투표',
        'count' => ':count표',
        'points' => ':count포인트',
        'points_float' => ':points 점',
    ],

    'dates' => [
        'ended' => ':date에 끝났습니다',
        'ended_no_date' => '종료됨',

        'starts' => [
            '_' => ':date에 시작합니다',
            'soon' => '곧...™',
        ],
    ],

    'states' => [
        'entry' => '참가 작품 모집중',
        'voting' => '투표 시작됨',
        'results' => '결과 발표됨',
    ],

    'show' => [
        'admin' => [
            'page' => '정보 및 항목 보기',
        ],
    ],
];
