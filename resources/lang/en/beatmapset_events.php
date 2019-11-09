<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'event' => [
        'approve' => 'Approved.',
        'discussion_delete' => 'Moderator deleted discussion :discussion.',
        'discussion_lock' => 'Discussion for this beatmap has been disabled. (:text)',
        'discussion_post_delete' => 'Moderator deleted post from discussion :discussion.',
        'discussion_post_restore' => 'Moderator restored post from discussion :discussion.',
        'discussion_restore' => 'Moderator restored discussion :discussion.',
        'discussion_unlock' => 'Discussion for this beatmap has been enabled.',
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
