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
        'approve' => 'Approved.',
        'discussion_delete' => 'Moderator deleted discussion :discussion.',
        'discussion_post_delete' => 'Moderator deleted post from discussion :discussion.',
        'discussion_post_restore' => 'Moderator restored post from discussion :discussion.',
        'discussion_restore' => 'Moderator restored discussion :discussion.',
        'disqualify' => 'Disqualified by :user. Reason: :text.',
        'issue_reopen' => 'Resolved issue :discussion reopened.',
        'issue_resolve' => 'Issue :discussion marked as resolved.',
        'kudosu_allow' => 'Kudosu denial for discussion :discussion has been removed.',
        'kudosu_deny' => 'Discussion :discussion denied for kudosu.',
        'kudosu_gain' => 'Discussion :discussion by :user obtained enough votes for kudosu.',
        'kudosu_lost' => 'Discussion :discussion by :user lost votes and granted kudosu has been removed.',
        'kudosu_recalculate' => 'Discussion :discussion has had its kudosu grants recalculated.',
        'nominate' => 'Nominated by :user.',
        'nomination_reset' => 'New problem :discussion triggered a nomination reset.',
        'qualify' => 'Qualified.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => 'Beatmapset Events',
    ],

    'item' => [
        'content' => 'Content',
        'type' => 'Type',
    ],
];
