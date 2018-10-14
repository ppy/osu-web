<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'pinned_topics' => '고정된 주제',
    'slogan' => "혼자서 놀기엔 너무 위험하지요.",
    'subforums' => '서브포럼',
    'title' => 'osu! 포럼',

    'covers' => [
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

    'email' => [
        'new_reply' => '[osu!] ":title"주제에 대한 새로운 답변이 달렸습니다',
    ],

    'forums' => [
        'topics' => [
            'empty' => '주제글이 아무것도 없습니다!',
        ],
    ],

    'post' => [
        'confirm_destroy' => '정말 이 글을 삭제할까요?',
        'confirm_restore' => '정말 이 글을 복원할까요?',
        'edited' => '마지막으로 :user님이 :when에 수정하여 총 :count회 수정되었습니다.',
        'posted_at' => ':when에 게시됨',

        'actions' => [
            'destroy' => '삭제',
            'restore' => '복원',
            'edit' => '수정',
        ],
    ],

    'search' => [
        'go_to_post' => '게시글로 이동',
        'post_number_input' => '글 번호를 입력하세요',
        'total_posts' => '총 :posts_count개의 글',
    ],

    'topic' => [
        'deleted' => '삭제된 주제',
        'go_to_latest' => '최근에 올라온 글 보기',
        'latest_post' => ':when by :user',
        'latest_reply_by' => ':user님이 마지막 답변 작성',
        'new_topic' => '새 주제글 작성',
        'new_topic_login' => '새로운 글을 게시하려면 로그인해주세요.',
        'post_reply' => '게시하기',
        'reply_box_placeholder' => '답글 내용을 입력하세요.',
        'reply_title_prefix' => '답글',
        'started_by' => 'by :user',
        'started_by_verbose' => ':user 님이 시작함',

        'create' => [
            'preview' => '미리보기',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => '작성',
            'submit' => '게시하기',

            'necropost' => [
                'default' => '이 주제는 조금 오래된 글입니다. 정말 그래야 할 사유가 있는 경우에만 작성해 주세요.',

                'new_topic' => [
                    '_' => "이 주제는 조금 오래된 글입니다. 정말 여기에 작성해야 할 사유가 없다면, :create해 주세요.",
                    'create' => '새로운 주제를 생성',
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
            'next' => '다음 10개 글 표시',
            'previous' => '이전 10개 글 표시',
        ],

        'post_edit' => [
            'cancel' => '취소',
            'post' => '저장',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => '구독한 주제글',
            'title_compact' => '구독',
            'title_main' => '포럼 <strong>구독</strong>',

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
                'confirmation' => '이 주제를 구독 해제하시겠습니까?',
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

            'create_poll_button' => [
                'add' => '투표 만들기',
                'remove' => '투표 생성 취소',
            ],

            'poll' => [
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
            'views' => '조회수',
            'replies' => '답글',
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
            'to_0_done' => '해당 주제의 잠금이 해제되었습니다,',
            'to_1' => '주제글 잠그기',
            'to_1_done' => '해당 주제가 잠겼습니다.',
        ],

        'moderate_move' => [
            'title' => '다른 포럼으로 이동',
        ],

        'moderate_pin' => [
            'to_0' => '주제글 고정 해제',
            'to_0_done' => '해당 주제의 고정이 해제되었습니다.',
            'to_1' => '주제글 고정',
            'to_1_done' => '해당 주제가 고정되었습니다.',
            'to_2' => '주제글을 고정하고 알림글로 나타내기',
            'to_2_done' => '해당 주제가 고정되고 알림글로 표시됩니다.',
        ],

        'show' => [
            'deleted-posts' => '삭제된 게시글',
            'total_posts' => '총 게시글',

            'feature_vote' => [
                'current' => '현재 우선도: +:count',
                'do' => '이 요청 옹호',

                'user' => [
                    'count' => '{0} 표 없음|{1,*} :count 표',
                    'current' => '투표 횟수가 :votes회 남았습니다.',
                    'not_enough' => "투표 횟수를 모두 사용하여 더이상 투표할 수 없습니다.",
                ],
            ],

            'poll' => [
                'vote' => '투표',

                'detail' => [
                    'end_time' => '투표가 :time에 종료됩니다.',
                    'ended' => '투표가 :time에 종료되었습니다.',
                    'total' => '총 투표 수: :count회',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '즐겨찾기 등록 안됨',
            'to_watching' => '즐겨찾기',
            'to_watching_mail' => '알림과 함께 즐겨찾기',
            'mail_disable' => '알림 사용 안 함',
        ],
    ],
];
