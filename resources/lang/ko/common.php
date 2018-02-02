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
    'confirmation' => '확실합니까?', //  Are you sure?
    'saved' => '저장됨',

    'array_and' => [
        'words_connector' => ', ', // A[[, ]]B[[, ]]C, and D 를 표시할 때 사용
        'two_words_connector' => ' 와(과) ', // A[[ and ]]B 를 표시할 때 사용 (앞 종성에 따른 모호함이 발생)
        'last_word_connector' => ', 그리고 ', // A, B, C[, and ] 를 표시할 때 사용
    ],

    'buttons' => [
        'cancel' => '취소',
        'delete' => '삭제',
        'permalink' => '고유 주소', // permalink
        'post' => '게시하기', // Post
        'reply' => '답변하기', // Reply
        'reset' => '초기화',
        'save' => '저장',
        'saving' => '저장 중...',
        'show_more' => '더 보기',
        'upload_image' => '이미지 업로드',
    ],

    'count' => [
        'item' => ':count unit|:count units',
        'months' => ':count 달|:count 달',
        'years' => ':count 년|:count 년',
    ],

    'datetime' => [
        'year_month' => [
            'moment' => 'MMMM YYYY',
            'php' => 'MMMM y',
        ],
    ],

    'device' => [
        'keyboard' => '키보드',
        'mouse' => '마우스',
        'tablet' => '태블릿',
        'touch' => '터치 스크린',
    ],

    'dropzone' => [
        'target' => '업로드할 파일을 이곳에 끌어놓으세요',
    ],

    'pagination' => [
        'previous' => '이전',
        'next' => '다음',
    ],

    'score_count' => [
        'count_100' => '100',
        'count_300' => '300',
        'count_50' => '50',
        'count_geki' => 'MAX',
        'count_katu' => '200',
        'count_miss' => 'Miss',
    ],

    'time' => [
        'days_ago' => ':count 일 전',
        'hours_ago' => ':count 시간 전',
        'now' => '지금',
        'remaining' => '남은 시간',
    ],

    'title' => [
        'notice' => '알림', // Notice
    ],
];
