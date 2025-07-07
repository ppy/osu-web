<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Lulus.',
        'beatmap_owner_change' => 'Pemilik kesukaran :beatmap diubah ke :new_user.',
        'discussion_delete' => 'Moderator telah memadam perbincangan.',
        'discussion_lock' => 'Perbincangan untuk peta rentak ini dilumpuhkan. (:text)',
        'discussion_post_delete' => 'Moderator telah memadam hantaran dari perbicangan :discussion.',
        'discussion_post_restore' => 'Moderator telah memulihkan hantaran dari perbincangan :discussion.',
        'discussion_restore' => 'Moderator telah memulihkan perbincangan :discussion.',
        'discussion_unlock' => 'Perbincangan untuk peta rentak ini telah diupayakan.',
        'disqualify' => 'Disingkirkan oleh :user. Sebab: :discussion (:text).',
        'disqualify_legacy' => 'Disingkirkan oleh :user. Sebab: :text.',
        'genre_edit' => 'Genre diubah dari :old ke :new.',
        'issue_reopen' => 'Isu yang diselesaikan :discussion oleh :discussion_user dibuka semula oleh :user.',
        'issue_resolve' => 'Isu :discussion oleh :discussion_user ditanda selesai oleh :user.',
        'kudosu_allow' => 'Penolakan kudosu bagi perbincangan :discussion telah dipadam.',
        'kudosu_deny' => 'Kudosu ditolak bagi perbincangan :discussion.',
        'kudosu_gain' => 'Perbincangan :discussion oleh :user telah memperoleh undian yang mencukupi untuk kudosu.',
        'kudosu_lost' => 'Perbincangan :discussion oleh :user telah kehilangan undian dan pemberian kudosu telah dipadam.',
        'kudosu_recalculate' => 'Pemberian kudosu bagi perbincangan :discussion telah dikira semula.',
        'language_edit' => 'Bahasa diubah dari :old ke :new.',
        'love' => 'Digemari oleh :user.',
        'nominate' => 'Dicalonkan oleh :user.',
        'nominate_modes' => 'Dicalonkan oleh :user (:modes).',
        'nomination_reset' => 'Masalah baharu :discussion (:text) mencetuskan penetapan semula pencalonan.',
        'nomination_reset_received' => 'Pencalonan oleh :user ditetap semula oleh :source_user (:text)',
        'nomination_reset_received_profile' => 'Pencalonan ditetap semula oleh :user (:text)',
        'offset_edit' => 'Imbangan dalam talian diubah dari :old ke :new.',
        'qualify' => 'Peta rentak ini telah mencapai jumlah pencalonan yang diperlukan dan telah dilayakkan.',
        'rank' => 'Berpangkat.',
        'remove_from_loved' => 'Dipadam dari Kegemaran oleh :user. (:text)',
        'tags_edit' => 'Tag diubah dari ":old" ke ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Tanda tidak senonoh dipadam',
            'to_1' => 'Ditanda selaku tidak senonoh',
        ],
    ],

    'index' => [
        'title' => 'Peristiwa Peranggu Peta Rentak',

        'form' => [
            'period' => 'Tempoh',
            'types' => 'Jenis',
        ],
    ],

    'item' => [
        'content' => 'Kandungan',
        'discussion_deleted' => '[dipadam]',
        'type' => 'Jenis',
    ],

    'type' => [
        'approve' => 'Kelulusan',
        'beatmap_owner_change' => 'Perubahan pemilik kesukaran',
        'discussion_delete' => 'Pemadaman perbincangan',
        'discussion_post_delete' => 'Pemadaman balasan perbincangan',
        'discussion_post_restore' => 'Pemulihan balasan perbincangan',
        'discussion_restore' => 'Pemulihan perbincangan',
        'disqualify' => 'Penyingkiran',
        'genre_edit' => 'Sunting genre',
        'issue_reopen' => 'Pembukaan semula perbincangan',
        'issue_resolve' => 'Penyelesaian perbincangan',
        'kudosu_allow' => 'Kebenaran kudosu',
        'kudosu_deny' => 'Penolakan kudosu',
        'kudosu_gain' => 'Pemerolehan kudosu',
        'kudosu_lost' => 'Kehilangan kudosu',
        'kudosu_recalculate' => 'Pengiraan semula kudosu',
        'language_edit' => 'Penyuntingan bahasa',
        'love' => 'Gemar',
        'nominate' => 'Pencalonan',
        'nomination_reset' => 'Penetapan semula pencalonan',
        'nomination_reset_received' => 'Penetapan semula pencalonan diterima',
        'nsfw_toggle' => 'Tanda tidak senonoh',
        'offset_edit' => 'Sunting imbangan',
        'qualify' => 'Kelayakan',
        'rank' => 'Pangkat',
        'remove_from_loved' => 'Pemadaman Kegemaran',
    ],
];
