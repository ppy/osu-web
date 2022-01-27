<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approved.',
        'beatmap_owner_change' => 'Kepemilikan atas tingkat kesulitan :beatmap telah dipindahtangankan kepada :new_user.',
        'discussion_delete' => 'Moderator menghapus topik diskusi :discussion.',
        'discussion_lock' => 'Laman diskusi pada beatmap ini telah dikunci. (:text)',
        'discussion_post_delete' => 'Moderator telah menghapus balasan pada topik diskusi :discussion.',
        'discussion_post_restore' => 'Moderator telah mengembalikan balasan pada topik diskusi :discussion.',
        'discussion_restore' => 'Moderator mengembalikan topik diskusi :discussion.',
        'discussion_unlock' => 'Laman diskusi pada beatmap ini telah kembali dibuka.',
        'disqualify' => 'Didiskualifikasi oleh :user. Alasan: :discussion (:text).',
        'disqualify_legacy' => 'Didiskualifikasi oleh :user. Alasan: :text.',
        'genre_edit' => 'Aliran beatmap diubah dari :old menjadi :new.',
        'issue_reopen' => 'Masalah :discussion yang sebelumnya telah terjawab oleh :discussion_user kembali dibuka oleh :user.',
        'issue_resolve' => 'Masalah :discussion oleh :discussion_user telah ditandai sebagai terjawab oleh :user.',
        'kudosu_allow' => 'Penganuliran kudosu pada topik diskusi :discussion telah ditarik kembali.',
        'kudosu_deny' => 'Pemberian kudosu pada topik diskusi :discussion ditolak.',
        'kudosu_gain' => ':user telah meraup cukup suara untuk dapat memperoleh kudosu dari topik diskusi :discussion.',
        'kudosu_lost' => ':user telah kehilangan suara dari topik diskusi :discussion dan kudosu yang sebelumnya diberikan telah dianulir.',
        'kudosu_recalculate' => 'Perolehan kudosu untuk topik diskusi :discussion telah dihitung ulang.',
        'language_edit' => 'Bahasa beatmap diubah dari :old menjadi :new.',
        'love' => 'Di-love oleh :user',
        'nominate' => 'Dinominasikan oleh :user.',
        'nominate_modes' => 'Dinominasikan oleh :user (:modes).',
        'nomination_reset' => 'Masalah baru yang diutarakan pada topik diskusi :discussion (:text) telah memicu penganuliran nominasi.',
        'nomination_reset_received' => 'Nominasi yang sebelumnya diberikan oleh :user telah dianulir oleh :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominasi dianulir oleh :user (:text)',
        'qualify' => 'Beatmap ini telah memperoleh jumlah nominasi yang dibutuhkan untuk dapat menyandang status Qualified.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Dilepas dari Loved oleh :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Tanda eksplisit telah dilepas',
            'to_1' => 'Ditandai eksplisit',
        ],
    ],

    'index' => [
        'title' => 'Laman Peristiwa Beatmapset',

        'form' => [
            'period' => 'Rentang Waktu',
            'types' => 'Jenis',
        ],
    ],

    'item' => [
        'content' => 'Isi',
        'discussion_deleted' => '[dihapus]',
        'type' => 'Jenis',
    ],

    'type' => [
        'approve' => 'Persetujuan',
        'beatmap_owner_change' => 'Pergantian kepemilikan tingkat kesulitan',
        'discussion_delete' => 'Penghapusan topik diskusi',
        'discussion_post_delete' => 'Penghapusan pesan balasan',
        'discussion_post_restore' => 'Pemulihan pesan balasan',
        'discussion_restore' => 'Pemulihan topik diskusi',
        'disqualify' => 'Diskualifikasi',
        'genre_edit' => 'Pengaturan aliran',
        'issue_reopen' => 'Pembukaan ulang topik diskusi',
        'issue_resolve' => 'Penutupan topik diskusi',
        'kudosu_allow' => 'Pemberian izin kudosu',
        'kudosu_deny' => 'Penganuliran kudosu',
        'kudosu_gain' => 'Perolehan kudosu',
        'kudosu_lost' => 'Pelepasan kudosu',
        'kudosu_recalculate' => 'Perhitungan ulang kudosu',
        'language_edit' => 'Pengaturan bahasa',
        'love' => 'Pemberian status Loved',
        'nominate' => 'Nominasi',
        'nomination_reset' => 'Penganuliran nominasi',
        'nomination_reset_received' => 'Penganuliran nominasi yang diterima',
        'nsfw_toggle' => 'Pengaturan tanda eksplisit',
        'qualify' => 'Kualifikasi',
        'rank' => 'Pemberian status Ranked',
        'remove_from_loved' => 'Pelepasan status Loved',
    ],
];
