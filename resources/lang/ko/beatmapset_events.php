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
    'event' => [
        'approve' => 'Approved.', // 공인됨
        'discussion_delete' => 'Moderator가 :discussion 토론을 삭제했습니다.',
        'discussion_post_delete' => 'Moderator가 :discussion 토론에 달린 글을 삭제했습니다.',
        'discussion_post_restore' => 'Moderator가 :discussion 토론에서 삭제된 글을 복원했습니다.',
        'discussion_restore' => 'Moderator가 삭제된 :discussion 토론을 복원했습니다.',
        'disqualify' => '실격 처리되었습니다. 사유: :text.', // Disqualified
        'issue_reopen' => '결정되었던 :discussion 토론이 재개되었습니다.', // Resolved issue :discussion reopened.
        'issue_resolve' => ':discussion 토론이 결정된 것으로 표시되었습니다.', // Issue :discussion marked as resolved.
        'kudosu_allow' => ':discussion 토론에서의 kudous 거부를 취소했습니다.', // Kudosu denial for discussion :discussion has been removed
        'kudosu_deny' => ':discussion 토론에서 kudosu를 거부당했습니다.', // Discussion :discussion denied for kudosu
        'kudosu_gain' => ':discussion 토론에서 kudosu를 받을 만큼 충분한 표를 얻었습니다.', // Discussion :discussion obtained enough votes for kudosu
        'kudosu_lost' => ':discussion 토론에서 충분한 표를 얻지 못해 획득한 kudous가 삭제되었습니다.', // (삭제 -> 반환? 검토 필요) Discussion :discussion lost votes and granted kudosu has been removed.
        'nominate' => 'Nominated.',
        'qualify' => 'Qualified.',
        'rank' => 'Ranked.',
    ],
];
