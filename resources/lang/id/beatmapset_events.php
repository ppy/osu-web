<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approved.',
        'discussion_delete' => 'Moderator menghapus diskusi :discussion.',
        'discussion_lock' => 'Laman diskusi pada beatmap ini telah ditutup. (:text)',
        'discussion_post_delete' => 'Moderator telah menghapus kiriman dari diskusi :discussion.',
        'discussion_post_restore' => 'Moderator mengembalikan kiriman dari diskusi :discussion.',
        'discussion_restore' => 'Moderator mengembalikan diskusi :discussion.',
        'discussion_unlock' => 'Laman diskusi pada beatmap ini telah dibuka kembali.',
        'disqualify' => 'Didiskualifikasi oleh :user. Alasan: :discussion (:text).',
        'disqualify_legacy' => 'Didiskualifikasi oleh :user. Alasan: :text.',
        'genre_edit' => 'Aliran beatmap diubah dari :old menjadi :new.',
        'issue_reopen' => 'Masalah yang terselesaikan di :discussion telah dibuka kembali.',
        'issue_resolve' => 'Masalah :discussion telah ditandai sebagai selesai.',
        'kudosu_allow' => 'Status penolakan kudosu untuk :discussion telah dihapus.',
        'kudosu_deny' => 'Pemberian kudosu pada diskusi :discussion ditolak.',
        'kudosu_gain' => ':user memperoleh cukup suara untuk mendapat kudosu dari topik diskusi :discussion.',
        'kudosu_lost' => ':user kehilangan suara dari topik diskusi :discussion dan kudosu yang sebelumnya diberikan telah dianulir.',
        'kudosu_recalculate' => 'Jumlah perolehan kudosu untuk diskusi :discussion telah dihitung ulang.',
        'language_edit' => 'Bahasa beatmap diubah dari :old menjadi :new.',
        'love' => 'Di-love oleh :user',
        'nominate' => 'Dinominasikan oleh :user.',
        'nomination_reset' => 'Masalah baru di :discussion (:text) memicu pengaturan ulang nominasi.',
        'qualify' => 'Beatmap ini telah memperoleh jumlah nominasi yang cukup untuk mendapatkan status Qualified.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Dilepas dari Loved oleh :user. (:text)',
    ],

    'index' => [
        'title' => 'Laman Peristiwa Beatmapset',

        'form' => [
            'period' => 'Periode',
            'types' => 'Jenis-Jenis',
        ],
    ],

    'item' => [
        'content' => 'Isi',
        'discussion_deleted' => '[dihapus]',
        'type' => 'Jenis',
    ],

    'type' => [
        'approve' => 'Persetujuan',
        'discussion_delete' => 'Penghapusan topik diskusi',
        'discussion_post_delete' => 'Penghapusan pesan balasan pada topik diskusi',
        'discussion_post_restore' => 'Pengembalian pesan balasan yang terhapus pada topik diskusi',
        'discussion_restore' => 'Pengembalian topik diskusi yang terhapus',
        'disqualify' => 'Diskualifikasi',
        'genre_edit' => 'Pengaturan aliran',
        'issue_reopen' => 'Pembukaan ulang topik diskusi',
        'issue_resolve' => 'Penutupan topik diskusi',
        'kudosu_allow' => 'Perolehan kudosu',
        'kudosu_deny' => 'Penolakan Kudosu',
        'kudosu_gain' => 'Pendapatan kudosu',
        'kudosu_lost' => 'Penganuliran kudosu',
        'kudosu_recalculate' => 'Perhitungan ulang kudosu',
        'language_edit' => 'Pengaturan bahasa',
        'love' => 'Love',
        'nominate' => 'Nominasi',
        'nomination_reset' => 'Nominasi ulang',
        'qualify' => 'Kualifikasi',
        'rank' => 'Peringkat',
        'remove_from_loved' => 'Pelepasan status Loved',
    ],
];
