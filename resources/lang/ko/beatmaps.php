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
            'error' => '답글 저장 실패',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '투표 변경 실패',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosu 허용하기',
        'delete' => '삭제',
        'deleted' => ':delete_time에 :editor님에 의해 삭제되었습니다',
        'deny_kudosu' => 'kudosu 박탈하기',
        'edit' => '수정',
        'edited' => ':update_time에 :editor님에 의해 마지막으로 수정됨',
        'kudosu_denied' => 'kudosu 획득이 불가능합니다.',
        'message_placeholder_deleted_beatmap' => '제거된 난이도이므로 더 이상의 토론이 불가능합니다.',
        'message_type_select' => '게시할 답글의 형식을 선택하세요',
        'reply_notice' => '답변을 보내려면 엔터를 누르세요.',
        'reply_placeholder' => '보내실 답변의 내용을 입력하세요.',
        'require-login' => '답글을 올리려면 로그인해 주세요',
        'resolved' => '해결됨',
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
            'in_general' => '작성된 글은 일반 비트맵 토론으로 올라가집니다. 비트맵을 모딩하시려면 글의 첫 부분을 타임스탬프로 시작하십시오 (예시, 00:12:345).',
            'in_timeline' => '비트맵의 여러 부분을 수정하려면 글을 여러 번 올리세요 (한 글에 한 타임스탬프만 수정할 수 있습니다).',
        ],

        'message_placeholder' => [
            'general' => '일반(:version)에 게시할 답글 내용을 입력하세요.',
            'generalAll' => '일반(모든 난이도)에 게시할 답글 내용을 입력하세요.',
            'timeline' => '타임라인(:version)에 게시할 답글 내용을 입력하세요.',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => '노트',
            'nomination_reset' => 'Nomination 초기화',
            'praise' => '칭찬',
            'problem' => '문제',
            'suggestion' => '제안',
        ],

        'mode' => [
            'events' => '기록',
            'general' => '일반 :scope',
            'timeline' => '타임라인',
            'scopes' => [
                'general' => '해당 난이도',
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
            'mapper_notes' => '노트',
            'mine' => '내 글',
            'pending' => '토론중',
            'praises' => '칭찬',
            'resolved' => '해결됨',
            'total' => '모두',
        ],

        'status-messages' => [
            'approved' => '이 비트맵은 :date에 Approved 되었습니다!',
            'graveyard' => "이 비트맵은 :date 이후로 업데이트되지 않았고, 제작자에게 버려진 것 같습니다..",
            'loved' => '이 비트맵은 :date에 Loved 되었습니다!',
            'ranked' => '이 비트맵은 :date에 Ranked 되었습니다!',
            'wip' => '안내: 이 비트맵은 제작자가 \'미완성\'으로 표시한 맵입니다.',
        ],

    ],

    'hype' => [
        'button' => '비트맵 Hype!',
        'button_done' => '이미 Hype했습니다!',
        'confirm' => "확실한가요? 이 작업은 남아있는 :n개의 Hype를 사용하고, 취소할 수 없습니다.",
        'explanation' => 'Hype로 이 비트맵의 노출 순위를 올릴 수 있습니다. 빠르게 랭크맵이 되길 원한다면 Hype 하세요!',
        'explanation_guest' => 'Hype로 이 비트맵의 노출 순위를 올릴 수 있습니다. 빠르게 랭크맵이 되길 원한다면 로그인 후 Hype 하세요!',
        'new_time' => ":new_time에 새로운 hype를 받을 수 있습니다.",
        'remaining' => 'hype가 :remaining개 남았습니다.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => '의견 남기기',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Disqualify하는 이유는 무엇입니까?',
        'disqualified_at' => ':time_ago에 Disqualified 됨 (:reason).',
        'disqualified_no_reason' => '이유가 명시되지 않았습니다',
        'disqualify' => 'Disqualify',
        'incorrect_state' => '해당 작업을 수행하는 중 오류가 발생했습니다, 페이지를 새로 고쳐보세요.',
        'love' => '하트',
        'love_confirm' => '이 비트맵이 마음에 드시나요?',
        'nominate' => '지명',
        'nominate_confirm' => '이 비트맵을 지명하시겠습니까?',
        'nominated_by' => ':users님이 지명함',
        'qualified' => '문제가 발견되지 않으면 :date에 랭크됩니다.',
        'qualified_soon' => '문제가 발견되지 않으면 곧 랭크됩니다.',
        'required_text' => '지명 수: :current/:required',
        'reset_message_deleted' => '삭제됨',
        'title' => '지명 상태',
        'unresolved_issues' => '먼저 해결되지 않은 토론을 마무리지어야 합니다.',

        'reset_at' => [
            'nomination_reset' => ':time_ago 전 :user님이 지명 상태를 초기화시켰습니다. :discussion (:message)',
            'disqualify' => ':time_ago 전 :user님에 의해 Disqualified 되었습니다. :discussion (:message)',
        ],

        'reset_confirm' => [
            'nomination_reset' => '확실한가요? 새로운 문제를 제기하는 것은 지명 상태를 초기화시킵니다.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '검색어를 입력하세요...',
            'login_required' => '검색하려면 로그인하세요.',
            'options' => '검색 옵션 더 보기',
            'supporter_filter' => ':filters로 검색하려면 osu! 서포터 권한이 필요합니다.',
            'not-found' => '결과 없음',
            'not-found-quote' => '... 없네요, 아무것도 못 찾았습니다.',
            'filters' => [
                'general' => '일반',
                'mode' => '모드',
                'status' => '카테고리',
                'genre' => '장르',
                'language' => '언어',
                'extra' => '추가 기능',
                'rank' => '순위 기록됨',
                'played' => '플레이함',
            ],
            'sorting' => [
                'title' => '제목',
                'artist' => '아티스트',
                'difficulty' => '난이도',
                'updated' => '최신 업데이트',
                'ranked' => '랭크된 날짜',
                'rating' => '평점',
                'plays' => '플레이된 횟수',
                'relevance' => '연관성',
                'nominations' => '지명',
            ],
            'supporter_filter_quote' => [
                '_' => ':filters로 검색하려면 :link이 필요합니다.',
                'link_text' => 'osu! 서포터',
            ],
        ],
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
        'qualified' => 'Qualified',
        'loved' => 'Loved',
        'faves' => '즐겨찾기',
        'pending' => '보류 중 & 작업 중',
        'graveyard' => 'Graveyard',
        'my-maps' => '내 비트맵',
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
        'instrumental' => 'Instrumental',
        'other' => '기타',
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
        'X' => 'SS',
        'SH' => '실버 S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
