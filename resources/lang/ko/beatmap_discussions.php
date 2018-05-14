<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'system_generated' => '시스템에서 자동으로 만든 답글은 수정할 수 없습니다.',
            'wrong_user' => '답글을 쓴 사람만 수정할 수 있습니다.',
        ],
    ],

    'events' => [
        'empty' => 'Nothing has happened... yet.',
    ],

    'index' => [
        'deleted_beatmap' => 'deleted',
        'title' => 'Beatmap Discussions',

        'form' => [
            'deleted' => 'Include deleted discussions',

            'user' => [
                'label' => 'User',
                'overview' => 'Activities overview',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Post date',
        'deleted_at' => 'Deletion date',
        'message_type' => 'Type',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => '새로 달린 답글이 없습니다',
        'notice' => ':timestamp (:existing_timestamps)에 달린 답글이 있습니다. 포스팅하기 전에 한 번 확인해보세요.',
    ],

    'reply' => [
        'open' => [
            'guest' => '답글을 달려면 로그인하세요',
            'user' => '답글달기',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user님이 토론 결과를 결정했습니다',
            'false' => ':user님이 토론을 재개했습니다',
        ],
    ],

    'user' => [
        'admin' => '관리자',
        'bng' => '노미네이터',
        'owner' => '매퍼',
        'qat' => 'QAT',
    ],

    'user_filter' => [
        'everyone' => 'Everyone',
        'label' => 'Filter by user',
    ],
];
