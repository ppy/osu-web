<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Mengapa Anda tidak mencoba untuk bermain osu! terlebih dahulu?',
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
            'incorrect_state' => 'Terjadi kesalahan saat memproses perintah, silakan muat ulang laman.',
            'owner' => "Tidak dapat menominasikan beatmap buatan sendiri.",
            'set_metadata' => 'Anda harus terlebih dahulu mengubah pengaturan aliran dan bahasa sebelum beatmap ini dapat dinominasikan.',
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
            'not_owner' => 'Anda hanya dapat menghapus postingan milik Anda sendiri.',
            'resolved' => 'Anda tidak dapat menghapus postingan pada topik diskusi yang telah terjawab.',
            'system_generated' => 'Postingan yang dibuat otomatis tidak dapat dihapus.',
        ],

        'edit' => [
            'not_owner' => 'Hanya pemilik topik yang diperbolehkan untuk menyunting kiriman.',
            'resolved' => 'Kamu tidak dapat mengubah postingan yang sudah ditutup.',
            'system_generated' => 'Kiriman yang dihasilkan secara otomatis tidak dapat disunting.',
        ],

        'store' => [
            'beatmapset_locked' => 'Beatmap ini dikunci untuk diskusi.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Anda tidak dapat mengubah pengaturan metadata pada beatmap yang telah dinominasikan sebelumnya. Harap hubungi BN atau NAT apabila Anda merasa ada suatu hal yang perlu diubah.',
        ],
    ],

    'chat' => [
        'blocked' => 'Tidak dapat mengirim pesan kepada pengguna yang memblokir Anda atau pengguna yang Anda blokir.',
        'friends_only' => 'Pengguna memblokir pesan dari orang yang tidak ada dalam daftar teman pengguna.',
        'moderated' => 'Channel itu sedang dalam pengelolaan.',
        'no_access' => 'Anda tidak memiliki akses ke channel ini.',
        'restricted' => 'Anda tidak dapat mengirim pesan saat akun Anda sedang di-silence, di-restrict, atau di-ban.',
        'silenced' => '',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Tidak dapat menyunting post yang telah dihapus.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Anda tidak dapat mengubah pilihan Anda setelah periode pemungutan suara untuk kontes ini telah berakhir.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Tidak memiliki izin untuk mengelola forum ini.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Hanya kiriman terakhir yang dapat dihapus.',
                'locked' => 'Tidak dapat menghapus kiriman di topik yang telah dikunci.',
                'no_forum_access' => 'Anda tidak memiliki akses ke forum yang ingin Anda tuju.',
                'not_owner' => 'Hanya pemilik topik yang dapat menghapus kiriman.',
            ],

            'edit' => [
                'deleted' => 'Tidak dapat menyunting kiriman yang telah dihapus.',
                'locked' => 'Topik telah dikunci, sehingga penyuntingan kiriman tidak lagi dapat dilakukan.',
                'no_forum_access' => 'Anda tidak memiliki akses ke forum yang ingin Anda tuju.',
                'not_owner' => 'Hanya pemilik topik yang dapat menyunting kiriman.',
                'topic_locked' => 'Tidak dapat menyunting kiriman di topik yang telah dikunci.',
            ],

            'store' => [
                'play_more' => 'Anda harus memainkan beberapa beatmap dahulu sebelum Anda dapat memposting di forum! Jika Anda memiliki permasalahan yang terkait dengan permainan, silakan kunjungi forum Help & Support.',
                'too_many_help_posts' => "Anda harus memainkan lebih banyak beatmap sebelum Anda dapat membuat postingan tambahan. Jika Anda masih membutuhkan bantuan lebih lanjut, silakan mengirimkan email ke support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Mohon sunting postingan terakhir Anda ketimbang memposting kembali.',
                'locked' => 'Tidak dapat mengirimkan balasan pada topik yang telah dikunci.',
                'no_forum_access' => 'Anda tidak memiliki akses ke forum yang ingin Anda tuju.',
                'no_permission' => 'Tidak memiliki izin untuk membalas.',

                'user' => [
                    'require_login' => 'Silakan masuk untuk membalas.',
                    'restricted' => "Anda tidak dapat mengirimkan balasan ketika akun Anda sedang di-restrict.",
                    'silenced' => "Anda tidak dapat mengirimkan balasan ketika akun Anda sedang di-silence.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Anda tidak memiliki akses ke forum yang ingin Anda tuju.',
                'no_permission' => 'Tidak memiliki izin untuk membuat topik baru.',
                'forum_closed' => 'Forum ditutup sehingga tidak dapat membuat postingan.',
            ],

            'vote' => [
                'no_forum_access' => 'Akses ke forum yang diminta diperlukan.',
                'over' => 'Polling selesai dan tidak dapat dipilih lagi.',
                'play_more' => 'Anda harus bermain lebih banyak untuk dapat memberikan suara pada forum.',
                'voted' => 'Pengubahan suara tidak diizinkan.',

                'user' => [
                    'require_login' => 'Silakan masuk untuk memberikan suara.',
                    'restricted' => "Anda tidak dapat memberikan suara ketika akun Anda sedang di-restrict.",
                    'silenced' => "Tidak dapat memberikan suara saat di-silence.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Anda tidak memiliki akses ke forum yang ingin Anda tuju.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Gambar sampul yang Anda ingin terapkan tidak valid.',
                'not_owner' => 'Hanya pemilik topik yang dapat menyunting sampul.',
            ],
            'store' => [
                'forum_not_allowed' => 'Forum ini tidak dapat dipasang sampul topik.',
            ],
        ],

        'view' => [
            'admin_only' => 'Hanya admin yang dapat melihat forum ini.',
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
