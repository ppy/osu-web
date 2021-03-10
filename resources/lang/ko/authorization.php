<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'osu!를 조금 더 해보시는 건 어떨까요?',
    'require_login' => '계속하려면 로그인해 주세요.',
    'require_verification' => '계속하려면 인증해 주세요.',
    'restricted' => "제한된 상태에서는 할 수 없습니다.",
    'silenced' => "침묵 상태에서는 할 수 없습니다.",
    'unauthorized' => '접근이 거부되었습니다.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hype한 것은 되돌릴 수 없습니다.',
            'has_reply' => '답글이 달린 토론은 삭제할 수 없습니다',
        ],
        'nominate' => [
            'exhausted' => '오늘은 더 이상 추천할 수 없습니다. 내일 다시 시도해주세요.',
            'incorrect_state' => '해당 작업을 수행하는 중 오류가 발생했습니다. 페이지를 새로 고쳐주세요.',
            'owner' => "자신의 비트맵을 추천할 수 없습니다.",
            'set_metadata' => '추천하려면 먼저 장르와 언어를 지정해야 합니다.',
        ],
        'resolve' => [
            'not_owner' => '게시글 작성자 또는 비트맵 제작자만 토론을 가결할 수 있습니다.',
        ],

        'store' => [
            'mapper_note_wrong_user' => '비트맵 소유자나 nominator/QAT그룹 구성원만이 mapper notes를 작성할 수 있습니다.',
        ],

        'vote' => [
            'bot' => "봇이 만든 토론에는 투표할 수 없습니다.",
            'limit_exceeded' => '투표를 더 하기 전에 조금 기다려주세요',
            'owner' => "자신이 시작한 토론에는 투표할 수 없습니다.",
            'wrong_beatmapset_state' => 'Pending인 비트맵의 토론에만 투표할 수 있습니다.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '자신의 게시글만 삭제할 수 있습니다.',
            'resolved' => '해결된 토론의 게시글은 삭제할 수 없습니다.',
            'system_generated' => '자동으로 생성된 글은 삭제할 수 없습니다.',
        ],

        'edit' => [
            'not_owner' => '본인이 쓴 글만 수정할 수 있습니다.',
            'resolved' => '해결된 토론의 게시글은 수정할 수 없습니다.',
            'system_generated' => '자동으로 생성된 글은 수정할 수 없습니다.',
        ],

        'store' => [
            'beatmapset_locked' => '이 비트맵은 토론을 할 수 없도록 잠겨 있습니다.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => '추천된 맵의 메타데이터를 변경할 순 없습니다. 잘못 지정된 것 같으면 BN이나 NAT 멤버에게 알려주세요.',
        ],
    ],

    'chat' => [
        'blocked' => '당신을 차단하였거나 당신이 차단한 유저에게 메시지를 보낼 수 없습니다.',
        'friends_only' => '해당 유저는 친구가 아닌 유저의 메시지를 차단한 상태입니다.',
        'moderated' => '채널은 현재 관리 중입니다.',
        'no_access' => '해당 채널에 대한 접근 권한이 없습니다.',
        'restricted' => '침목이나 제한, 밴이 된 상태인 동안에는 메시지를 보낼 수 없습니다.',
        'silenced' => '침묵, 제한, 차단 상태에서는 메시지를 전송할 수 없습니다.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "삭제된 게시물을 수정 할 수 없습니다.",
        ],
    ],

    'contest' => [
        'voting_over' => '투표 기간 이후에는 콘테스트가 끝날 때 까지 선택한 투표를 바꿀 수 없습니다.',

        'entry' => [
            'limit_reached' => '이 콘테스트에서 참가 가능한 작품 수를 초과했습니다.',
            'over' => '콘테스트에 참가해주셔서 감사합니다! 작품 제출이 마감되었고, 투표가 곧 시작됩니다.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => '이 포럼을 관리할 권한이 없습니다.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => '마지막 답글만 삭제할 수 있습니다.',
                'locked' => '잠긴 주제에 달린 답글은 삭제할 수 없습니다.',
                'no_forum_access' => '요청하신 포럼에 대한 접근 권한이 필요합니다.',
                'not_owner' => '본인이 쓴 답글만 삭제할 수 있습니다.',
            ],

            'edit' => [
                'deleted' => '삭제된 답글은 수정할 수 없습니다.',
                'locked' => '이 답글은 잠겨있어 수정할 수 없습니다.',
                'no_forum_access' => '요청하신 포럼에 대한 접근 권한이 필요합니다.',
                'not_owner' => '본인이 쓴 답글만 수정할 수 있습니다.',
                'topic_locked' => '잠긴 주제에 달린 답글은 수정할 수 없습니다.',
            ],

            'store' => [
                'play_more' => '포럼에 글을 올리기 전에 게임을 플레이해주세요, 제발요! 만약 플레이하는데 문제가 있다면, Help and Support 포럼에 글을 남겨주세요.',
                'too_many_help_posts' => "글을 더 남기려면 게임을 플레이해야 합니다. 만약 게임 진행에 문제가 있다면, support@ppy.sh 에 이메일을 보내주세요.", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '다시 작성하기보단 마지막으로 작성한 글을 수정 해 주세요.',
                'locked' => '게시글이 잠겨있어 답변할 수 없습니다.',
                'no_forum_access' => '요청하신 포럼에 대한 접근 권한이 필요합니다.',
                'no_permission' => '답변할 권한이 없습니다.',

                'user' => [
                    'require_login' => '답글을 게시하려면 로그인해 주세요.',
                    'restricted' => "제한된 상태의 계정은 답글을 게시할 수 없습니다.",
                    'silenced' => "침묵 상태의 계정은 답글을 게시할 수 없습니다.",
                ],
            ],

            'store' => [
                'no_forum_access' => '요청하신 포럼에 대한 접근 권한이 필요합니다.',
                'no_permission' => '새 주제글을 게시할 권한이 없습니다.',
                'forum_closed' => '포럼이 닫혀있어 현재 포럼에 글을 올릴 수 없습니다.',
            ],

            'vote' => [
                'no_forum_access' => '요청하신 포럼에 대한 접근 권한이 필요합니다.',
                'over' => '투표가 종료되어 더이상 투표할 수 없습니다.',
                'play_more' => '포럼에 투표를 하기 전에 게임을 조금 더 플레이하셔야 해요.',
                'voted' => '투표한 뒤에는 변경할 수 없습니다.',

                'user' => [
                    'require_login' => '투표하려면 로그인해 주세요.',
                    'restricted' => "제한된 상태에서는 투표할 수 없습니다.",
                    'silenced' => "침묵 상태의 계정은 투표할 수 없습니다.",
                ],
            ],

            'watch' => [
                'no_forum_access' => '요청하신 포럼에 대한 접근 권한이 필요합니다.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '유효하지 않은 표지입니다.',
                'not_owner' => '주제글을 올린 사람만 표지를 수정할 수 있습니다.',
            ],
            'store' => [
                'forum_not_allowed' => '이 포럼은 주제 커버를 허용하지 않습니다.',
            ],
        ],

        'view' => [
            'admin_only' => '관리자만 열람이 가능한 포럼입니다.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '유저 페이지가 잠겨있습니다.',
                'not_owner' => '본인의 유저 페이지만 수정할 수 있습니다.',
                'require_supporter_tag' => 'osu! 서포터 태그가 필요합니다.',
            ],
        ],
    ],
];
