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
        'title' => '비트맵 토론',

        'form' => [
            '_' => '검색',
            'deleted' => '삭제된 토론 포함',
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
    ],

    'reply' => [
        'open' => [
            'guest' => '답글을 달려면 로그인하세요',
            'user' => '답글 달기',
        ],
    ],

    'review' => [
        'go_to_parent' => '평가 글 보기',
        'go_to_child' => '토론 글 보기',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user님이 토론을 끝마쳤습니다',
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
