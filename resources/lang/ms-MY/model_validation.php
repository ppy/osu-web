<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute tidak sah ditentukan.',
    'not_negative' => ':attribute tidak boleh bernilai negatif.',
    'required' => ':attribute diperlukan.',
    'too_long' => ':attribute melebihi panjang maksimum iaitu :limit aksara sahaja.',
    'url' => 'Sila masukkan URL yang sah.',
    'wrong_confirmation' => 'Pengesahan tidak sepadan.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Cap masa ditentukan tetapi kesukaran peta rentak tiada.',
        'beatmapset_no_hype' => "Peta rentak tidak boleh digembarkan.",
        'hype_requires_null_beatmap' => 'Gembaran mesti dibuat pada bahagian Umum (semua kesukaran).',
        'invalid_beatmap_id' => 'Kesukaran tidak sah ditentukan.',
        'invalid_beatmapset_id' => 'Peta rentak tidak sah ditentukan.',
        'locked' => 'Perbincangan dikunci.',

        'attributes' => [
            'message_type' => 'Jenis pesanan',
            'timestamp' => 'Cap masa',
        ],

        'hype' => [
            'discussion_locked' => "Peta rentak ini kini dikunci dari perbincangan dan tidak boleh digembarkan.",
            'guest' => 'Daftar masuk untuk gembarkan.',
            'hyped' => 'Anda telah menggembarkan peta rentak ini.',
            'limit_exceeded' => 'Anda telah menggunakan semua gembaran anda.',
            'not_hypeable' => 'Peta rentak ini tidak boleh digembarkan',
            'owner' => 'Dilarang menggembarkan peta rentak sendiri.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Cap masa yang ditentukan melebihi tempoh peta rentak.',
            'negative' => "Cap masa tidak boleh bernilai negatif.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Perbincangan dikunci.',
        'first_post' => 'Hantaran pemula tidak boleh dipadam.',

        'attributes' => [
            'message' => 'Pesanan',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Pembalasan terhadap komen yang dipadam tidak dibenarkan.',
        'top_only' => 'Penyematan balasan komen tidak dibenarkan.',

        'attributes' => [
            'message' => 'Pesanan',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute tidak sah ditentukan.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Hanya boleh mengundi permintaan ciri.',
            'not_enough_feature_votes' => 'Undian tidak mencukupi',
        ],

        'poll_vote' => [
            'invalid' => 'Pilihan tidak sah ditentukan.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Pemadaman hantaran metadata peta rentak tidak dibenarkan.',
            'beatmapset_post_no_edit' => 'Penyuntingan hantaran metadata peta rentak tidak dibenarkan.',
            'first_post_no_delete' => 'Hantaran pemula tidak boleh dipadam',
            'missing_topic' => 'Hantaran tiada tajuk',
            'only_quote' => 'Balasan anda hanya mengandungi petikan.',

            'attributes' => [
                'post_text' => 'Isi hantaran',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Judul tajuk',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Pilihan salinan tidak dibenarkan.',
            'grace_period_expired' => 'Tinjauan tidak boleh disunting setelah lebih :limit jam.',
            'hiding_results_forever' => 'Hasil tinjauan yang tiada tamat tidak boleh disorok.',
            'invalid_max_options' => 'Pilihan setiap pengguna tidak boleh melebihi jumlah pilihan tersedia.',
            'minimum_one_selection' => 'Minimum satu pilihan per pengguna diperlukan.',
            'minimum_two_options' => 'Sekurang-kurangnya dua pilihan diperlukan.',
            'too_many_options' => 'Melebihi jumlah maksimum pilihan yang dibenarkan.',

            'attributes' => [
                'title' => 'Judul tinjauan',
            ],
        ],

        'topic_vote' => [
            'required' => 'Buat pilihan ketika mengundi.',
            'too_many' => 'Pilihan melebihi jumlah yang dibenarkan.',
        ],
    ],

    'legacy_api_key' => [
        'exists' => 'Hanya satu kunci API disediakan setiap pengguna ketika ini.',

        'attributes' => [
            'api_key' => 'kunci api',
            'app_name' => 'nama aplikasi',
            'app_url' => 'url aplikasi',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Aplikasi OAuth melebihi jumlah yang dibenarkan.',
            'url' => 'Sila masukkan URL yang sah.',

            'attributes' => [
                'name' => 'Nama Aplikasi',
                'redirect' => 'URL Panggil Balik Aplikasi',
            ],
        ],
    ],

    'team' => [
        'invalid_characters' => ':attribute ini mengandungi aksara tidak sah.',
        'used' => ':attribute ini telah digunakan.',
        'word_not_allowed' => ':attribute ini tidak dibenarkan.',

        'attributes' => [
            'default_ruleset_id' => 'Ruleset asal',
            'is_open' => 'Permohonan pasukan',
            'name' => 'Nama',
            'short_name' => 'Nama pendek',
            'url' => 'URL',
        ],
    ],

    'user' => [
        'contains_username' => 'Kata laluan tidak boleh mengandungi nama pengguna.',
        'email_already_used' => 'Alamat e-mel telah digunakan.',
        'email_not_allowed' => 'Alamat e-mel tidak dibenarkan.',
        'invalid_country' => 'Negara tiada dalam pangkalan data.',
        'invalid_discord' => 'Nama pengguna Discord tidak sah.',
        'invalid_email' => "Nampaknya bukan alamat e-mel sah.",
        'invalid_twitter' => 'Nama pengguna Twitter tidak sah.',
        'too_short' => 'Kata laluan baharu terlalu pendek.',
        'unknown_duplicate' => 'Nama pengguna atau e-mel telah digunakan.',
        'username_available_in' => 'Nama pengguna ini akan sedia digunakan dalam :duration.',
        'username_available_soon' => 'Nama pengguna akan sedia digunakan sebentar lagi!',
        'username_invalid_characters' => 'Nama pengguna yang diminta mengandungi aksara yang tidak sah.',
        'username_in_use' => 'Nama pengguna ini telah digunakan!',
        'username_locked' => 'Nama pengguna ini telah digunakan!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Sila gunakan aksara garis bawah atau jarak tetapi bukan kedua-dua sekali!',
        'username_no_spaces' => "Nama pengguna tidak boleh bermula atau berakhir dengan aksara jarak!",
        'username_not_allowed' => 'Pilihan nama pengguna ini tidak dibenarkan.',
        'username_too_short' => 'Pilihan nama pengguna ini terlalu pendek.',
        'username_too_long' => 'Pilihan nama pengguna ini terlalu panjang.',
        'weak' => 'Kata laluan disenarai hitam.',
        'wrong_current_password' => 'Kata laluan semasa tidak betul.',
        'wrong_email_confirmation' => 'Pengesahan e-mel tidak sepadan.',
        'wrong_password_confirmation' => 'Pengesahan kata laluan tidak sepadan.',
        'too_long' => 'Melebihi panjang maksimum iaitu :limit aksara sahaja.',

        'attributes' => [
            'username' => 'Nama pengguna',
            'user_email' => 'Alamat e-mel',
            'password' => 'Kata Laluan',
        ],

        'change_username' => [
            'restricted' => 'Anda tidak boleh mengubah nama pengguna anda ketika disekat.',
            'supporter_required' => [
                '_' => 'Anda mesti mempunyai :link untuk mengubah nama anda!',
                'link_text' => 'menyokong osu!',
            ],
            'username_is_same' => 'Apalah, ini kan memang nama penggunamu!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Peta rentak berkedudukan tidak boleh dilaporkan',
        'not_in_channel' => 'Anda tiada dalam saluran ini.',
        'in_team' => 'Anda ahli pasukan ini.',
        'reason_not_valid' => ':reason tidak sah untuk jenis laporan.',
        'self' => "Anda tidak boleh melaporkan diri sendiri!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Kuantiti',
                'cost' => 'Biaya',
            ],
        ],
    ],
];
