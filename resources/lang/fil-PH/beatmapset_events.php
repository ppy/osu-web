<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Inaprobahan.',
        'beatmap_owner_change' => 'Pagmamay-ari ng beatmap :beatmap ay inilipat kay :new_user.',
        'discussion_delete' => 'Tinanggal ng moderator ang talakayan :discussion.',
        'discussion_lock' => 'Ang talakayan para sa beatmap na ito ay isinara na. (:text)',
        'discussion_post_delete' => 'Tinanggal ng moderator ang post na ito mula sa talakayan :discussion.',
        'discussion_post_restore' => 'Binalik ng moderator ang post na ito mula sa talakayan :discussion.',
        'discussion_restore' => 'Binalik ng moderator ang talakayan :discussion.',
        'discussion_unlock' => 'Ang talakayan para sa beatmap na ito ay binuksan na.',
        'disqualify' => 'Diniskwalipika ni :user. Rason: :discussion (:text).',
        'disqualify_legacy' => 'Diniskwalipika ni :user. Rason: :text.',
        'genre_edit' => 'Binago ang genre sa :new.mula :old.',
        'issue_reopen' => 'Nalutas na isyu :discussion ay muling binuksan.',
        'issue_resolve' => 'Isyu :discussion ay minarkahang resolved.',
        'kudosu_allow' => 'Ang pagtanggi ng kudosu sa diskusyon :discussion ay tinanggal.',
        'kudosu_deny' => 'Tinaggihan ng kudosu ang diskusyon :discussion.',
        'kudosu_gain' => 'Nakakuha na ng sapat na kudosu ang diskusyon :discussion ni :user.',
        'kudosu_lost' => 'Tinaggal na ang mga boto at ibinigay na kudosu sa diskusyon :discussion ni :user.',
        'kudosu_recalculate' => 'Muling kinalkula ang mga binigay na kudosu sa diskusyon :discussion.',
        'language_edit' => 'Binago ang wika sa :new.mula :old.',
        'love' => 'Minahal ni :user',
        'nominate' => 'Ininomina ni :user.',
        'nominate_modes' => 'Ininomina ni :user (:modes).',
        'nomination_reset' => 'Nag-trigger ng nomination reset ang bagong isyu :discussion (:text).',
        'nomination_reset_received' => 'Ang nominasyon ni :user ay ni-reset ni :source_user (:text)',
        'nomination_reset_received_profile' => 'Ang nominasyon ay ni-reset ni :user (:text)',
        'qualify' => 'Ang beatmap ay umabot na ng kinakailangang bilang ng nominasyon at naging kwalipikado.',
        'rank' => 'Nakaranggo.',
        'remove_from_loved' => 'Tinanggal sa Loved ni :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Tinanggal ang markang maselan',
            'to_1' => 'Minarkahang maselan',
        ],
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
        'beatmap_owner_change' => 'Pagpapalit ng may-ari ng difficulty',
        'discussion_delete' => 'Pagbura ng diskusyon',
        'discussion_post_delete' => 'Pagbura ng tugon sa diskusyon',
        'discussion_post_restore' => 'Pagbalik ng tugon sa diskusyon',
        'discussion_restore' => 'Pagbalik ng diskusyon',
        'disqualify' => 'Diskwalipikasyon',
        'genre_edit' => 'Pag-edit ng genre',
        'issue_reopen' => 'Muling pagbubukas ng diskusyon',
        'issue_resolve' => 'Pagresolba ng diskusyon',
        'kudosu_allow' => 'Pagbibigay ng kudosu',
        'kudosu_deny' => 'Hindi pagbigay ng kudosu',
        'kudosu_gain' => 'Nakakuha ng kudosu',
        'kudosu_lost' => 'Nawalan ng kudosu',
        'kudosu_recalculate' => 'Muling pagkuwenta ng kudosu',
        'language_edit' => 'Pag-edit ng wika',
        'love' => 'Love',
        'nominate' => 'Mga Nominasyon',
        'nomination_reset' => 'Pag-reset ng nominasyon',
        'nomination_reset_received' => 'Ang nominasyon reset ay nakuha',
        'nsfw_toggle' => 'Markang maselan',
        'qualify' => 'Kwalipikasyon',
        'rank' => 'Ranking',
        'remove_from_loved' => 'Pagtanggal sa Loved',
    ],
];
