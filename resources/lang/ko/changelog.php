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
    'feed_title' => '피드',
    'generic' => '버그 수정 및 소소한 사항 개선.',

    'build' => [
        'title' => ':version 에서 바뀐 것들',
    ],

    'builds' => [
        'users_online' => '접속중인 사용자: :count_delimited명',
    ],

    'entry' => [
        'by' => ':user 님이 구현',
    ],

    'index' => [
        'page_title' => [
            '_' => '변경 목록',
            '_from' => ':from 부터 바뀐 것들',
            '_from_to' => ':from 과 :to 사이에 바뀐 것들',
            '_stream' => ':stream 에서 바뀐 것들',
            '_stream_from' => ':from 부터 :stream 에서 바뀐 것들',
            '_stream_from_to' => ':stream 에서 :from 과 :to 사이에 바뀐 것들',
            '_stream_to' => ':stream 의 :to 까지 바뀐 것들',
            '_to' => ':to 까지 바뀐 것들',
        ],

        'title' => [
            '_' => '변경 사항 :info',
            'info' => '목록',
        ],
    ],

    'support' => [
        'heading' => '이 업데이트가 맘에 드세요?',
        'text_1' => 'osu!의 개발을 지원하고 :link!',
        'text_1_link' => '서포터가 되세요',
        'text_2' => '빠른 개발을 도울 뿐만 아니라 몇 가지 추가 기능과 맞춤 설정을 할 수 있어요!',
    ],
];
