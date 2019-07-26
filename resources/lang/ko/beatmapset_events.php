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
    'event' => [
        'approve' => 'Approved.',
        'discussion_delete' => 'Moderator가 :discussion 토론을 삭제했습니다.',
        'discussion_lock' => '이 비트맵에 대한 토론이 비활성화되었습니다. (:text)',
        'discussion_post_delete' => 'Moderator가 :discussion 토론에 달린 글을 삭제했습니다.',
        'discussion_post_restore' => 'Moderator가 :discussion 토론에서 삭제된 글을 복원했습니다.',
        'discussion_restore' => 'Moderator가 삭제된 :discussion 토론을 복원했습니다.',
        'discussion_unlock' => '이 비트맵에 대한 토론이 활성화되었습니다.',
        'disqualify' => ':user 님에게 Disqualified 처리 받음. 이유: :discussion (:text).',
        'disqualify_legacy' => ':user 님에게 Disqualified 처리 받음. 이유: :text.',
        'issue_reopen' => '마무리된 토론 :discussion이 재개되었습니다.',
        'issue_resolve' => '토론 :discussion이 마무리되었습니다.',
        'kudosu_allow' => '토론 :discussion이 다시 kudosu 획득 자격을 얻었습니다.',
        'kudosu_deny' => '토론 :discussion에서 kudosu 획득이 박탈당했습니다.',
        'kudosu_gain' => '토론 :discussion에서 :user님이 kudosu를 받을 만큼 충분한 표를 얻었습니다.',
        'kudosu_lost' => '토론 :discussion에서 :user님이 표를 잃어 획득한 kudosu가 사라졌습니다.',
        'kudosu_recalculate' => '토론 :discussion에서 kudosu 획득량이 재조정되었습니다.',
        'love' => ':user님에게 Loved 받음',
        'nominate' => ':user님이 지명함.',
        'nomination_reset' => '새로운 문제 :discussion (:text)가 지명 상태를 초기화시켰습니다.',
        'qualify' => '이 비트맵은 충분한 지명을 받았고 qualified 상태로 전환 되었습니다.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => 'Beatmapset Events',

        'form' => [
            'period' => '기간',
            'types' => '종류',
        ],
    ],

    'item' => [
        'content' => '내용',
        'discussion_deleted' => '[삭제됨]',
        'type' => '종류',
    ],

    'type' => [
        'approve' => '승인',
        'discussion_delete' => '토론 삭제',
        'discussion_post_delete' => '토론 답글 삭제',
        'discussion_post_restore' => '토론 답글 복원',
        'discussion_restore' => '토론 복원',
        'disqualify' => '실격',
        'issue_reopen' => '토론 재개',
        'issue_resolve' => '토론 해결',
        'kudosu_allow' => 'Kudosu 허용',
        'kudosu_deny' => 'Kudosu 거부',
        'kudosu_gain' => 'Kudosu 획득',
        'kudosu_lost' => 'Kudosu 잃음',
        'kudosu_recalculate' => 'Kudosu 재계산',
        'love' => '러브',
        'nominate' => '지명',
        'nomination_reset' => '지명 재설정',
        'qualify' => '자격',
        'rank' => '랭킹',
    ],
];
