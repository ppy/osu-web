<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => '고정된 주제',
    'slogan' => "혼자서 놀기엔 너무 위험하지요.",
    'subforums' => '서브포럼',
    'title' => 'osu! 포럼',

    'covers' => [
        'edit' => '커버 수정',

        'create' => [
            '_' => '표지 이미지 설정',
            'button' => '이미지 업로드',
            'info' => '표지 이미지의 해상도는 최대 :dimensions입니다. 이미지를 이 곳에 끌어넣어 업로드할 수도 있습니다.',
        ],

        'destroy' => [
            '_' => '표지 이미지 삭제',
            'confirm' => '정말 표지 이미지를 삭제하실 건가요?',
        ],
    ],

    'forums' => [
        'latest_post' => '최근 게시글',

        'index' => [
            'title' => '포럼 목차',
        ],

        'topics' => [
            'empty' => '주제글이 아무것도 없습니다!',
        ],
    ],

    'mark_as_read' => [
        'forum' => '포럼을 읽음으로 표시',
        'forums' => '포럼을 읽음으로 표시',
        'busy' => '읽음으로 표시하는 중...',
    ],

    'post' => [
        'confirm_destroy' => '정말 이 글을 삭제할까요?',
        'confirm_restore' => '정말 이 글을 복원할까요?',
        'edited' => ':user 님이 마지막으로 :when에 수정하여 총 :count_delimited회 수정되었습니다.',
        'posted_at' => ':when에 게시됨',
        'posted_by' => ':username 님이 게시함',

        'actions' => [
            'destroy' => '삭제',
            'edit' => '수정',
            'report' => '게시글 신고',
            'restore' => '복원',
        ],

        'create' => [
            'title' => [
                'reply' => '새 답글 작성',
            ],
        ],

        'info' => [
            'post_count' => '게시글 :count_delimited개',
            'topic_starter' => '주제 시작인',
        ],
    ],

    'search' => [
        'go_to_post' => '게시글로 이동',
        'post_number_input' => '글 번호를 입력하세요',
        'total_posts' => '총 :posts_count개의 글',
    ],

    'topic' => [
        'confirm_destroy' => '정말 이 주제를 삭제할까요?',
        'confirm_restore' => '정말 이 주제를 복원할까요?',
        'deleted' => '삭제된 주제',
        'go_to_latest' => '최근에 올라온 글 보기',
        'has_replied' => '이 주제에 답글을 달았습니다.',
        'in_forum' => ':forum 에서',
        'latest_post' => ':when by :user',
        'latest_reply_by' => ':user님이 마지막 답변 작성',
        'new_topic' => '새 주제글 작성',
        'new_topic_login' => '새로운 글을 게시하려면 로그인해주세요.',
        'post_reply' => '게시하기',
        'reply_box_placeholder' => '답글 내용을 입력하세요.',
        'reply_title_prefix' => '답글',
        'started_by' => 'by :user',
        'started_by_verbose' => ':user 님이 시작함',

        'actions' => [
            'destroy' => '주제 삭제',
            'restore' => '주제 복원',
        ],

        'create' => [
            'close' => '닫기',
            'preview' => '미리보기',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => '작성',
            'submit' => '게시하기',

            'necropost' => [
                'default' => '이 주제는 오래된 글입니다. 마땅한 사유가 있는 경우에만 작성해 주세요.',

                'new_topic' => [
                    '_' => "이 주제는 오래된 글입니다. 마땅한 사유가 있는 경우에만 :create해 주세요.",
                    'create' => '새로운 주제글을 작성',
                ],
            ],

            'placeholder' => [
                'body' => '글 내용을 입력하세요.',
                'title' => '이곳을 눌러 제목을 정하세요',
            ],
        ],

        'jump' => [
            'enter' => '특정 글로 이동하려면 클릭하세요',
            'first' => '처음 글로 이동하기',
            'last' => '마지막 글로 이동하기',
            'next' => '10개 글 건너뛰기',
            'previous' => '10개 글 이전으로',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => '취소',
            'post' => '저장',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => '구독',

            'box' => [
                'total' => '구독한 주제글',
                'unread' => '새로운 답변이 있는 주제글',
            ],

            'info' => [
                'total' => '총 :total개의 주제글을 구독했습니다.',
                'unread' => '구독한 주제글에 :unread개의 읽지 않은 답변이 있습니다.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '이 주제를 구독 해제하시겠어요?',
                'title' => '구독 해제',
            ],
        ],
    ],

    'topics' => [
        '_' => '주제',

        'actions' => [
            'login_reply' => '답변하려면 로그인하세요',
            'reply' => '답변',
            'reply_with_quote' => '이 글을 답글에 인용하기',
            'search' => '검색',
        ],

        'create' => [
            'create_poll' => '투표 만들기',

            'preview' => '글 미리보기',

            'create_poll_button' => [
                'add' => '투표 만들기',
                'remove' => '투표 생성 취소',
            ],

            'poll' => [
                'hide_results' => '투표의 결과를 숨깁니다.',
                'hide_results_info' => '투표가 끝났을 때만 보입니다.',
                'length' => '투표 진행 기간',
                'length_days_suffix' => '일',
                'length_info' => '투표를 영구적으로 진행하려면 공백으로 두세요.',
                'max_options' => '투표가능 항목 수',
                'max_options_info' => '중복으로 선택 가능한 항목 수를 나타냅니다.',
                'options' => '투표 항목',
                'options_info' => '항목으로 쓰일 내용을 적어주세요. 각 행마다 항목을 구분하며, 10개 까지 입력 가능합니다.',
                'title' => '투표 제목',
                'vote_change' => '재투표 허용.',
                'vote_change_info' => '허용하면, 본인이 투표한 내용을 바꿀 수 있습니다.',
            ],
        ],

        'edit_title' => [
            'start' => '제목 수정',
        ],

        'index' => [
            'feature_votes' => '별 평점 순위',
            'replies' => '답글',
            'views' => '조회수',
        ],

        'issue_tag_added' => [
            'to_0' => '"added" 태그 삭제',
            'to_0_done' => '"added" 태그 삭제됨',
            'to_1' => '"added" 태그 추가',
            'to_1_done' => '"added" 태그 추가됨',
        ],

        'issue_tag_assigned' => [
            'to_0' => '"assigned" 태그 삭제',
            'to_0_done' => '"assigned" 태그 삭제됨',
            'to_1' => '"assigned" 태그 추가',
            'to_1_done' => '"assigned" 태그 추가됨',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '"confirmed" 태그 삭제',
            'to_0_done' => '"confirmed" 태그 삭제됨',
            'to_1' => '"confirmed" 태그 추가',
            'to_1_done' => '"confirmed" 태그 추가됨',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '"duplicate" 태그 삭제',
            'to_0_done' => '"duplicate" 태그 삭제됨',
            'to_1' => '"duplicate" 태그 추가',
            'to_1_done' => '"duplicate" 태그 추가됨',
        ],

        'issue_tag_invalid' => [
            'to_0' => '"invalid" 태그 삭제',
            'to_0_done' => '"invalid" 태그 삭제됨',
            'to_1' => '"invalid" 태그 추가',
            'to_1_done' => '"invalid" 태그 추가됨',
        ],

        'issue_tag_resolved' => [
            'to_0' => '"resolved" 태그 삭제',
            'to_0_done' => '"resolved" 태그 삭제됨',
            'to_1' => '"resolved" 태그 추가',
            'to_1_done' => '"resolved" 태그 추가됨',
        ],

        'lock' => [
            'is_locked' => '주제글이 잠겨있어 답글을 달 수 없습니다.',
            'to_0' => '주제글 잠금 풀기',
            'to_0_confirm' => '주제를 잠금 해제할까요?',
            'to_0_done' => '해당 주제의 잠금이 해제되었습니다,',
            'to_1' => '주제글 잠그기',
            'to_1_confirm' => '이 주제를 잠글까요?',
            'to_1_done' => '해당 주제가 잠겼습니다.',
        ],

        'moderate_move' => [
            'title' => '다른 포럼으로 이동',
        ],

        'moderate_pin' => [
            'to_0' => '주제글 고정 해제',
            'to_0_confirm' => '이 주제를 고정 해제할까요?',
            'to_0_done' => '해당 주제의 고정이 해제되었습니다.',
            'to_1' => '주제글 고정',
            'to_1_confirm' => '이 주제를 고정할까요?',
            'to_1_done' => '해당 주제가 고정되었습니다.',
            'to_2' => '주제글을 고정하고 알림글로 나타내기',
            'to_2_confirm' => '이 주제를 고정하고 공지 사항으로 표시할까요?',
            'to_2_done' => '해당 주제가 고정되고 알림글로 표시됩니다.',
        ],

        'moderate_toggle_deleted' => [
            'show' => '삭제된 글 표시',
            'hide' => '삭제된 글 숨기기',
        ],

        'show' => [
            'deleted-posts' => '삭제된 게시글',
            'total_posts' => '총 게시글',

            'feature_vote' => [
                'current' => '현재 우선도: +:count',
                'do' => '이 요청 옹호',

                'info' => [
                    '_' => '이곳은 :feature_request입니다. 기능 요청들의 투표는 :supporters가 할 수 있습니다.',
                    'feature_request' => '기능 요청',
                    'supporters' => '서포터',
                ],

                'user' => [
                    'count' => '{0} 표 없음|{1,*} :count 표',
                    'current' => '투표 횟수가 :votes회 남았습니다.',
                    'not_enough' => "투표 횟수를 모두 사용하여 더이상 투표할 수 없습니다.",
                ],
            ],

            'poll' => [
                'edit' => '투표 수정',
                'edit_warning' => '투표를 수정하면 현재 결과가 제거됩니다!',
                'vote' => '투표',

                'button' => [
                    'change_vote' => '추천 변경',
                    'edit' => '투표 수정',
                    'view_results' => '결과로 건너뛰기',
                    'vote' => '투표',
                ],

                'detail' => [
                    'end_time' => '투표가 :time에 종료됩니다.',
                    'ended' => '투표가 :time에 종료되었습니다.',
                    'results_hidden' => '투표가 끝난 후에 결과가 표시됩니다.',
                    'total' => '총 투표 수: :count회',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '즐겨찾기 등록 안됨',
            'to_watching' => '즐겨찾기',
            'to_watching_mail' => '알림과 함께 즐겨찾기',
            'tooltip_mail_disable' => '알림이 활성화되었습니다. 눌러서 비활성화하세요.',
            'tooltip_mail_enable' => '알림이 비활성화되었습니다. 눌러서 활성화하세요.',
        ],
    ],
];
