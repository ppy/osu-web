<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Mengapa kamu tidak mencoba untuk bermain terlebih dahulu?',
    'require_login' => 'Silakan masuk untuk melanjutkan.',
    'require_verification' => 'Silakan verifikasi untuk melanjutkan.',
    'restricted' => "Tidak dapat melakukan hal itu saat dibatasi.",
    'silenced' => "Tidak dapat melakukan hal itu saat dibungkam.",
    'unauthorized' => 'Akses ditolak.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Tidak dapat membatalkan pemberian hype.',
            'has_reply' => 'Tidak dapat menghapus topik diskusi yang mempunyai balasan',
        ],
        'nominate' => [
            'exhausted' => 'Anda telah mencapai batas nominasi Anda untuk hari ini, silakan coba lagi besok.',
            'incorrect_state' => 'Terjadi kesalahan pada saat melangsungkan tindakan. Silakan muat ulang laman.',
            'owner' => "Tidak dapat menominasikan beatmap buatan sendiri.",
            'set_metadata' => 'Kamu harus terlebih dahulu menentukan aliran dan bahasa sebelum menominasikan beatmap.',
        ],
        'resolve' => [
            'not_owner' => 'Hanya pemilik topik dan beatmap yang dapat menyelesaikan diskusi.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Hanya pembuat beatmap atau anggota BN/NAT yang dapat membubuhkan catatan pada laman diskusi beatmap.',
        ],

        'vote' => [
            'bot' => "Tidak dapat memberikan suara pada topik diskusi yang dibuka oleh bot",
            'limit_exceeded' => 'Harap tunggu sebentar sebelum memberikan lebih banyak suara.',
            'owner' => "Tidak dapat memberikan suara pada topik diskusi sendiri.",
            'wrong_beatmapset_state' => 'Hanya dapat memberikan suara pada diskusi di beatmap pending.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Kamu hanya dapat menghapus postingan milik diri sendiri.',
            'resolved' => 'Kamu tidak dapat menghapus postingan pada topik diskusi yang telah ditandai terjawab.',
            'system_generated' => 'Postingan yang dibuat otomatis tidak dapat dihapus.',
        ],

        'edit' => [
            'not_owner' => 'Hanya pemilik topik yang diperbolehkan untuk menyunting kiriman.',
            'resolved' => 'Kamu tidak dapat menyunting postingan pada topik diskusi yang telah terjawab.',
            'system_generated' => 'Post yang dihasilkan secara otomatis tidak dapat disunting.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Diskusi pada beatmap ini telah dikunci.',

        'metadata' => [
            'nominated' => 'Kamu tidak dapat mengubah pengaturan metadata pada beatmap yang telah dinominasikan. Harap hubungi BN atau NAT apabila kamu merasa ada suatu hal yang perlu diubah.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Kanal ini hanya dikhususkan untuk pengumuman.',
        'blocked' => 'Pesan tidak dapat dikirim kepada pengguna yang kamu blokir atau memblokir dirimu.',
        'friends_only' => 'Pengguna memblokir pesan dari orang yang tidak dalam daftar temannya.',
        'moderated' => 'Kanal percakapan ini sedang dimoderasi.',
        'no_access' => 'Anda tidak memiliki akses ke kanal percakapan ini.',
        'receive_friends_only' => 'Pengguna ini tidak akan dapat membalas pesanmu karena kamu hanya menerima pesan dari nama-nama yang tertera pada daftar temanmu.',
        'restricted' => 'Kamu tidak dapat mengirim pesan pada saat akunmu sedang di-silence, di-restrict, atau di-ban.',
        'silenced' => 'Kamu tidak dapat mengirim pesan pada saat akunmu sedang di-silence, di-restrict, atau di-ban.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Komentar dinonaktifkan',
        ],
        'update' => [
            'deleted' => "Tidak dapat menyunting post yang telah dihapus.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Anda tidak dapat mengubah pilihan Anda setelah periode pemungutan suara untuk kontes ini telah berakhir.',

        'entry' => [
            'limit_reached' => 'Kamu telah mencapai batas entri untuk kontes ini',
            'over' => 'Terima kasih telah mengirimkan entrimu! Submisi untuk kontes ini telah ditutup dan pemungutan suara akan segera berlangsung.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Tidak memiliki izin untuk mengelola forum ini.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Hanya kiriman terakhir yang dapat dihapus.',
                'locked' => 'Tidak dapat menghapus kiriman di topik yang telah dikunci.',
                'no_forum_access' => 'Kamu tidak memiliki akses ke forum yang dituju.',
                'not_owner' => 'Hanya pemilik topik yang dapat menghapus kiriman.',
            ],

            'edit' => [
                'deleted' => 'Tidak dapat menyunting postingan yang telah dihapus.',
                'locked' => 'Topik telah dikunci, sehingga penyuntingan kiriman tidak lagi dapat dilakukan.',
                'no_forum_access' => 'Kamu tidak memiliki akses ke forum yang dituju.',
                'not_owner' => 'Hanya pemilik topik yang dapat menyunting kiriman.',
                'topic_locked' => 'Tidak dapat menyunting kiriman di topik yang telah dikunci.',
            ],

            'store' => [
                'play_more' => 'Kamu harus terlebih dahulu bermain sebelum kamu dapat membuat postingan pada forum! Apabila kamu mengalami masalah saat bermain, silakan kunjungi forum Help & Support.',
                'too_many_help_posts' => "Kamu harus lebih banyak bermain sebelum kamu dapat membuat postingan tambahan. Apabila kamu masih memerlukan bantuan lebih lanjut, silakan kirim email ke support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Mohon sunting postingan terakhirmu alih-alih membuat postingan baru.',
                'locked' => 'Tidak dapat mengirimkan balasan pada topik yang telah dikunci.',
                'no_forum_access' => 'Kamu tidak memiliki akses ke forum yang dituju.',
                'no_permission' => 'Tidak memiliki izin untuk membalas.',

                'user' => [
                    'require_login' => 'Silakan masuk untuk membalas.',
                    'restricted' => "Kamu tidak dapat mengirimkan balasan ketika akunmu sedang di-restrict.",
                    'silenced' => "Kamu tidak dapat mengirimkan balasan ketika akunmu sedang di-silence.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Kamu tidak memiliki akses ke forum yang dituju.',
                'no_permission' => 'Tidak memiliki izin untuk membuat topik baru.',
                'forum_closed' => 'Forum ditutup sehingga tidak dapat membuat postingan.',
            ],

            'vote' => [
                'no_forum_access' => 'Kamu tidak memiliki akses ke forum yang dituju.',
                'over' => 'Polling selesai dan tidak dapat dipilih lagi.',
                'play_more' => 'Kamu harus lebih banyak bermain sebelum kamu dapat memberikan suara pada forum.',
                'voted' => 'Pengubahan suara tidak diizinkan.',

                'user' => [
                    'require_login' => 'Silakan masuk untuk memberikan suara.',
                    'restricted' => "Kamu tidak dapat memberikan suara ketika akunmu sedang di-restrict.",
                    'silenced' => "Tidak dapat memberikan suara saat di-silence.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Kamu tidak memiliki akses ke forum yang dituju.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Gambar sampul yang Anda ingin terapkan tidak valid.',
                'not_owner' => 'Hanya pemilik topik yang dapat menyunting sampul.',
            ],
            'store' => [
                'forum_not_allowed' => 'Gambar sampul tidak dapat dipasang pada forum ini.',
            ],
        ],

        'view' => [
            'admin_only' => 'Hanya admin yang dapat melihat forum ini.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Hanya pemilik skor yang dapat menyematkan skor.',
            'too_many' => 'Skor yang disematkan sudah terlalu banyak.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Laman pengguna terkunci.',
                'not_owner' => 'Hanya dapat menyunting laman pengguna sendiri.',
                'require_supporter_tag' => 'osu!supporter tag diperlukan.',
            ],
        ],
    ],
];
