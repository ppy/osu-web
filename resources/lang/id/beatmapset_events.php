<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approved.',
        'beatmap_owner_change' => 'Kepemilikan atas tingkat kesulitan :beatmap dipindahtangankan kepada :new_user.',
        'discussion_delete' => 'Moderator menghapus topik diskusi :discussion.',
        'discussion_lock' => 'Diskusi pada beatmap ini telah dinonaktifkan. (:text)',
        'discussion_post_delete' => 'Moderator menghapus balasan pada topik diskusi :discussion.',
        'discussion_post_restore' => 'Moderator memulihkan balasan pada topik diskusi :discussion.',
        'discussion_restore' => 'Moderator memulihkan topik diskusi :discussion.',
        'discussion_unlock' => 'Diskusi pada beatmap ini telah kembali dibuka.',
        'disqualify' => 'Didiskualifikasi oleh :user. Alasan: :discussion (:text).',
        'disqualify_legacy' => 'Didiskualifikasi oleh :user. Alasan: :text.',
        'genre_edit' => 'Aliran beatmap diubah dari :old menjadi :new.',
        'issue_reopen' => 'Masalah :discussion yang sebelumnya telah terjawab oleh :discussion_user kembali dibuka oleh :user.',
        'issue_resolve' => 'Masalah :discussion oleh :discussion_user ditandai sebagai terjawab oleh :user.',
        'kudosu_allow' => 'Penganuliran kudosu pada topik diskusi :discussion ditarik kembali.',
        'kudosu_deny' => 'Pemberian kudosu pada topik diskusi :discussion ditolak.',
        'kudosu_gain' => ':user meraup cukup suara untuk memperoleh kudosu dari topik diskusi :discussion.',
        'kudosu_lost' => ':user kehilangan suara dari topik diskusi :discussion dan kudosu yang sebelumnya diberikan telah dianulir.',
        'kudosu_recalculate' => 'Perolehan kudosu pada topik diskusi :discussion telah dihitung ulang.',
        'language_edit' => 'Bahasa beatmap diubah dari :old menjadi :new.',
        'love' => 'Di-love oleh :user',
        'nominate' => 'Dinominasikan oleh :user.',
        'nominate_modes' => 'Dinominasikan oleh :user (:modes).',
        'nomination_reset' => 'Masalah baru pada topik diskusi :discussion (:text) memicu penganuliran nominasi.',
        'nomination_reset_received' => 'Nominasi yang sebelumnya diberikan oleh :user dianulir oleh :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominasi dianulir oleh :user (:text)',
        'offset_edit' => 'Offset online diubah dari :old menjadi :new.',
        'qualify' => 'Beatmap memperoleh jumlah nominasi yang dibutuhkan untuk menyandang status Qualified.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Dilepas dari Loved oleh :user. (:text)',
        'tags_edit' => 'Tag beatmap diubah dari ":old:" menjadi ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Tanda eksplisit dilepas',
            'to_1' => 'Ditandai eksplisit',
        ],
    ],

    'index' => [
        'title' => 'Peristiwa Beatmapset',

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
        'approve' => 'Pemberian status Approved',
        'beatmap_owner_change' => 'Perubahan kepemilikan tingkat kesulitan',
        'discussion_delete' => 'Penghapusan topik diskusi',
        'discussion_post_delete' => 'Penghapusan pesan balasan',
        'discussion_post_restore' => 'Pemulihan pesan balasan',
        'discussion_restore' => 'Pemulihan topik diskusi',
        'disqualify' => 'Diskualifikasi',
        'genre_edit' => 'Penyuntingan aliran',
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
        'offset_edit' => 'Sunting offset',
        'qualify' => 'Kualifikasi',
        'rank' => 'Pemberian status Ranked',
        'remove_from_loved' => 'Pelepasan status Loved',
    ],
];
