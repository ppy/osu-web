<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Mengapa kamu tidak cuba untuk bermain osu! terlebih dahulu?',
    'require_login' => 'Sila log masuk untuk meneruskan. ',
    'require_verification' => 'Sila sahkan untuk meneruskan. ',
    'restricted' => "Tidak boleh dilakukan ketika dihadkan.",
    'silenced' => "Tidak boleh dilakukan ketika dibisukan. ",
    'unauthorized' => 'Akses ditolak.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => '',
            'has_reply' => 'Tidak dapat memadam perbincangan yang mempunyai balasan',
        ],
        'nominate' => [
            'exhausted' => 'Anda telah mencapai had nominasi Anda untuk hari ini, sila coba lagi esok.',
            'incorrect_state' => 'Terjadi ralat ketika melakukan tindakan itu, cuba muat semula.',
            'owner' => "Tidak dapat menominasikan beatmap sendiri.",
            'set_metadata' => 'Anda mesti menentukan aliran dan bahasa terlebih dahulu sebelum menominasikan beatmap.',
        ],
        'resolve' => [
            'not_owner' => 'Hanya pemilik topik dan beatmap yang dapat menyelesaikan perbincangan.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Hanya pencipta beatmap atau anggota BN/NAT yang dapat menyiarkan catatan pada laman diskusi beatmap.',
        ],

        'vote' => [
            'bot' => "Tidak boleh mengundi pada perbincangan yang dibuka oleh bot",
            'limit_exceeded' => 'Tunggu seketika sebelum memberikan lebih banyak undian ',
            'owner' => "Tidak dapat mengundi perbincangan sendiri.",
            'wrong_beatmapset_state' => '',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Anda hanya boleh memadamkan post sendiri.',
            'resolved' => 'Anda tidak boleh memadamkan post perbincangan yang telah diselesaikan.',
            'system_generated' => 'Post yang dijana secara automatik tidak boleh dipadamkan.',
        ],

        'edit' => [
            'not_owner' => 'Hanya pembuat post boleh membuat pengeditan terhadap post tersebut.',
            'resolved' => 'Anda tidak boleh edit post perbincangan yang telah diselesaikan.',
            'system_generated' => 'Post yang dijana secara automatik tidak boleh dieditkan.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Beatmap ini dikunci bagi perbincangan.',

        'metadata' => [
            'nominated' => '',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => '',
        ],
    ],

    'chat' => [
        'blocked' => 'Tidak boleh mesej pengguna yang telah menyekat anda atau yang anda sekat.',
        'friends_only' => 'Pengguna menyekat pesanan dari orang yang tiada dalam senarai kawan.',
        'moderated' => 'Saluran ini sedang diawas.',
        'no_access' => 'Anda tiada kebenaran untuk mengakses saluran itu.',
        'no_announce' => 'Anda tidak mempunyai kebenaran untuk post pengumuman.',
        'receive_friends_only' => 'Pengguna ini mungkin tidak boleh membalas kerana anda hanya menerima pesanan dari orang dalam senarai kawan anda.',
        'restricted' => 'Anda tidak boleh menghantar pesanan ketika didiamkan, disekat atau dilarang.',
        'silenced' => 'Anda tidak boleh menghantar pesanan ketika didiamkan, disekat atau dilarang.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Ruangan komen ditutup',
        ],
        'update' => [
            'deleted' => "Ruangan komen ditutup",
        ],
    ],

    'contest' => [
        'judging_not_active' => '',
        'voting_over' => 'Anda tidak boleh tukar undian selepas tempoh mengundi untuk pertandingan ini telah tamat.',

        'entry' => [
            'limit_reached' => 'Anda telah mencapai had kemasukan untuk pertandingan ini',
            'over' => '',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Tiada kebenaran untuk mengawas forum ini.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Hanya hantaran terakhir boleh dipadam.',
                'locked' => 'Tidak boleh padam hantaran bagi topik yang dikunci.',
                'no_forum_access' => 'Akses kepada forum yang dimohon diperlukan.',
                'not_owner' => 'Hanya penghantar boleh memadam hantaran ini.',
            ],

            'edit' => [
                'deleted' => 'Tidak boleh sunting hantaran yang dipadam.',
                'locked' => 'Hantaran ini dikunci daripada disunting.',
                'no_forum_access' => 'Akses kepada forum yang dimohon diperlukan.',
                'not_owner' => 'Hanya penghantar boleh memadam hantaran ini.',
                'topic_locked' => 'Tidak boleh mengedit post topik yang dikunci.',
            ],

            'store' => [
                'play_more' => 'Sila main game dulu sebelum membuat post di forum! Jika anda menghadapi apa-apa masalah ketika bermain, sila post masalah tersebut di Bantuan dan Sokongan forum.',
                'too_many_help_posts' => "", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Daripada membuat post baharu, sila editkan post terakhir anda.',
                'locked' => 'Tidak boleh membalas jalur yang dikunci.',
                'no_forum_access' => 'Akses kepada forum yang dimohon diperlukan.',
                'no_permission' => 'Tiada kebenaran untuk membuat balasan.',

                'user' => [
                    'require_login' => 'Sila daftar masuk untuk membuat balasan.',
                    'restricted' => "Tidak boleh membuat balasan semasa dibatasi.",
                    'silenced' => "Tidak boleh membuat balasana semasa disenyapkan.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Akses kepada forum yang dimohon diperlukan.',
                'no_permission' => 'Tiada kebenaran untuk memulakan topik baharu.',
                'forum_closed' => '',
            ],

            'vote' => [
                'no_forum_access' => 'Akses kepada forum yang dimohon diperlukan.',
                'over' => '',
                'play_more' => '',
                'voted' => 'Pertukaran pengundian tidak dibenarkan.',

                'user' => [
                    'require_login' => 'Sila daftar masuk untuk mengundi.',
                    'restricted' => "Tidak boleh mengundi semasa dibatasi.",
                    'silenced' => "Tidak boleh mengundi semasa disenyapkan.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Akses kepada forum yang dimohon diperlukan.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '',
                'not_owner' => '',
            ],
            'store' => [
                'forum_not_allowed' => '',
            ],
        ],

        'view' => [
            'admin_only' => '',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => '',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "",
            'failed' => "",
            'not_owner' => '',
            'too_many' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '',
                'not_owner' => '',
                'require_supporter_tag' => '',
            ],
        ],
        'update_email' => [
            'locked' => 'alamat emel terkunci',
        ],
    ],
];
