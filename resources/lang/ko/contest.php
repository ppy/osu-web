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
    'header' => [
        'small' => '원을 클릭하는 것 말고도 더 다양한 방법으로 겨뤄보세요.',
        'large' => '커뮤니티 콘테스트',
    ],
    'voting' => [
        'over' => '현재 콘테스트의 투표가 종료되었습니다.',
        'login_required' => '투표하려면 로그인해주세요.',
        'best_of' => [
            'none_played' => "이 콘테스트에서 평가할 어떤 맵도 플레이하지 않으신 것 같네요.",
        ],
    ],
    'entry' => [
        '_' => '참가',
        'login_required' => '콘테스트에 참가하려면 로그인해주세요.',
        'silenced_or_restricted' => '제한 또는 침묵상태에서는 콘테스트에 참가할 수 없습니다.',
        'preparation' => '현재 콘테스트가 준비중에 있습니다. 인내심을 갖고 조금만 더 기다려주세요!',
        'over' => '콘테스트에 참가해주셔서 감사합니다! 작품 제출이 마감되었고, 곧 투표가 시작됩니다.',
        'limit_reached' => '이 콘테스트에서 참가 가능한 작품 수를 초과했습니다.',
        'drop_here' => '참가할 작품을 이곳에 끌어넣어주세요.',
        'wrong_type' => [
            'art' => '이 콘테스트에서는 .jpg 파일과 .png 파일만 등록할 수 있습니다.',
            'beatmap' => '이 콘테스트에서는 .osu 파일만 등록할 수 있습니다.',
            'music' => '이 콘테스트에서는 .mp3 파일만 등록할 수 있습니다.',
        ],
        'too_big' => '이 콘테스트의 최대 참가 가능한 작품 수는 :limit개 입니다.',
    ],
    'beatmaps' => [
        'download' => '참가작 다운로드',
    ],
    'vote' => [
        'list' => '투표',
        'count' => ':count 표 받음',
    ],
    'dates' => [
        'ended' => ':date 에 끝났습니다',

        'starts' => [
            '_' => ':date 에 시작합니다',
            'soon' => '곧...™',
        ],
    ],
    'states' => [
        'entry' => '참가 작품 모집중',
        'voting' => '투표 시작됨',
        'results' => '결과 발표됨',
    ],
];
