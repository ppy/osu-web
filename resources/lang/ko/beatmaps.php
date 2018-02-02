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
        'message_placeholder' => '게시할 답글의 내용을 입력하세요.',
        'message_type_select' => '게시할 답글의 형식을 선택하세요',
        'reply_notice' => '답변을 보내려면 엔터를 누르세요.',
        'reply_placeholder' => '보내실 답변의 내용을 입력하세요.',
        'require-login' => '답글을 올리려면 로그인해 주세요',
        'resolved' => '결정됨', // Resolved, 해결됨이 적절할 수 있으나, 비트맵 토론에 관련된 내용이므로 결정으로 표현
        'restore' => '복구됨',
        'title' => '토론',

        'collapse' => [
            'all-collapse' => '모두 축소하기', // Collapse All, 스포일러 박스와 관련된 기능으로 추정됨
            'all-expand' => '모두 확대하기', // Expand All
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
            'praise' => '칭찬',
            'problem' => '문제',
            'suggestion' => '제안',
        ],

        'mode' => [
            'events' => '기록',
            'general' => '일반',
            'general_all' => '일반 (모든 난이도)',
            'timeline' => '타임라인',
        ],

        'new' => [
            'timestamp' => '타임스탬프',
            'timestamp_missing' => '비트맵 편집 모드에서 Ctrl-C를 눌러 복사하고 이 곳에 붙여넣어 타임스탬프를 추가할 수 있습니다!',
            'title' => '새 토론',
        ],

        'show' => [
            'title' => ':title, :mapper님이 ', // ':title mapped by :mapper'
        ],

        'stats' => [
            'deleted' => '삭제됨',
            'mine' => 'Mine', // 내 비트맵(?)
            'pending' => 'Pending', // 보류됨
            'praises' => 'Praises', // 칭찬
            'resolved' => 'Resolved', // 결정됨
            'total' => '모두',
        ],

        'status-messages' => [
            'approved' => '이 비트맵은 :date에 Approved 되었습니다!',
            'graveyard' => '이 비트맵은 :date 이후로는 업데이트되지 않았고, 제작자가 제작을 거의 포기한 것 같습니다...',
            'loved' => '이 비트맵은 :date에 Loved 비트맵으로 추가되었습니다!',
            'ranked' => '이 비트맵은 :date에 Ranked 되었습니다!',
            'wip' => 'Note: 이 비트맵은 제작자가 \'제작중\'이라고 표시한 맵입니다.',
        ],

    ],

    'hype' => [
        'button' => '비트맵 홍보하기!',
        'button_done' => '이미 이 비트맵을 홍보하셨습니다!',
        'section_title' => 'Hype Train', // 영어 슬랭으로, 적당한 말을 찾지 못해 번역
        'title' => '비트맵 홍보', // 원문 'Hype'
    ],

    'nominations' => [
        'disqualification_prompt' => '실격시키려는 사유는요?',
        'disqualified_at' => ':time_ago에 실격처리 되었습니다 (:reason).',
        'disqualified_no_reason' => '사유가 명시되지 않았습니다',
        'disqualify' => '실격시키기',
        'incorrect-state' => '작업을 처리하는 과정에서 문제가 발생했습니다, 페이지를 새로고침 해보세요.',
        'nominate' => '추천하기', // Nominate
        'nominate_confirm' => '이 비트맵을 추천할까요?', // Nominate
        'qualified' => '아무런 문제가 발견되지 않으면, :date에 Ranked될 것입니다.',
        'qualified_soon' => '아무런 문제가 발견되지 않으면, 곧 Ranked될 것입니다.',
        'required_text' => '추천 수: :current/:required',
        'title' => '추천 상태', // Nomination Status
    ],

    'listing' => [
        'search' => [
            'prompt' => '검색어를 입력하세요...',
            'options' => '검색 옵션 더 보기',
            'not-found' => '결과 없음',
            'not-found-quote' => '... 없네요, 아무것도 못 찾았습니다.',
            'filters' => [
                'mode' => '모드',
                'status' => '등록 상태', // Rank Status
                'genre' => '장르',
                'language' => '언어 분류',
                'extra' => '부가 기능',
                'rank' => '순위 기록됨',
            ],
        ],
        'mode' => '모드',
        'status' => '등록 상태', // Rank Status
        'mapped-by' => ':mapper님이 제작',
        'source' => '원작: :source',
        'load-more' => '더 불러오기...',
    ],
    'mode' => [
        'any' => '모두',
        'osu' => 'osu!',
        'taiko' => 'osu!태고',
        'fruits' => 'osu!캐치 더 비트',
        'mania' => 'osu!매니아',
    ],
    'status' => [
        'any' => '모두',
        'ranked-approved' => 'Ranked & Approved', // 랭크 & 공인됨
        'approved' => 'Approved', // 공인됨
        'loved' => 'Loved',
        'faves' => '즐겨찾기',
        'pending' => 'Pending', // 보류됨
        'graveyard' => 'Graveyard', // 사장됨
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
        'novelty' => '이색적인 장르', // 참신한 장르에 붙음
        'hip-hop' => '힙합',
        'electronic' => '일렉트로닉',
    ],
    'mods' => [
        'NF' => 'No Fail', // 노 페일
        'EZ' => 'Easy Mode', // 이지 모드
        'HD' => 'Hidden', // 히든
        'HR' => 'Hard Rock', // 하드 락
        'SD' => 'Sudden Death', // 서든 데스
        'DT' => 'Double Time', // 더블 타임, 2배속
        'Relax' => 'Relax', // 릴렉스
        'HT' => 'Half Time', // 하프 타임
        'NC' => 'Nightcore', // 나이트코어
        'FL' => 'Flashlight', // 플래시라이트
        'SO' => 'Spun Out', // 스펀 아웃
        'AP' => 'Auto Pilot', // 오토 파일럿
        'PF' => 'Perfect', // 퍼펙트
        '4K' => '4키', // 4K
        '5K' => '5키', // 5K
        '6K' => '6키', // 6K
        '7K' => '7키', // 7K
        '8K' => '8키', // 8K
        'FI' => 'Fade In', // 페이드 인
        '9K' => '9키', // 9K
        'NM' => '모드 없음',
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
    'extra' => [
        'video' => '비디오 있음',
        'storyboard' => '스토리보드 있음',
    ],
    'rank' => [
        'any' => '모두',
        'XH' => '은장 SS', // 실버 SS
        'X' => 'SS',
        'SH' => '은장 S', // 실버 S
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
