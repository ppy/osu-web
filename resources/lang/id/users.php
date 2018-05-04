<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'deleted' => '[deleted user]',

    'beatmapset_activities' => [
        'title' => "Riwayat Modding :user",

        'discussions' => [
            'title_recent' => 'Recently started discussions',
        ],

        'events' => [
            'title_recent' => 'Recent events',
        ],

        'posts' => [
            'title_recent' => 'Postingan terbaru',
        ],

        'votes_received' => [
            'title_most' => 'Most upvoted by (last 3 months)',
        ],

        'votes_made' => [
            'title_most' => 'Most upvoted (last 3 months)',
        ],
    ],

    'card' => [
        'loading' => 'Memuat...',
        'send_message' => 'kirim pesan',
    ],

    'login' => [
        '_' => 'Masuk',
        'locked_ip' => 'Alamat IP anda dikunci. Mohon tunggu beberapa menit.',
        'username' => 'Nama Pengguna',
        'password' => 'Kata Sandi',
        'button' => 'Masuk',
        'button_posting' => 'Mencoba masuk...',
        'remember' => 'Ingat komputer ini',
        'title' => 'Mohon masuk untuk melanjutkan',
        'failed' => 'Incorrect sign in',
        'register' => "Belum memiliki akun osu!? Buat sekarang",
        'forgot' => 'Lupa kata sandi?',
        'beta' => [
            'main' => 'Akses beta saat ini dibatasi untuk pengguna istimewa.',
            'small' => '(Supporter akan segera masuk)',
        ],

        'here' => 'di sini', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Postingan :username',
    ],

    'signup' => [
        '_' => 'Daftar',
    ],
    'anonymous' => [
        'login_link' => 'klik untuk masuk',
        'login_text' => 'masuk',
        'username' => 'Tamu',
        'error' => 'Anda perlu masuk untuk melakukan ini.',
    ],
    'logout_confirm' => 'Apa anda yakin akan keluar? :(',
    'restricted_banner' => [
        'title' => 'Akun anda telah dibatasi!',
        'message' => 'Selama dibatasi, anda tidak dapat berinteraksi dengan pengguna lain dan skor hanya akan terlihat oleh anda. Hal ini biasanya terproses secara otomatis dan akan diangkat dalam 24 jam. Jika anda ingin mengajukan banding atas pembatasan anda, mohon<a href="mailto:accounts@ppy.sh">hubungi dukungan</a>.',
    ],
    'show' => [
        'age' => ':age tahun',
        'change_avatar' => 'ganti avatar anda!',
        'first_members' => 'Di sini dari awal',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Bergabung :date',
        'lastvisit' => 'Terakhir terlihat :date',
        'missingtext' => 'Mungkin anda salah ketik! (atau pengguna mungkin telah diblokir)',
        'origin_age' => ':age',
        'origin_country_age' => ':age dari :country',
        'origin_country' => 'Dari :country',
        'page_description' => 'osu! - Everything you ever wanted to know about :username!',
        'previous_usernames' => 'dulu dikenal sebagai',
        'plays_with' => 'Bermain menggunakan :devices',
        'title' => "profil :username",

        'edit' => [
            'cover' => [
                'button' => 'Change Profile Cover',
                'defaults_info' => 'More cover options will be available in the future',
                'upload' => [
                    'broken_file' => 'Failed processing image. Verify uploaded image and try again.',
                    'button' => 'Unggah gambar',
                    'dropzone' => 'Letakkan di sini untuk mengunggah',
                    'dropzone_info' => 'Anda juga dapat meletakkan gambar anda di sini untuk mengunggah.',
                    'restriction_info' => "Unggah hanya tersedia untuk <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'Ukuran sampul seharusnya 2000x700',
                    'too_large' => 'File yang diunggah terlalu besar.',
                    'unsupported_format' => 'Format tidak didukung.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'mode permainan default',
                'set' => 'Atur :mode sebagai mode permainan default profil',
            ],
        ],

        'extra' => [
            'followers' => '1 pengikut|:count pengikut',
            'unranked' => 'Tidak ada permainan terakhir',

            'achievements' => [
                'title' => 'Pencapaian',
                'achieved-on' => 'Dicapai pada :date',
            ],
            'beatmaps' => [
                'none' => 'Saat ini tidak ada...',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps Favorit (:count)',
                ],
                'graveyard' => [
                    'title' => 'Graveyarded Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'No performance records. :(',
                'title' => 'Historical',

                'monthly_playcounts' => [
                    'title' => 'Riwayat Main',
                ],
                'most_played' => [
                    'count' => 'kali dimainkan',
                    'title' => 'Beatmaps yang Paling Banyak Dimainkan',
                ],
                'recent_plays' => [
                    'accuracy' => 'akurasi: :percentage',
                    'title' => 'Recent Plays (24j)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Riwayat Tayangan Ulang yang Ditonton',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Tersedia',
                'available_info' => "Kudosu can be traded for kudosu stars, which will help your beatmap get more attention. This is the number of kudosu you haven't traded in yet.",
                'recent_entries' => 'Recent Kudosu History',
                'title' => 'Kudosu!',
                'total' => 'Jumlah Kudosu yang diperoleh',
                'total_info' => 'Based on how much of a contribution the user has made to beatmap moderation. See <a href="'.osu_url('user.kudosu').'">this page</a> for more information.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Pengguna ini belum menerima kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Received :amount from kudosu deny repeal of modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denied :amount from modding post :post',
                        ],

                        'delete' => [
                            'reset' => 'Lost :amount from modding post deletion of :post',
                        ],

                        'restore' => [
                            'give' => 'Received :amount from modding post restoration of :post',
                        ],

                        'vote' => [
                            'give' => 'Received :amount from obtaining votes in modding post of :post',
                            'reset' => 'Lost :amount from losing votes in modding post of :post',
                        ],

                        'recalculate' => [
                            'give' => 'Received :amount from votes recalculation in modding post of :post',
                            'reset' => 'Lost :amount from votes recalculation in modding post of :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Received :amount from :giver for a post at :post',
                        'reset' => 'Kudosu reset by :giver for the post :post',
                        'revoke' => 'Denied kudosu by :giver for the post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "Pengguna ini belum mendapatkannya. ;_;",
                'title' => 'Medali',
            ],
            'recent_activity' => [
                'title' => 'Terbaru',
            ],
            'top_ranks' => [
                'empty' => 'No awesome performance records yet. :(',
                'not_ranked' => 'Only ranked beatmaps give out pp.',
                'pp' => ':amountpp',
                'title' => 'Peringkat',
                'weighted_pp' => 'Terhitung: :pp (:percentage)',

                'best' => [
                    'title' => 'Performa Terbaik',
                ],
                'first' => [
                    'title' => 'Peringkat Tempat Pertama',
                ],
            ],
            'account_standing' => [
                'title' => 'Account Standing',
                'bad_standing' => "<strong>:username's</strong> account is not in a good standing :(",
                'remaining_silence' => '<strong>:username</strong> will be able to speak again in :duration.',

                'recent_infringements' => [
                    'title' => 'Recent Infringements',
                    'date' => 'tanggal',
                    'action' => 'aksi',
                    'length' => 'durasi',
                    'length_permanent' => 'Permanen',
                    'description' => 'deskripsi',
                    'actor' => 'oleh :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Silence',
                        'note' => 'Catatan',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => 'Interests',
            'lastfm' => 'Last.fm',
            'location' => 'Lokasi Saat Ini',
            'occupation' => 'Pekerjaan',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'They may have changed their username.',
            'reason_2' => 'The account may be temporarily unavailable due to security or abuse issues.',
            'reason_3' => 'You may have made a typo!',
            'reason_header' => 'There are a few possible reasons for this:',
            'title' => 'User not found! ;_;',
        ],
        'page' => [
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',
            'restriction_info' => "You need to be an <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> to unlock this feature.",
        ],
        'post_count' => [
            '_' => 'Berkontribusi :link',
            'count' => ':count postingan forum|:count postingan forum',
        ],
        'rank' => [
            'country' => 'Peringkat negara untuk :mode',
            'global' => 'Peringkat global untuk :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Akurasi Hit',
            'level' => 'Level :level',
            'maximum_combo' => 'Combo Maksimum',
            'play_count' => 'Jumlah Main',
            'play_time' => 'Jumlah Waktu Main',
            'ranked_score' => 'Skor Ranked',
            'replays_watched_by_others' => 'Tayangan ulang ditonton oleh orang lain',
            'score_ranks' => 'Peringkat Skor',
            'total_hits' => 'Total Hit',
            'total_score' => 'Total Skor',
        ],
    ],
    'status' => [
        'online' => 'Daring',
        'offline' => 'Luring',
    ],
    'store' => [
        'saved' => 'Pengguna dibuat',
    ],
    'verify' => [
        'title' => 'Verifikasi Akun',
    ],
];
