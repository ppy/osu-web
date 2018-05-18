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
        'kudosu_denied' => '',
        'message_placeholder' => '게시할 답글의 내용을 입력하세요.',
        'message_placeholder_deleted_beatmap' => '',
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
            'disqualify' => '실격',
            'hype' => '홍보!',
            'mapper_note' => '',
            'nomination_reset' => '',
            'praise' => '칭찬',
            'problem' => '문제',
            'suggestion' => '제안',
        ],

        'mode' => [
            'events' => '기록',
            'general' => '일반 :scope',
            'timeline' => '타임라인',
            'scopes' => [
                'general' => '이 난이도',
                'generalAll' => '모든 난이도',
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
            '_' => '정렬 기준:',
            'created_at' => '작성일',
            'timeline' => '타임라인',
            'updated_at' => '최근 업데이트',
        ],

        'stats' => [
            'deleted' => '삭제됨',
            'mapper_notes' => '',
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
        'confirm' => "",
        'explanation' => '',
        'explanation_guest' => '',
        'new_time' => "",
        'remaining' => ':remaining개의 홍보권이 남았습니다.',
        'required_text' => '홍보 가능 횟수: :current/:required',
        'section_title' => 'Hype Train',
        'title' => '비트맵 홍보',
    ],

    'feedback' => [
        'button' => '의견 남기기',
    ],

    'nominations' => [
        'disqualification_prompt' => '실격시키려는 사유는요?',
        'disqualified_at' => ':time_ago에 실격처리 되었습니다 (:reason).',
        'disqualified_no_reason' => '사유가 명시되지 않았습니다',
        'disqualify' => '실격시키기',
        'incorrect_state' => '해당 작업을 수행하는 중 오류가 발생했습니다, 페이지를 새로 고쳐보세요.',
        'nominate' => '추천하기',
        'nominate_confirm' => '이 비트맵을 추천할까요?',
        'nominated_by' => '',
        'qualified' => '아무런 문제가 발견되지 않으면, :date에 Ranked될 것입니다.',
        'qualified_soon' => '아무런 문제가 발견되지 않으면, 곧 Ranked될 것입니다.',
        'required_text' => '추천 수: :current/:required',
        'reset_message_deleted' => '삭제됨',
        'title' => '추천 상태',
        'unresolved_issues' => '',

        'reset_at' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],

        'reset_confirm' => [
            'nomination_reset' => '',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '검색어를 입력하세요...',
            'options' => '검색 옵션 더 보기',
            'not-found' => '결과 없음',
            'not-found-quote' => '... 없네요, 아무것도 못 찾았습니다.',
            'filters' => [
                'general' => '일반',
                'mode' => '모드',
                'status' => '등록 상태',
                'genre' => '장르',
                'language' => '언어 분류',
                'extra' => '부가 기능',
                'rank' => '순위 기록됨',
                'played' => '플레이함',
            ],
        ],
        'mode' => '모드',
        'status' => '등록 상태',
        'mapped-by' => ':mapper님이 제작',
        'source' => '원작: :source',
        'load-more' => '더 불러오기...',
    ],
    'general' => [
        'recommended' => '권장 난이도',
        'converts' => '변환된 비트맵 포함',
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
        'qualified' => '',
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
        'TD' => '',
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
        'any' => '',
        'played' => '플레이함',
        'unplayed' => '플레이하지 않음',
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
