<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'show' => [
        'fallback_translation' => '요청하신 페이지는 아직 사용하시는 언어(:language)로 번역되지 않았네요. 영어로 된 페이지를 보여드릴게요.',
        'incomplete_or_outdated' => '이 페이지의 내용은 미완성 이거나 오래된 내용입니다. 도울 여건이 되신다면, 이 글을 업데이트하는 것을 고려해 주세요!',
        'missing' => '요청하신 ":keyword" 페이지를 찾을 수 없습니다.',
        'missing_title' => '찾을 수 없음',
        'missing_translation' => '현재 사용하시는 언어로 된 요청하신 페이지를 찾을 수 없습니다.',
        'needs_cleanup_or_rewrite' => '이 페이지는 osu! 위키 표준을 따르지 않으며 정리해서 다시 쓸 필요가 있습니다. 도울 여건이 되신다면, 글 업데이트를 고려해 주세요!',
        'search' => ':link에 해당하는 페이지',
        'toc' => '내용',

        'edit' => [
            'link' => 'GitHub에서 보기',
            'refresh' => '새로 고침',
        ],

        'translation' => [
            'legal' => '이 번역은 편의를 위해서만 제공 됩니다. 이 :default의 원문만이 법적 구속력을 가지고 있습니다.',
            'outdated' => '이 문서는 이전 버전 기준으로 번역된 내용을 포함하고 있습니다. :default에서 가장 정확한 최신 정보를 확인하세요 (가능하다면 번역에 동참해 주세요)!',

            'default' => '영어 버전',
        ],
    ],
    'main' => [
        'title' => '지식 창고',
        'subtitle' => '그렇다고 osu!백과는 좀 아니잖아요',
    ],
];
