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
    'discussion-posts' => [
        'store' => [
            'error' => '답글을 저장하는데 실패했습니다',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '투표를 변경하는데 실패했습니다',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosu 승인',
        'delete' => '삭제',
        'deleted' => ':delete_time에 :editor님에 의해 삭제되었습니다',
        'deny_kudosu' => 'kudosu 거절',
        'edit' => '편집',
        'edited' => ':update_time에 :editor님에 의해 마지막으로 수정됨',
        'kudosu_denied' => 'Denied from obtaining kudosu.',
        'message_placeholder' => '게시할 답글의 내용을 입력하세요.',
        'message_placeholder_deleted_beatmap' => 'This difficulty has been deleted so it may no longer be discussed.',
        'message_type_select' => '게시할 답글의 형식을 선택하세요',
        'reply_notice' => '답변을 보내려면 엔터를 누르세요.',
        'reply_placeholder' => '보내실 답변의 내용을 입력하세요.',
        'require-login' => '답글을 올리려면 로그인해 주세요',
        'resolved' => '결정됨',
        'restore' => '복구됨',
        'title' => '토론',

        'collapse' => [
            'all-collapse' => '모두 축소하기',
            'all-expand' => '모두 확대하기',
        ],

        'empty' => [
            'empty' => '아직 토론이 아무것도 없습니다!',
            'hidden' => '검색 결과에 해당하는 토론이 없습니다.',
        ],

        'message_hint' => [
            'in_general' => '작성된 글은 일반 비트맵 토론으로 올라갈 것입니다. 이 비트맵 조정에 참여하려면, 글의 첫 부분을 타임스탬프로 시작하십시오 (예시, 00:12:345).',
            'in_timeline' => '비트맵의 여러 부분을 수정하려면, 글을 수 차례 올려야 합니다 (한 글에 한 타임스탬프밖에 수정할 수 없습니다).',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => 'Note',
            'nomination_reset' => 'Reset Nomination',
            'praise' => '칭찬',
            'problem' => '문제',
            'suggestion' => '제안',
        ],

        'mode' => [
            'events' => '기록',
            'general' => 'General :scope',
            'timeline' => '타임라인',
            'scopes' => [
                'general' => 'This difficulty',
                'generalAll' => 'All difficulties',
            ],
        ],

        'new' => [
            'timestamp' => '타임스탬프',
            'timestamp_missing' => '비트맵 편집 모드에서 Ctrl-C를 눌러 복사하고 이 곳에 붙여넣어 타임스탬프를 추가할 수 있습니다!',
            'title' => '새 토론',
        ],

        'show' => [
            'title' => ':title, :mapper님이 ',
        ],

        'sort' => [
            '_' => 'Sorted by:',
            'created_at' => 'creation time',
            'timeline' => 'timeline',
            'updated_at' => 'last update',
        ],

        'stats' => [
            'deleted' => '삭제됨',
            'mapper_notes' => 'Notes',
            'mine' => 'Mine',
            'pending' => 'Pending',
            'praises' => 'Praises',
            'resolved' => 'Resolved',
            'total' => '모두',
        ],

        'status-messages' => [
            'approved' => '이 비트맵은 :date에 Approved 되었습니다!',
            'graveyard' => "이 비트맵은 :date 이후로는 업데이트되지 않았고, 제작자가 제작을 거의 포기한 것 같습니다...",
            'loved' => '이 비트맵은 :date에 Loved 비트맵으로 추가되었습니다!',
            'ranked' => '이 비트맵은 :date에 Ranked 되었습니다!',
            'wip' => 'Note: 이 비트맵은 제작자가 \'제작중\'이라고 표시한 맵입니다.',
        ],

    ],

    'hype' => [
        'button' => '비트맵 홍보하기!',
        'button_done' => '이미 이 비트맵을 홍보하셨습니다!',
        'confirm' => "Are you sure? This will use one out of your remaining :n hype and can't be undone.",
        'explanation' => 'Hype this beatmap to make it more visible for nomination and ranking!',
        'explanation_guest' => 'Sign in and hype this beatmap to make it more visible for nomination and ranking!',
        'new_time' => "You'll get another hype :new_time.",
        'remaining' => 'You have :remaining hype left.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => '비트맵 홍보',
    ],

    'feedback' => [
        'button' => 'Leave Feedback',
    ],

    'nominations' => [
        'disqualification_prompt' => '실격시키려는 사유는요?',
        'disqualified_at' => ':time_ago에 실격처리 되었습니다 (:reason).',
        'disqualified_no_reason' => '사유가 명시되지 않았습니다',
        'disqualify' => '실격시키기',
        'incorrect_state' => 'Error performing that action, try refreshing the page.',
        'nominate' => '추천하기',
        'nominate_confirm' => '이 비트맵을 추천할까요?',
        'nominated_by' => 'nominated by :users',
        'qualified' => '아무런 문제가 발견되지 않으면, :date에 Ranked될 것입니다.',
        'qualified_soon' => '아무런 문제가 발견되지 않으면, 곧 Ranked될 것입니다.',
        'required_text' => '추천 수: :current/:required',
        'reset_message_deleted' => 'deleted',
        'title' => '추천 상태',
        'unresolved_issues' => 'There are still unresolved issues that must be addressed first.',

        'reset_at' => [
            'nomination_reset' => 'Nomination process reset :time_ago by :user with new problem :discussion (:message).',
            'disqualify' => 'Disqualified :time_ago by :user with new problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Are you sure? Posting a new problem will reset nomination process.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '검색어를 입력하세요...',
            'options' => '검색 옵션 더 보기',
            'not-found' => '결과 없음',
            'not-found-quote' => '... 없네요, 아무것도 못 찾았습니다.',
            'filters' => [
                'general' => 'General',
                'mode' => '모드',
                'status' => '등록 상태',
                'genre' => '장르',
                'language' => '언어 분류',
                'extra' => '부가 기능',
                'rank' => '순위 기록됨',
                'played' => 'Played',
            ],
        ],
        'mode' => '모드',
        'status' => '등록 상태',
        'mapped-by' => ':mapper님이 제작',
        'source' => '원작: :source',
        'load-more' => '더 불러오기...',
    ],
    'general' => [
        'recommended' => 'Recommended difficulty',
        'converts' => 'Include converted beatmaps',
    ],
    'mode' => [
        'any' => '모두',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => '모두',
        'ranked-approved' => 'Ranked & Approved',
        'approved' => 'Approved',
        'qualified' => 'Qualified',
        'loved' => 'Loved',
        'faves' => '즐겨찾기',
        'pending' => 'Pending',
        'graveyard' => 'Graveyard',
        'my-maps' => '내 비트맵',
    ],
    'genre' => [
        'any' => '모두',
        'unspecified' => '분류되지 않음',
        'video-game' => '비디오게임',
        'anime' => '애니메이션',
        'rock' => '락',
        'pop' => '팝',
        'other' => '기타',
        'novelty' => '이색적인 장르',
        'hip-hop' => '힙합',
        'electronic' => '일렉트로닉',
    ],
    'mods' => [
        '4K' => '4키',
        '5K' => '5키',
        '6K' => '6키',
        '7K' => '7키',
        '8K' => '8키',
        '9K' => '9키',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => '모드 없음',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
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
        'instrumental' => '가사 없음',
        'other' => '기타',
    ],
    'played' => [
        'any' => 'Any',
        'played' => 'Played',
        'unplayed' => 'Unplayed',
    ],
    'extra' => [
        'video' => '비디오 있음',
        'storyboard' => '스토리보드 있음',
    ],
    'rank' => [
        'any' => '모두',
        'XH' => '은장 SS',
        'X' => 'SS',
        'SH' => '은장 S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
