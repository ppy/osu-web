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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => '재생성',
            'regenerating' => '재생성 중...',
            'remove' => '제거',
            'removing' => '제거 중...',
            'title' => '비트맵셋 커버',
        ],
        'show' => [
            'covers' => '비트맵셋 표지 관리',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => '활성화 하기',
                'activate_confirm' => '이 비트맵에 modding v2을 활성화할까요?',
                'active' => '활성',
                'inactive' => '비활성',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => '삭제',

                'forum-name' => '포럼 #:id: :name',

                'no-cover' => '설정된 표지가 없습니다.',

                'submit' => [
                    'save' => '저장',
                    'update' => '수정',
                ],

                'title' => '포럼 표지 목록',

                'type-title' => [
                    'default-topic' => '기본 주제 표지',
                    'main' => '포럼 표지',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => '로그 뷰어',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => '비트맵셋',
                'forum' => '포럼',
                'general' => '일반',
                'store' => '상점',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => '주문 목록',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => '이 사용자 계정은 현재 제한된 상태입니다.',
            'message' => '(관리자만 이 메시지를 볼 수 있습니다)',
        ],
    ],

];
