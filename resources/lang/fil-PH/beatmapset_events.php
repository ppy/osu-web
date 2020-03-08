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
        'approve' => 'Inaprobahan.',
        'discussion_delete' => 'Tinanggal ng moderator ang talakayan :discussion.',
        'discussion_lock' => 'Ang talakayan para sa beatmap na ito ay isinara na. (:text)',
        'discussion_post_delete' => 'Tinanggal ng moderator ang post na ito mula sa talakayan :discussion.',
        'discussion_post_restore' => 'Binalik ng moderator ang post na ito mula sa talakayan :discussion.',
        'discussion_restore' => 'Binalik ng moderator ang talakayan :discussion.',
        'discussion_unlock' => 'Ang talakayan para sa beatmap na ito ay binuksan na.',
        'disqualify' => 'Diniskwalipika ni :user. Rason: :discussion (:text).',
        'disqualify_legacy' => 'Diniskwalipika ni :user. Rason: :text.',
        'issue_reopen' => 'Nalutas na isyu :discussion ay muling binuksan.',
        'issue_resolve' => 'Isyu :discussion ay minarkahang resolved.',
        'kudosu_allow' => 'Ang pagtanggi ng kudosu sa diskusyon :discussion ay tinanggal.',
        'kudosu_deny' => 'Tinaggihan ng kudosu ang diskusyon :discussion.',
        'kudosu_gain' => 'Nakakuha na ng sapat na kudosu ang diskusyon :discussion ni :user.',
        'kudosu_lost' => 'Tinaggal na ang mga boto at ibinigay na kudosu sa diskusyon :discussion ni :user.',
        'kudosu_recalculate' => 'Muling kinalkula ang mga binigay na kudosu sa diskusyon :discussion.',
        'love' => 'Minahal ni :user',
        'nominate' => 'Ininomina ni :user.',
        'nomination_reset' => 'Nag-trigger ng nomination reset ang bagong isyu :discussion (:text).',
        'qualify' => 'Ang beatmap ay umabot na ng kinakailangang bilang ng nominasyon at naging kwalipikado.',
        'rank' => 'Nakaranggo.',
    ],

    'index' => [
        'title' => 'Mga kaganapan sa Beatmapset',

        'form' => [
            'period' => 'Panahon',
            'types' => 'Mga uri',
        ],
    ],

    'item' => [
        'content' => 'Nilalaman',
        'discussion_deleted' => '[tinanggal]',
        'type' => 'Uri',
    ],

    'type' => [
        'approve' => 'Approval',
        'discussion_delete' => '',
        'discussion_post_delete' => '',
        'discussion_post_restore' => '',
        'discussion_restore' => '',
        'disqualify' => 'Diskwalipikasyon',
        'issue_reopen' => '',
        'issue_resolve' => '',
        'kudosu_allow' => '',
        'kudosu_deny' => '',
        'kudosu_gain' => '',
        'kudosu_lost' => '',
        'kudosu_recalculate' => '',
        'love' => 'Love',
        'nominate' => 'Mga Nominasyon',
        'nomination_reset' => '',
        'qualify' => 'Kwalipikasyon',
        'rank' => 'Ranking',
    ],
];
