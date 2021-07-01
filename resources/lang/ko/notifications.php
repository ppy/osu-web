<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => '모든 알림을 읽었어요!',
    'delete' => ':type 삭제',
    'loading' => '읽지 않은 알림 불러오는 중...',
    'mark_read' => ':type 비우기',
    'none' => '알림 없음',
    'see_all' => '모든 알림 보기',
    'see_channel' => '채팅으로 이동',
    'verifying' => '알림을 보려면 세션을 검증해주세요.',

    'filters' => [
        '_' => '전체',
        'user' => '프로필',
        'beatmapset' => '비트맵',
        'forum_topic' => '포럼',
        'news_post' => '소식',
        'build' => '빌드 버전',
        'channel' => '채팅',
    ],

    'item' => [
        'beatmapset' => [
            '_' => '비트맵',

            'beatmap_owner_change' => [
                '_' => '게스트 난이도',
                'beatmap_owner_change' => '당신은 이제 비트맵 ":title"에 대한 ":beatmap" 난이도의 주인이 되었습니다.',
                'beatmap_owner_change_compact' => '당신은 이제 ":beatmap" 난이도의 주인이 되었습니다.',
            ],

            'beatmapset_discussion' => [
                '_' => '비트맵 토론',
                'beatmapset_discussion_lock' => '비트맵 ":title"의 토론이 잠겼습니다.',
                'beatmapset_discussion_lock_compact' => '토론이 잠겼습니다.',
                'beatmapset_discussion_post_new' => ':username 님이 ":title" 의 비트맵 토론에 새로운 메시지를 게시했습니다. ":content"',
                'beatmapset_discussion_post_new_empty' => ':username 님이 ":title" 에 새 게시글을 작성하셨습니다.',
                'beatmapset_discussion_post_new_compact' => ':username 님의 새로운 게시글 ":content"',
                'beatmapset_discussion_post_new_compact_empty' => ':username 님의 새로운 게시글',
                'beatmapset_discussion_review_new' => ':username 님의 ":title" 에 대한 리뷰에 문제가 제시되어 있습니다. 문제: :problems, 제안: :suggestions, 칭찬: :praises',
                'beatmapset_discussion_review_new_compact' => ':username 님의 리뷰에 문제가 제시되어 있습니다. 문제: :problems, 제안: :suggestions, 칭찬: :praises',
                'beatmapset_discussion_unlock' => '비트맵 ":title"의 토론이 잠금 해제되었습니다.',
                'beatmapset_discussion_unlock_compact' => '토론이 잠금 해제되었습니다.',
            ],

            'beatmapset_problem' => [
                '_' => 'Qualified 비트맵 문제',
                'beatmapset_discussion_qualified_problem' => '":title": ":content"에서 :username 이(가) 보고함',
                'beatmapset_discussion_qualified_problem_empty' => '":title"에서 :username 이(가) 보고함',
                'beatmapset_discussion_qualified_problem_compact' => '":content"에서 :username 이(가) 보고함',
                'beatmapset_discussion_qualified_problem_compact_empty' => ':username 이(가) 보고함',
            ],

            'beatmapset_state' => [
                '_' => '비트맵 상태 변경됨.',
                'beatmapset_disqualify' => '비트맵 ":title" 이(가) disqualified 처리되었습니다.',
                'beatmapset_disqualify_compact' => '비트맵이 disqualified 처리 되었습니다.',
                'beatmapset_love' => '":title" 이(가) loved 상태로 승격되었습니다.',
                'beatmapset_love_compact' => '비트맵이 loved 상태로 승격되었습니다.',
                'beatmapset_nominate' => '":title" 이(가) 추천되었습니다.',
                'beatmapset_nominate_compact' => '비트맵이 추천되었습니다.',
                'beatmapset_qualify' => '":title" 이(가) 충분한 추천을 받았으므로 랭크맵 대기열에 등록되었습니다.',
                'beatmapset_qualify_compact' => '비트맵이 랭크맵 대기열에 등록되었습니다.',
                'beatmapset_rank' => '":title" 이(가) ranked 상태가 되었습니다.',
                'beatmapset_rank_compact' => '비트맵이 ranked 상태가 되었습니다.',
                'beatmapset_remove_from_loved' => '":title" 이(가) loved 상태에서 제거되었습니다.',
                'beatmapset_remove_from_loved_compact' => '비트맵이 Loved 상태에서 제거되었습니다.',
                'beatmapset_reset_nominations' => '비트맵 ":title"의 추천이 초기화되었습니다.',
                'beatmapset_reset_nominations_compact' => '추천이 초기화되었습니다.',
            ],

            'comment' => [
                '_' => '새 댓글',

                'comment_new' => ':username님이 ":title"에 ":content"라고 댓글을 다셨습니다.',
                'comment_new_compact' => ':username님이 ":content"라고 댓글을 다셨습니다.',
                'comment_reply' => '":title" 에 달린 :username 님의 답글: ":content"',
                'comment_reply_compact' => ':username 님의 답글: ":content"',
            ],
        ],

        'channel' => [
            '_' => '채팅',

            'channel' => [
                '_' => '새 메시지',
                'pm' => [
                    'channel_message' => ':username 님이 ":title" 라고 하셨습니다.',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => ':username 님으로 부터',
                ],
            ],
        ],

        'build' => [
            '_' => '변경 사항',

            'comment' => [
                '_' => '새 댓글',

                'comment_new' => ':username 님이 ":title" 에 ":content" 를 다셨습니다.',
                'comment_new_compact' => ':username님이 ":content"라고 댓글을 다셨습니다.',
                'comment_reply' => '":title" 에 달린 :username 님의 답글: ":content"',
                'comment_reply_compact' => ':username 님의 답글: ":content"',
            ],
        ],

        'news_post' => [
            '_' => '소식',

            'comment' => [
                '_' => '새 댓글',

                'comment_new' => ':username님이 ":title"에 ":content"라고 댓글을 다셨습니다.',
                'comment_new_compact' => ':username님이 ":content"라고 댓글을 다셨습니다.',
                'comment_reply' => '":title" 에 달린 :username 님의 답글: ":content"',
                'comment_reply_compact' => ':username 님의 답글: ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => '포럼 주제',

            'forum_topic_reply' => [
                '_' => '새로운 포럼 답글',
                'forum_topic_reply' => ':username님이 포럼 주제 ":title"에 답글을 달았습니다.',
                'forum_topic_reply_compact' => ':username 님이 답글을 달았습니다.',
            ],
        ],

        'legacy_pm' => [
            '_' => '이전 포럼 PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited개의 미확인 메시지',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => '새 비트맵',

                'user_beatmapset_new' => ':username 님의 새로운 비트맵 ":title"',
                'user_beatmapset_new_compact' => '새 비트맵 ":title"',
                'user_beatmapset_new_group' => ':username 님의 새 비트맵',
            ],
        ],

        'user_achievement' => [
            '_' => '메달',

            'user_achievement_unlock' => [
                '_' => '새 메달',
                'user_achievement_unlock' => '":title" 해제!',
                'user_achievement_unlock_compact' => '":title" 달성!',
                'user_achievement_unlock_group' => '메달 언락함!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '당신은 이제 비트맵 ":title"의 게스트가 되었습니다.',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '토론 ":title" 의 토론이 잠겼습니다.',
                'beatmapset_discussion_post_new' => '토론 ":title" 에 새로운 업데이트가 있습니다.',
                'beatmapset_discussion_unlock' => '토론 ":title" 의 토론이 잠금 해제되었습니다.',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '":title" 에 새로운 문제가 제의되었습니다.',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" 이(가) disqualified 처리되었습니다.',
                'beatmapset_love' => '":title" 이(가) loved 상태로 승격되었습니다.',
                'beatmapset_nominate' => '":title" 이(가) 추천되었습니다.',
                'beatmapset_qualify' => '":title" 이(가) 충분한 추천을 받아 랭킹 대기열에 등록되었습니다.',
                'beatmapset_rank' => '":title" 이(가) ranked 상태가 되었습니다.',
                'beatmapset_remove_from_loved' => '":title" 이(가) loved 상태에서 제거되었습니다.',
                'beatmapset_reset_nominations' => '비트맵 ":title"의 추천이 초기화되었습니다.',
            ],

            'comment' => [
                'comment_new' => '비트맵 ":title" 에 새로운 댓글이 달렸습니다.',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => ':username 님에게 새로운 메시지를 받았습니다.',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '변경 사항 ":title" 에 새로운 댓글이 달렸습니다.',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => '뉴스 ":title" 에 새로운 댓글이 달렸습니다.',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '":title" 에 새로운 답글이 달렸습니다.',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username 님이 ":title" 메달을 획득하셨습니다!',
                'user_achievement_unlock_self' => '":title" 메달을 획득하셨습니다!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username 님이 새 비트맵을 제작했습니다',
            ],
        ],
    ],
];
