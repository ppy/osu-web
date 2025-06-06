<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_ruleset' => '룰셋이 올바르지 않습니다.',

    'change_owner' => [
        'too_many' => '게스트 매퍼가 너무 많아요.',
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '투표 변경 실패',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosu 허용하기',
        'beatmap_information' => '비트맵 페이지',
        'delete' => '삭제',
        'deleted' => ':delete_time에 :editor님에 의해 삭제되었습니다',
        'deny_kudosu' => 'kudosu 박탈하기',
        'edit' => '수정',
        'edited' => ':update_time에 :editor님에 의해 마지막으로 수정됨',
        'guest' => ':user의 게스트 난이도',
        'kudosu_denied' => 'kudosu 획득이 불가능합니다.',
        'message_placeholder_deleted_beatmap' => '제거된 난이도이므로 더 이상의 토론이 불가능합니다.',
        'message_placeholder_locked' => '이 비트맵에 대한 토론이 비활성화되었습니다.',
        'message_placeholder_silenced' => "침묵 상태에서는 토론 게시글을 게시할 수 없습니다.",
        'message_type_select' => '게시할 답글의 형식을 선택하세요',
        'reply_notice' => '답글을 올리려면 엔터를 누르세요.',
        'reply_resolve_notice' => '엔터를 눌러 답변하세요. ctrl+enter를 눌러 답변하고 종결지을 수 있습니다.',
        'reply_placeholder' => '보내실 답변의 내용을 입력하세요.',
        'require-login' => '글을 올리거나 답변하려면 로그인해 주세요',
        'resolved' => '해결됨',
        'restore' => '복구',
        'show_deleted' => '삭제된 내용 표시',
        'title' => '토론',
        'unresolved_count' => ':count_delimited개의 미해결 이슈',

        'collapse' => [
            'all-collapse' => '모두 축소하기',
            'all-expand' => '모두 확대하기',
        ],

        'empty' => [
            'empty' => '아직 아무런 토론이 없습니다!',
            'hidden' => '검색 결과에 해당하는 토론이 없습니다.',
        ],

        'lock' => [
            'button' => [
                'lock' => '토론 잠금',
                'unlock' => '토론 잠금 해제',
            ],

            'prompt' => [
                'lock' => '잠긴 이유',
                'unlock' => '잠금을 해제하겠습니까?',
            ],
        ],

        'message_hint' => [
            'in_general' => '작성된 글은 일반 비트맵 토론으로 올라가집니다. 이 난이도를 모딩하려면 글의 첫 부분을 타임스탬프로 시작하십시오 (예시, 00:12:345).',
            'in_timeline' => '비트맵의 여러 부분을 수정하려면 글을 여러 번 올리세요 (한 글에 한 타임스탬프만 수정할 수 있습니다).',
        ],

        'message_placeholder' => [
            'general' => '일반(:version)에 게시할 내용을 입력하세요.',
            'generalAll' => '일반(모든 난이도)에 게시할 내용을 입력하세요.',
            'review' => '여기에 입력하여 리뷰를 남길 수 있습니다.',
            'timeline' => '타임라인(:version)에 게시할 내용을 입력하세요.',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => '노트',
            'nomination_reset' => '노미네이션 초기화',
            'praise' => '칭찬',
            'problem' => '문제',
            'problem_warning' => '문제 신고',
            'review' => '리뷰',
            'suggestion' => '제안',
        ],

        'message_type_title' => [
            'disqualify' => 'Disqualification 게시',
            'hype' => 'Hype 게시!',
            'mapper_note' => '노트 게시',
            'nomination_reset' => '모든 노미네이션 삭제',
            'praise' => '칭찬 게시',
            'problem' => '문제 게시',
            'problem_warning' => '문제 게시',
            'review' => '리뷰 게시',
            'suggestion' => '제안 게시',
        ],

        'mode' => [
            'events' => '기록',
            'general' => '일반 :scope',
            'reviews' => '리뷰',
            'timeline' => '타임라인',
            'scopes' => [
                'general' => '해당 난이도',
                'generalAll' => '모든 난이도',
            ],
        ],

        'new' => [
            'pin' => '고정',
            'timestamp' => '타임스탬프',
            'timestamp_missing' => '비트맵 편집 모드에서 Ctrl-C를 눌러 복사하고 이 곳에 붙여넣어 타임스탬프를 추가할 수 있습니다!',
            'title' => '새 토론',
            'unpin' => '고정 해제',
        ],

        'review' => [
            'new' => '새 리뷰 남기기',
            'embed' => [
                'delete' => '삭제',
                'missing' => '[토론 삭제됨]',
                'unlink' => '링크 해제',
                'unsaved' => '저장되지 않음',
                'timestamp' => [
                    'all-diff' => '"모든 난이도"의 게시글에는 시간을 달 수 없습니다.',
                    'diff' => '만약 이 게시글이 타임스탬프로 시작한다면, 타임라인 아래에 표시됩니다.',
                ],
            ],
            'insert-block' => [
                'paragraph' => '단락 삽입',
                'praise' => '칭찬 삽입',
                'problem' => '문제 삽입',
                'suggestion' => '제안 삽입',
            ],
        ],

        'show' => [
            'title' => ':mapper 님이 제작한 :title',
        ],

        'sort' => [
            'created_at' => '만든 날짜',
            'timeline' => '타임라인',
            'updated_at' => '마지막 업데이트',
        ],

        'stats' => [
            'deleted' => '삭제됨',
            'mapper_notes' => '노트',
            'mine' => '내 글',
            'pending' => '대기 중',
            'praises' => '칭찬',
            'resolved' => '해결됨',
            'total' => '모두',
        ],

        'status-messages' => [
            'approved' => '이 비트맵은 :date에 Approved 상태가 되었습니다!',
            'graveyard' => "이 비트맵은 :date 이후로 업데이트되지 않았고, 제작자에게 버려진 것 같습니다..",
            'loved' => '이 비트맵은 :date에 Loved 되었습니다!',
            'ranked' => '이 비트맵은 :date에 Ranked 상태가 되었습니다!',
            'wip' => '안내: 이 비트맵은 제작자가 제작 중으로 표시한 맵입니다.',
        ],

        'votes' => [
            'none' => [
                'down' => '아직 비추천이 없습니다',
                'up' => '아직 추천이 없습니다',
            ],
            'latest' => [
                'down' => '최근 비추천',
                'up' => '최근 추천',
            ],
        ],
    ],

    'hype' => [
        'button' => '비트맵 Hype!',
        'button_done' => '이미 Hype 했습니다!',
        'confirm' => "확실한가요? 이 작업은 남아있는 :n개의 Hype를 사용하고, 취소할 수 없습니다.",
        'explanation' => 'Hype로 비트맵의 노출 순위를 올릴 수 있습니다. 비트맵이 더 빠르게 랭크되길 바란다면 Hype 하세요!',
        'explanation_guest' => 'Hype로 비트맵의 노출 순위를 올릴 수 있습니다. 비트맵이 더 빠르게 랭크되길 바란다면 로그인 후 Hype 하세요!',
        'new_time' => ":new_time에 새로운 Hype를 받을 수 있습니다.",
        'remaining' => ':remaining번 Hype 할 수 있습니다.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => '의견 남기기',
    ],

    'nominations' => [
        'already_nominated' => '이미 이 비트맵을 노미네이트 했습니다.',
        'cannot_nominate' => '이 비트맵 게임 모드를 노미네이트 할 수 없습니다.',
        'delete' => '삭제',
        'delete_own_confirm' => '확실한가요? 비트맵을 제거하고 당신의 프로필로 돌아갑니다.',
        'delete_other_confirm' => '확실한가요? 비트맵을 제거하고 해당 유저의 프로필로 돌아갑니다.',
        'disqualification_prompt' => 'Disqualify 처리하는 이유는 무엇입니까?',
        'disqualified_at' => ':time_ago에 Disqualify 됨 (:reason).',
        'disqualified_no_reason' => '이유가 명시되지 않았습니다',
        'disqualify' => 'Disqualify',
        'incorrect_state' => '해당 작업을 수행하는 중 오류가 발생했습니다, 페이지를 새로 고쳐보세요.',
        'love' => 'Love',
        'love_choose' => 'Loved 비트맵의 난이도 선택',
        'love_confirm' => '이 비트맵을 Love 하겠습니까?',
        'nominate' => '노미네이트',
        'nominate_confirm' => '이 비트맵을 노미네이트 하시겠습니까?',
        'nominated_by' => ':users님이 노미네이트 함',
        'not_enough_hype' => "Hype 수가 부족합니다.",
        'remove_from_loved' => 'Loved 상태에서 제거',
        'remove_from_loved_prompt' => 'Loved 상태에서 제거된 이유',
        'required_text' => '노미네이션: :current/:required',
        'reset_message_deleted' => '삭제됨',
        'title' => '노미네이션 상태',
        'unresolved_issues' => '먼저 해결되지 않은 토론을 마무리 지어야 합니다.',

        'rank_estimate' => [
            '_' => '이 맵에서 문제가 발견되지 않으면 :date Ranked 상태가 될 예정입니다. 현재 :queue의 #:position번째 순서입니다.',
            'unresolved_problems' => '이 맵은 :problems가 해결되기 전까지 Qualified 섹션에서 넘어갈 수 없습니다.',
            'problems' => '이 문제',
            'on' => ':date에',
            'queue' => '랭크 대기열',
            'soon' => '곧',
        ],

        'reset_at' => [
            'nomination_reset' => ':time_ago 전 :user님이 노미네이션을 초기화했습니다. :discussion (:message)',
            'disqualify' => ':time_ago 전 :user님에 의해 Disqualify 되었습니다. :discussion (:message)',
        ],

        'reset_confirm' => [
            'disqualify' => '확실한가요? 이 작업은 비트맵을 퀄리파이 상태에서 제거하고 노미네이션을 초기화합니다.',
            'nomination_reset' => '확실한가요? 새로운 문제를 제기하는 것은 노미네이션을 초기화시킵니다.',
            'problem_warning' => '정말로 이 비트맵의 문제를 신고할까요? 비트맵 노미네이터에게 알림이 전송됩니다.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '검색어를 입력하세요...',
            'login_required' => '검색하려면 로그인하세요.',
            'options' => '검색 옵션 더 보기',
            'supporter_filter' => ':filters로 검색하려면 osu! 서포터 태그가 필요합니다.',
            'not-found' => '결과 없음',
            'not-found-quote' => '... 없네요, 아무것도 못 찾았습니다.',
            'filters' => [
                'extra' => '추가 기능',
                'general' => '일반',
                'genre' => '장르',
                'language' => '언어',
                'mode' => '모드',
                'nsfw' => '부적절한 맵',
                'played' => '플레이함',
                'rank' => '순위 기록됨',
                'status' => '카테고리',
            ],
            'sorting' => [
                'title' => '제목',
                'artist' => '아티스트',
                'difficulty' => '난이도',
                'favourites' => '즐겨찾기',
                'updated' => '최근 순',
                'ranked' => '랭크된 날짜',
                'rating' => '평가',
                'plays' => '플레이된 횟수',
                'relevance' => '연관성',
                'nominations' => '추천 순',
            ],
            'supporter_filter_quote' => [
                '_' => '":filters" 필터를 사용하시려면 :link가 필요합니다.',
                'link_text' => 'osu! 서포터',
            ],
        ],
    ],
    'general' => [
        'converts' => '변환된 비트맵 포함',
        'featured_artists' => '공식 아티스트',
        'follows' => '구독한 비트맵 제작자',
        'recommended' => '권장 난이도',
        'spotlights' => '스포트라이트 비트맵',
    ],
    'mode' => [
        'all' => '전체',
        'any' => '모두',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
        'undefined' => '미지정',
    ],
    'status' => [
        'any' => '모두',
        'approved' => 'Approved',
        'favourites' => '즐겨찾기',
        'graveyard' => '무덤에 감',
        'leaderboard' => '리더보드 있음',
        'loved' => 'Loved',
        'mine' => '내 비트맵',
        'pending' => '대기 중 & 작업 중',
        'wip' => '제작 중',
        'qualified' => 'Qualified',
        'ranked' => 'Ranked',
    ],
    'genre' => [
        'any' => '모두',
        'unspecified' => '분류되지 않음',
        'video-game' => '비디오 게임',
        'anime' => '애니메이션',
        'rock' => '락',
        'pop' => '팝',
        'other' => '기타',
        'novelty' => '이색적인 장르',
        'hip-hop' => '힙합',
        'electronic' => '일렉트로닉',
        'metal' => '메탈',
        'classical' => '클래식',
        'folk' => '포크',
        'jazz' => '재즈',
    ],
    'language' => [
        'any' => '모두',
        'english' => '영어',
        'chinese' => '중국어',
        'french' => '프랑스어',
        'german' => '독일어',
        'italian' => '이탈리아어',
        'japanese' => '일본어',
        'korean' => '한국어',
        'spanish' => '스페인어',
        'swedish' => '스웨덴어',
        'russian' => '러시아어',
        'polish' => '폴란드어',
        'instrumental' => 'Instrumental',
        'other' => '기타',
        'unspecified' => '미지정',
    ],

    'nsfw' => [
        'exclude' => '숨기기',
        'include' => '표시',
    ],

    'played' => [
        'any' => '모두',
        'played' => '플레이한 맵',
        'unplayed' => '플레이하지 않은 맵',
    ],
    'extra' => [
        'video' => '비디오 있음',
        'storyboard' => '스토리보드 있음',
    ],
    'rank' => [
        'any' => '모두',
        'XH' => '실버 SS',
        'X' => '',
        'SH' => '실버 S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => '플레이 횟수: :count',
        'favourites' => '즐겨찾기 수: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => '전체',
        ],
    ],
];
