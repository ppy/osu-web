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
    'pinned_topics' => '고정된 주제',
    'slogan' => '혼자서 놀기엔 너무 위험하지요.',
    'subforums' => '서브포럼',
    'title' => 'osu!커뮤니티',

    'covers' => [
        'create' => [
            '_' => '표지 이미지 설정',
            'button' => '이미지 업로드',
            'info' => '표지 이미지의 크기는 :dimensions여야 합니다. 이미지를 이 곳에 끌어넣어 업로드할 수도 있습니다.',
        ],

        'destroy' => [
            '_' => '표지 이미지 제거',
            'confirm' => '정말 표지 이미지를 제거하실 건가요?',
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
        'edited' => '마지막으로 :user님이 :when에 수정하여, 총 :count회 수정되었습니다.',
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
        'total_posts' => '총 :posts_count개 글 발견',
    ],

    'topic' => [
        'go_to_latest' => '최근에 올라온 글 보기',
        'latest_post' => ':when by :user',
        'latest_reply_by' => 'latest reply by :user',
        'new_topic' => '새 주제글 작성',
        'post_reply' => '게시하기',
        'reply_box_placeholder' => '답글 내용을 입력하세요.',
        'started_by' => ':user님이 작성함',

        'create' => [
            'preview' => '미리보기',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => '계속 쓰기',
            'submit' => '게시하기',

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
            'zoom' => [
                'start' => '전체 화면',
                'end' => '전체 화면 나가기',
            ],
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => '구독한 주제글',
            'title_compact' => '구독',
            'title_main' => '<strong>구독</strong>한 주제글',

            'box' => [
                'total' => 'Topics subscribed',
                'unread' => 'Topics with new replies',
            ],
            'info' => [
                'total' => 'You subscribed to :total topics.',
                'unread' => 'You have :unread unread replies to subscribed topics.',
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
            'reply_with_quote' => '이 글을 답글에 인용하기',
            'search' => '검색',
        ],

        'create' => [
            'create_poll' => '여론 투표 생성',

            'create_poll_button' => [
                'add' => '투표 만들기',
                'remove' => '투표 생성 ',
            ],

            'poll' => [
                'length' => '여론 투표를',
                'length_days_prefix' => '',
                'length_days_suffix' => '일 동안 진행',
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
            'action-0' => '"added" 태그 삭제',
            'action-1' => '"added" 태그 추가',
            'state-0' => '"added" 태그 삭제됨',
            'state-1' => '"added" 태그 추가됨',
        ],

        'issue_tag_assigned' => [
            'action-0' => '"assigned" 태그 삭제',
            'action-1' => '"assigned" 태그 추가',
            'state-0' => '"assigned" 태그 삭제됨',
            'state-1' => '"assigned" 태그 추가됨',
        ],

        'issue_tag_confirmed' => [
            'action-0' => '"confirmed" 태그 삭제',
            'action-1' => '"confirmed" 태그 추가',
            'state-0' => '"confirmed" 태그 삭제됨',
            'state-1' => '"confirmed" 태그 추가됨',
        ],

        'issue_tag_duplicate' => [
            'action-0' => '"duplicate" 태그 삭제',
            'action-1' => '"duplicate" 태그 추가',
            'state-0' => '"duplicate" 태그 삭제됨',
            'state-1' => '"duplicate" 태그 추가됨',
        ],

        'issue_tag_invalid' => [
            'action-0' => '"invalid" 태그 삭제',
            'action-1' => '"invalid" 태그 추가',
            'state-0' => '"invalid" 태그 삭제됨',
            'state-1' => '"invalid" 태그 추가됨',
        ],

        'issue_tag_resolved' => [
            'action-0' => '"resolved" 태그 삭제',
            'action-1' => '"resolved" 태그 추가',
            'state-0' => '"resolved" 태그 삭제됨',
            'state-1' => '"resolved" 태그 추가됨',
        ],

        'lock' => [
            'is_locked' => '주제글이 잠겨있어 답글을 게시할 수 없습니다.',
            'lock-0' => '주제글 잠금 풀기',
            'lock-1' => '주제글 잠그기',
            'state-0' => '해당 주제의 잠금이 해제되었습니다,',
            'state-1' => '해당 주제가 잠겼습니다.',
        ],

        'moderate_move' => [
            'title' => '다른 포럼으로 이동',
        ],

        'moderate_pin' => [
            'pin-0' => '주제글 고정 해제',
            'pin-1' => '주제글 고정',
            'pin-2' => '주제글을 고정하고 알림글로 나타내기',
            'state-0' => '해당 주제의 고정이 해제되었습니다.',
            'state-1' => '해당 주제가 고정되었습니다.',
            'state-2' => '해당 주제가 고정되고 알림글로 표시됩니다.',
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
                    'not_enough' => '투표를 모두 사용하여 더이상 투표할 수 없습니다.',
                ],
            ],

            'poll' => [
                'vote' => '투표',

                'detail' => [
                    'end_time' => '여론 투표가 :time에 종료됩니다.',
                    'ended' => '여론 투표가 :time에 종료되었습니다.',
                    'total' => '총 투표 수: :count회',
                ],
            ],
        ],

        'watch' => [
            'state-0' => 'Unsubscribed from topic',
            'state-1' => 'Subscribed to topic',
            'watch-0' => '주제 구독 해제하기',
            'watch-1' => '주제 ',
        ],
    ],
];
