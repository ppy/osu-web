<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => '로그인하셔야 수정하실 수 있습니다.',
            'system_generated' => '시스템이 작성한 글은 수정할 수 없습니다.',
            'wrong_user' => '답글을 쓴 사람만 수정할 수 있습니다.',
        ],
    ],

    'events' => [
        'empty' => '아무 일도 일어나지 않았네요... 아직은요.',
    ],

    'index' => [
        'deleted_beatmap' => '삭제됨',
        'none_found' => '해당 검색 기준과 일치하는 토론을 찾을 수 없습니다.',
        'title' => '비트맵 토론',

        'form' => [
            '_' => '검색',
            'deleted' => '삭제된 토론 포함',
            'mode' => '',
            'only_unresolved' => '미해결 토론만 보기',
            'types' => '메시지 종류',
            'username' => '사용자 이름',

            'beatmapset_status' => [
                '_' => '비트맵 상태',
                'all' => '전체',
                'disqualified' => 'Disqualified',
                'never_qualified' => 'Qualified 된 적 없음',
                'qualified' => 'Qualified',
                'ranked' => 'Ranked',
            ],

            'user' => [
                'label' => '사용자',
                'overview' => '활동 개요',
            ],
        ],
    ],

    'item' => [
        'created_at' => '게시일',
        'deleted_at' => '삭제일',
        'message_type' => '종류',
        'permalink' => '고유 주소',
    ],

    'nearby_posts' => [
        'confirm' => '지금 작성하는 토론과 연관된 토론이 없습니다',
        'notice' => ':timestamp (:existing_timestamps)주위에 달린 답글이 있습니다. 포스팅하기 전에 한 번 확인해보세요.',
        'unsaved' => '이 리뷰에서 :count개',
    ],

    'reply' => [
        'open' => [
            'guest' => '답글을 달려면 로그인하세요',
            'user' => '답글 달기',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max 블록 사용됨',
        'go_to_parent' => '평가 글 보기',
        'go_to_child' => '토론 글 보기',
        'validation' => [
            'block_too_large' => '각 문단은 최대 :limit자까지 입력할 수 있습니다.',
            'external_references' => '이 리뷰는 관련 없는 이슈 참조를 포함하고 있습니다.',
            'invalid_block_type' => '잘못된 블록 종류',
            'invalid_document' => '잘못된 리뷰',
            'minimum_issues' => '리뷰는 최소한 :count개의 이슈를 포함해야 합니다',
            'missing_text' => '블록이 텍스트를 포함하고 있지 않음',
            'too_many_blocks' => '리뷰는 최대 :count개의 문단 및 이슈를 포함할 수 있습니다.',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user 님이 해결함으로 표시함.',
            'false' => ':user님이 토론을 재개했습니다',
        ],
    ],

    'timestamp_display' => [
        'general' => '일반',
        'general_all' => '일반 (전체)',
    ],

    'user_filter' => [
        'everyone' => '모두',
        'label' => '사용자순 필터링',
    ],
];
