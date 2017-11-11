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
    'beatmap_discussion' => [
        'destroy' => [
            'has_reply' => '답글이 달린 토론은 삭제할 수 없습니다',
        ],
        'nominate' => [
            'exhausted' => '오늘은 더이상 추천할 수 없습니다, 내일 다시 시도해주세요.',
        ],
        'resolve' => [
            'not_owner' => '게시글 작성자 또는 비트맵 제작자만 토론을 가결할 수 있습니다.',
        ],

        'vote' => [
            'limit_exceeded' => '투표를 더 받을 때 까지 좀 더 기다려주세요',
            'owner' => '본인이 제시한 토론에는 투표할 수 없습니다!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => '자동으로 생성된 답글은 수정할 수 없습니다.',
            'not_owner' => '본인이 쓴 답글만 수정할 수 있습니다.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => '요청하신 채널로의 입장이 허용되지 않았습니다.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => '대상 채널에 접근하기 위한 권한이 필요합니다.',
                    'moderated' => '현재 채널에 사회자가 있습니다.',
                    'not_lazer' => '현재 #lazer 채널을 통해서만 말할 수 있습니다.',
                ],

                'not_allowed' => '차단/제한/침묵 상태에서는 메세지를 보낼 수 없습니다.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => '투표 기간 이후에는 콘테스트가 끝날 때 까지 선택한 투표를 바꿀 수 없습니다.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => '마지막 답글만 삭제할 수 있습니다.',
                'locked' => '잠긴 주제에 달린 답글은 삭제할 수 없습니다.',
                'no_forum_access' => '요청하신 포럼에의 접근 권한이 필요합니다.',
                'not_owner' => '본인이 쓴 답글만 삭제할 수 있습니다.',
            ],

            'edit' => [
                'deleted' => '삭제된 답글은 수정할 수 없습니다.',
                'locked' => '이 답글은 잠겨있어 수정할 수 없습니다.',
                'no_forum_access' => '요청하신 포럼에의 접근 권한이 필요합니다.',
                'not_owner' => '본인이 쓴 답글만 수정할 수 있습니다.',
                'topic_locked' => '잠긴 주제에 달린 답글은 수정할 수 없습니다.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '답글을 올린 지 얼마 되지 않았습니다. 잠시 기다려주시거나, 마지막에 올린 글을 수정하세요.',
                'locked' => '게시글이 잠겨있어 답변할 수 없습니다.',
                'no_forum_access' => '요청하신 포럼에의 접근 권한이 필요합니다.',
                'no_permission' => '답변할 권한이 없습니다.',

                'user' => [
                    'require_login' => '답글을 게시하려면 로그인해 주세요.',
                    'restricted' => '제한된 상태의 계정은 답글을 게시할 수 없습니다.',
                    'silenced' => '침묵 상태의 계정은 답글을 게시할 수 없습니다.',
                ],
            ],

            'store' => [
                'no_forum_access' => '요청하신 포럼에의 접근 권한이 필요합니다.',
                'no_permission' => '새 주제글을 게시할 권한이 없습니다.',
                'forum_closed' => '포럼이 닫혀있어 현재 포럼에 글을 올릴 수 없습니다.',
            ],

            'vote' => [
                'no_forum_access' => '요청하신 포럼에의 접근 권한이 필요합니다.',
                'over' => '투표가 종료되어 더이상 투표할 수 없습니다.',
                'voted' => '투표 변경이 허용되지 않았습니다.',

                'user' => [
                    'require_login' => '투표하려면 로그인해 주세요.',
                    'restricted' => '제한된 상태의 계정은 투표할 수 없습니다.',
                    'silenced' => '침묵 상태의 계정은 투표할 수 없습니다.',
                ],
            ],

            'watch' => [
                'no_forum_access' => '요청하신 포럼에의 접근 권한이 필요합니다.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '유효하지 않은 표지가 명시되었습니다.',
                'not_owner' => '주제글을 올린 사람만 표지를 수정할 수 있습니다.',
            ],
        ],

        'view' => [
            'admin_only' => '관리자만 열람이 가능한 포럼입니다.',
        ],
    ],

    'require_login' => '계속하려면 로그인해 주세요.',

    'unauthorized' => '접근이 제한되었습니다.',

    'silenced' => '침묵 상태에서는 할 수 없습니다.',

    'restricted' => '제한된 상태에서는 할 수 없습니다.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '유저 페이지가 잠겨있습니다.',
                'not_owner' => '본인의 사용자 페이지만 수정할 수 있습니다.',
                'require_supporter_tag' => '서포터 권한이 필요합니다.',
            ],
        ],
    ],
];
