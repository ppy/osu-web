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
            'in_general' => 'This post will go to general beatmapset discussion. To mod this beatmap, start message with timestamp (e.g. 00:12:345).',
            'in_timeline' => 'To mod multiple timestamps, post multiple times (one post per timestamp).',
        ],

        'message_type' => [
            'praise' => '칭찬',
            'problem' => '문제',
            'suggestion' => '제안',
        ],

        'mode' => [
            'events' => 'History',
            'general' => 'General',
            'general_all' => 'General (all difficulties)',
            'timeline' => 'Timeline',
        ],

        'new' => [
            'timestamp' => '타임스탬프',
            'timestamp_missing' => '비트맵 편집 모드에서 Ctrl-C를 눌러 복사하고 이 곳에 붙여넣어 타임스탬프를 추가할 수 있습니다!',
            'title' => '새 토론',
        ],

        'show' => [
            'title' => ':title mapped by :mapper',
        ],

        'stats' => [
            'deleted' => 'Deleted',
            'mine' => 'Mine',
            'pending' => 'Pending',
            'praises' => 'Praises',
            'resolved' => 'Resolved',
            'total' => 'All',
        ],
    ],

    'nominations' => [
        'disqualifed-at' => 'disqualified :time_ago (:reason).',
        'disqualifed_no_reason' => 'no reason specified',
        'disqualification-prompt' => 'Reason for disqualification?',
        'disqualify' => 'Disqualify',
        'incorrect-state' => 'Error performing that action, try refreshing the page.',
        'nominate' => 'Nominate',
        'nominate-confirm' => 'Nominate this beatmap?',
        'qualified' => 'Estimated to be ranked :date, if no issues are found.',
        'qualified-soon' => 'Estimated to be ranked soon, if no issues are found.',
        'required-text' => 'Nominations: :current/:required',
        'title' => 'Nomination Status',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'type in keywords...',
            'options' => 'More Search Options',
            'not-found' => 'no results',
            'not-found-quote' => '... nope, nothing found.',
            'filters' => [
                'mode' => 'Mode',
                'status' => 'Rank Status',
                'genre' => 'Genre',
                'language' => 'Language',
                'extra' => 'extra',
                'rank' => 'Rank Achieved',
            ],
        ],
        'mode' => 'Mode',
        'status' => 'Rank Status',
        'mapped-by' => 'mapped by :mapper',
        'source' => 'from :source',
        'load-more' => 'Load more...',
    ],
    'mode' => [
        'any' => 'Any',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Any',
        'ranked-approved' => 'Ranked & Approved',
        'approved' => 'Approved',
        'loved' => 'Loved',
        'faves' => 'Favourites',
        'modreqs' => 'Mod Requests',
        'pending' => 'Pending',
        'graveyard' => 'Graveyard',
        'my-maps' => 'My Maps',
    ],
    'genre' => [
        'any' => 'Any',
        'unspecified' => 'Unspecified',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Other',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
    ],
    'mods' => [
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'No mods',
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
        'any' => 'Any',
        'XH' => 'Silver SS',
        'X' => 'SS',
        'SH' => 'Silver S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
