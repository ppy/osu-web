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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Tidak dapat membatalkan pemberian hype.',
            'has_reply' => 'Tidak dapat menghapus topik diskusi yang mempunyai balasan',
        ],
        'nominate' => [
            'exhausted' => 'Anda telah mencapai batas nominasi Anda untuk hari ini, silakan coba lagi besok.',
        ],
        'resolve' => [
            'not_owner' => 'Hanya pemilik topik dan beatmap yang dapat menyelesaikan diskusi.',
        ],

        'vote' => [
            'limit_exceeded' => 'Harap tunggu sebentar sebelum memberikan lebih banyak suara.',
            'owner' => 'Anda tidak dapat memberikan suara pada topik diskusi milik Anda sendiri.',
            'wrong_beatmapset_state' => 'Hanya dapat memberikan suara pada diskusi di beatmap pending.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Post yang dihasilkan secara otomatis tidak dapat disunting.',
            'not_owner' => 'Hanya pemilik topik yang diperbolehkan untuk menyunting post.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Anda tidak memiliki akses ke kanal yang ingin Anda tuju.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Anda tidak memiliki akses ke kanal yang ingin Anda tuju.',
                    'moderated' => 'Kanal ini sedang berada dalam moderasi admin.',
                    'not_lazer' => 'Anda hanya dapat berbicara dalam #lazer saat ini.',
                ],

                'not_allowed' => 'Tidak dapat mengirim pesan saat diblokir/dibatasi/dibungkam.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Anda tidak dapat mengubah pilihan Anda setelah periode pemungutan suara untuk kontes ini telah berakhir.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Hanya postingan terakhir yang dapat dihapus.',
                'locked' => 'Tidak dapat menghapus postingan di topik yang telah dikunci.',
                'no_forum_access' => 'Anda tidak memiliki akses ke forum yang ingin Anda tuju.',
                'not_owner' => 'Hanya pemilik topik yang dapat menghapus posting.',
            ],

            'edit' => [
                'deleted' => 'Tidak bisa menyunting postingan yang telah dihapus',
                'locked' => 'Topik telah dikunci, sehingga penyuntingan post tidak lagi dapat dilakukan.',
                'no_forum_access' => 'Anda tidak memiliki akses ke forum yang ingin Anda tuju.',
                'not_owner' => 'Hanya pemilik topik yang dapat menyunting post.',
                'topic_locked' => 'Tidak dapat menyunting postingan di topik yang telah dikunci.',
            ],

            'store' => [
                'play_more' => 'Anda harus memainkan beberapa beatmap dahulu sebelum Anda dapat memposting di forum! Jika Anda memiliki permasalahan yang terkait dengan permainan, silakan untuk langsung menuju forum Help & Support.',
                'too_many_help_posts' => 'Anda harus memainkan lebih banyak beatmap sebelum Anda dapat membuat postingan tambahan. Jika Anda masih membutuhkan bantuan lebih lanjut, silakan untuk mengirimkan email ke support@ppy.sh', // FIXME: alamat email unhardcode
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Anda baru saja memposting. Tunggu sebentar atau sunting posting terakhir Anda.',
                'locked' => 'Tidak bisa membalas di topik yang telah dikunci.',
                'no_forum_access' => 'Anda tidak memiliki akses ke forum yang ingin Anda tuju.',
                'no_permission' => 'Tidak memiliki izin untuk membalas.',

                'user' => [
                    'require_login' => 'Silakan masuk untuk membalas.',
                    'restricted' => 'Tidak dapat membalas saat dibatasi.',
                    'silenced' => 'Tidak dapat membalas saat dibungkam.',
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
                'voted' => 'Mengubah suara tidak diizinkan.',

                'user' => [
                    'require_login' => 'Silakan masuk untuk memilih.',
                    'restricted' => 'Tidak dapat memilih saat dibatasi.',
                    'silenced' => 'Tidak dapat memilih saat dibungkam.',
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
        ],

        'view' => [
            'admin_only' => 'Hanya admin yang dapat melihat forum ini.',
        ],
    ],

    'require_login' => 'Silakan masuk untuk melanjutkan.',

    'unauthorized' => 'Akses ditolak.',

    'silenced' => 'Tidak dapat melakukan hal itu saat dibungkam.',

    'restricted' => 'Tidak dapat melakukan hal itu saat dibatasi.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Halaman pengguna terkunci.',
                'not_owner' => 'Hanya dapat menyunting halaman pengguna sendiri.',
                'require_supporter_tag' => 'Supporter tag diperlukan.',
            ],
        ],
    ],
];
