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
    'event' => [
        'approve' => 'Approved.',
        'discussion_delete' => 'Moderator deleted discussion :discussion.',
        'discussion_post_delete' => 'Moderator deleted post from discussion :discussion.',
        'discussion_post_restore' => 'Moderator restored post from discussion :discussion.',
        'discussion_restore' => 'Moderator restored discussion :discussion.',
        'disqualify' => 'Disqualified by :user. Reason: :discussion (:text).',
        'disqualify_legacy' => 'Disqualified by :user. Reason: :text.',
        'issue_reopen' => 'Resolved issue :discussion reopened.',
        'issue_resolve' => 'Issue :discussion marked as resolved.',
        'kudosu_allow' => 'Kudosu denial for discussion :discussion has been removed.',
        'kudosu_deny' => 'Discussion :discussion denied for kudosu.',
        'kudosu_gain' => 'Discussion :discussion by :user obtained enough votes for kudosu.',
        'kudosu_lost' => 'Discussion :discussion by :user lost votes and granted kudosu has been removed.',
        'kudosu_recalculate' => 'Discussion :discussion has had its kudosu grants recalculated.',
        'love' => 'Loved by :user',
        'nominate' => 'Nominated by :user.',
        'nomination_reset' => 'New problem :discussion (:text) triggered a nomination reset.',
        'qualify' => 'This beatmap has reached the required number of nominations and has been qualified.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => 'Beatmapset Events',

        'form' => [
            'period' => 'Period',
            'types' => 'Types',
        ],
    ],

    'item' => [
        'content' => 'Content',
        'discussion_deleted' => '[deleted]',
        'type' => 'Type',
    ],

    'type' => [
        'approve' => 'Approval',
        'discussion_delete' => 'Discussion deletion',
        'discussion_post_delete' => 'Discussion reply deletion',
        'discussion_post_restore' => 'Discussion reply restoration',
        'discussion_restore' => 'Discussion restoration',
        'disqualify' => 'Disqualification',
        'issue_reopen' => 'Discussion reopening',
        'issue_resolve' => 'Discussion resolving',
        'kudosu_allow' => 'Kudosu allowance',
        'kudosu_deny' => 'Kudosu denial',
        'kudosu_gain' => 'Kudosu gain',
        'kudosu_lost' => 'Kudosu loss',
        'kudosu_recalculate' => 'Kudosu recalculation',
        'love' => 'Love',
        'nominate' => 'Nomination',
        'nomination_reset' => 'Nomination resetting',
        'qualify' => 'Qualification',
        'rank' => 'Ranking',
    ],
];
