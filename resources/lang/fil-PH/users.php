<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[tinanggal na user]',

    'beatmapset_activities' => [
        'title' => "Kasaysayan ng pag-mod ni :user",
        'title_compact' => 'Pag mod',

        'discussions' => [
            'title_recent' => 'Kakasimulang disccusion',
        ],

        'events' => [
            'title_recent' => 'Bagong event',
        ],

        'posts' => [
            'title_recent' => 'Bagong post',
        ],

        'votes_received' => [
            'title_most' => 'Pinaka upvoted ng(huling 3 buwan)',
        ],

        'votes_made' => [
            'title_most' => 'Pinaka upvoted(huling 3 buwan)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Na-block mo na ang user na ito.',
        'blocked_count' => 'mga na-block na user (:count)',
        'hide_profile' => 'Itago ang profile',
        'not_blocked' => 'Hindi naka-block ang user na ito.',
        'show_profile' => 'Ipakita ang profile',
        'too_many' => 'Naabot na ang limit ng pag-block.',
        'button' => [
            'block' => 'Harangan',
            'unblock' => 'Tanggalin ang harang',
        ],
    ],

    'card' => [
        'loading' => 'Nag lo-load...',
        'send_message' => 'Ipadala ang mensahe',
    ],

    'disabled' => [
        'title' => 'Naku po! Mukhang ang iyong account ay hindi magagamit.',
        'warning' => "Sa kaso na ikaw ay nakalabag sa rules, alamin na mayroong isang buwan na hindi namin bibigyang konsiderasyon ang anumang request sa amnestiya. Pagkatapos ng sinabing isang buwan ay maaari na kaming i-contact kung kinakailangan. Binibigyang paalala namin na ang paglikha ng bagong account matapos magkaroon ng disabled account ay magreresulta sa <strong>pagdagdag sa isang buwan na cool-down</strong>. <strong>Sa bawat isang account na iyong nilikha ikaw ay lalong lumalabag sa rules.</strong> ",

        'if_mistake' => [
            '_' => 'Kung ramdam mo na ito ay mali, maaari kang makipag-ugnay sa amin (sa :email o sa pag-click ng "?" sa babang-kanan ng pahinang ito). Tandaan na kami ay laging sigurado sa aming mga kilos dahil ang mga ito ay nakabase sa napakatibay na datos. Kami ay may karapatang ibalewala ang iyong kahilingan kung ramdam namin na ikaw ay sadyang nagsisinungaling.',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => 'Ang account mo ay na kompromiso. Maari tong ma disable habang kinukunifirma ang may ari. ',
            'opening' => 'May mga dahilan na maaring magresulta sa pagiging disabled ng iyong account:',

            'tos' => [
                '_' => 'Ikaw ay nakalabag ng isa o higit pang :community_rules or :tos.',
                'community_rules' => 'patakaran ng community',
                'tos' => 'termino ng serbisyo',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Mga miyembero alinsunod sa game mode',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Ang iyong account ay hindi nagamit ng mahabang panahon.",
        ],
    ],

    'login' => [
        '_' => 'Mag-sign in',
        'button' => 'Mag-sign in',
        'button_posting' => 'Nag sa-sign in...',
        'email_login_disabled' => 'Ang pag sign in gamit ng email ay disabled muna. Gamitin muna ang iyong username.',
        'failed' => 'Maling sign in',
        'forgot' => 'Nakalimutan mo ang password mo?',
        'info' => 'Mag-sign in upang makapagpatuloy',
        'invalid_captcha' => 'Madaming palyang tangka sa pag login. Tapusin muna ang captcha at ulitin muli. (I refresh pag hindi makita ang captcha)',
        'locked_ip' => 'Locked ang iyong IP address. Magantay ng ilang minuto.',
        'password' => 'Password',
        'register' => "Wala kang osu! account? Gumawa ka ng bago",
        'remember' => 'Tandaan ako sa kompyuter na ito',
        'title' => 'Paki-sign-in para tumuloy',
        'username' => 'Username',

        'beta' => [
            'main' => 'Ang beta access ay para lang sa mga users na may pribilehiyo.',
            'small' => '(Makakapasok rin ang mga osu!supporter)',
        ],
    ],

    'posts' => [
        'title' => 'Mga post ni :username',
    ],

    'anonymous' => [
        'login_link' => 'pindutin upang maka-sign in',
        'login_text' => 'mag-sign in',
        'username' => 'Bisita',
        'error' => 'Kailangan mong mag sign-in para gawin ito.',
    ],
    'logout_confirm' => 'Nais mo ba talagang mag-sign-out? :(',
    'report' => [
        'button_text' => 'I-report',
        'comments' => 'Mga Karagdagang Komento',
        'placeholder' => 'Maari pong mag bigay ng information na magiging kapakipakinabang,.',
        'reason' => 'Dahilan',
        'thanks' => 'Salamat sa iyong ulat!',
        'title' => 'I-sumbong si :username?',

        'actions' => [
            'send' => 'Magpadala ng Report',
            'cancel' => 'Ikansela',
        ],

        'options' => [
            'cheating' => 'Hindi tamang gawain / Pandaraya',
            'multiple_accounts' => 'Gumagamit ng maraming account',
            'insults' => 'Iniinsulto ako o ang iba',
            'spam' => 'Nag-iispam',
            'unwanted_content' => 'Paglink ng hindi pwedeng content.',
            'nonsense' => 'Bagay na walang kapararakan',
            'other' => 'Iba( i type sa baba)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Naging limitado ang iyong account!',
        'message' => 'Habang restricted ang account, ikaw ay hindi maaaring makihalubilo sa kapwa kalaro at ang iyong mga iskor ay ikaw lamang ang makakakita. Ito ay madalas ng resulta ng isang automated na proseso at kadalasang ipinapawalang bisa pagkatapos ng 24 oras. Kung nais mong mag-apela sa iyong restriction, <a href="mailto:accounts@ppy.sh">i-contact ang support</a>.',
    ],
    'show' => [
        'age' => ':age taong gulang',
        'change_avatar' => 'palitan ang iyong avatar!',
        'first_members' => 'Nandito galing sa simula',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Sumali noong :date',
        'lastvisit' => 'Huling nakitang :date',
        'lastvisit_online' => 'Kasalukuyang online',
        'missingtext' => 'Baka nagkamali ka ng pag type!(Or baka na ban ang gumagamit.)',
        'origin_country' => 'Nangganling sa :country',
        'previous_usernames' => 'dating kilala bilang',
        'plays_with' => 'Naglalaro gamit ang :devices',
        'title' => "Profile ni :username",

        'comments_count' => [
            '_' => 'Nag-post sa :link',
            'count' => ':count_delimited na komento|:count_delimited na mga komento',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Palitan ang cover',
                'defaults_info' => 'Higit pang mga larawang cover ang ilalabas sa hinaharap',
                'upload' => [
                    'broken_file' => 'Hindi matagumpay ang pagproseso ng imahe. Suriin ang inilalathalang imahe at subukang muli.',
                    'button' => 'Mag-upload ng imahe',
                    'dropzone' => 'I-drop dito para ma-upload',
                    'dropzone_info' => 'Maaari mo rin i-drop ang iyong larawan dito i-upload',
                    'size_info' => 'Ang sukat ng cover ay dapat maging 2400 x 620',
                    'too_large' => 'Ang na-upload na file ay masyadong malaki.',
                    'unsupported_format' => 'Hindi suportadong format.',

                    'restriction_info' => [
                        '_' => 'Available lamang ang upload sa mga :link',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'default na game mode',
                'set' => 'i-set ang :mode bilang default na game mode',
            ],
        ],

        'extra' => [
            'none' => 'wala',
            'unranked' => 'Walang nilaro kamakailan lamang',

            'achievements' => [
                'achieved-on' => 'Nakamit sa :date',
                'locked' => 'Naka-lock',
                'title' => 'Mga Nakamit',
            ],
            'beatmaps' => [
                'by_artist' => 'ni :artist',
                'title' => 'Mga Beatmap',

                'favourite' => [
                    'title' => 'Mga Paboritong Beatmaps',
                ],
                'graveyard' => [
                    'title' => 'Mga Inilibing na Beatmap',
                ],
                'loved' => [
                    'title' => 'Mga Minamahal na Beatmap',
                ],
                'pending' => [
                    'title' => 'Pending na mga Beatmap',
                ],
                'ranked' => [
                    'title' => 'Ranked na mga Beatmap',
                ],
            ],
            'discussions' => [
                'title' => 'Diskusyon',
                'title_longer' => 'Kamakailan lamang na mga Tinalakay',
                'show_more' => 'higit pang mga talakayan',
            ],
            'events' => [
                'title' => 'Mga Pangyayari',
                'title_longer' => 'Mga Kamakailang Kaganapan',
                'show_more' => 'higit pang mga kaganapan',
            ],
            'historical' => [
                'title' => 'Kasaysayan',

                'monthly_playcounts' => [
                    'title' => 'Kasaysayan ng Laro',
                    'count_label' => 'Mga Nilaro',
                ],
                'most_played' => [
                    'count' => 'beses ng paglaro',
                    'title' => 'Pinakamaraming nilaro na Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'katumpakan: :percentage',
                    'title' => 'Mga kamakailang nilaro (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Kasaysayan sa Panooran ng Replay',
                    'count_label' => 'Beses na Napanooran ng Replay',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Kamakailang Kaganapan sa Kudosu',
                'title' => 'Kudosu!',
                'total' => 'Suma total ng Nakamit na Kudosu',

                'entry' => [
                    'amount' => ':amount na kudosu',
                    'empty' => "Ang user na ito ay hindi pa nakatatanggap ng kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Nakatanggap ng :amount na kudosu mula sa pagpapawalang-bisa ng pagkakabawi ng kudosu sa modding post sa :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Binawian ng :amount sa modding post sa :post',
                        ],

                        'delete' => [
                            'reset' => 'Nabawasan ng :amount dahil sa pagkakabura ng modding post sa :post',
                        ],

                        'restore' => [
                            'give' => 'Nakatanggap ng :amount dahil sa pagkakabalik ng modding post sa :post',
                        ],

                        'vote' => [
                            'give' => 'Nakatanggap ng :amount dahil sa sapat na boto matapos magsulat ng modding post sa :post',
                            'reset' => 'Nabawasan ng :amount dahil sa binawing boto sa modding post sa :post',
                        ],

                        'recalculate' => [
                            'give' => 'Nakatanggap ng :amount dahil sa muling pagkuwenta ng mga boto sa modding post sa :post',
                            'reset' => 'Nabawasan ng :amount dahil sa muling pagkuwenta ng mga boto sa modding post sa :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Nakataggap ng :amount mula kay :giver dahil sa isang post sa :post',
                        'reset' => 'Ni-reset ni :giver ang kudosu sa post sa :post',
                        'revoke' => 'Tinanggihan ni :giver ng kudosu sa post sa :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Nakabase sa kung gaano karami ang ambag ng user sa pag-moderate ng beatmap. Pumunta sa :link para sa dagdag na impormasyon.',
                    'link' => 'sa pahinang ito',
                ],
            ],
            'me' => [
                'title' => 'ako!',
            ],
            'medals' => [
                'empty' => "Wala pang natatanggap ang manlalarong ito sa ngayon. ;_;",
                'recent' => 'Pinakabago',
                'title' => 'Mga Medalya',
            ],
            'playlists' => [
                'title' => '',
            ],
            'posts' => [
                'title' => 'Mga Post',
                'title_longer' => 'Mga Bagong Post',
                'show_more' => 'higit pang mga post',
            ],
            'recent_activity' => [
                'title' => 'Kamakailan',
            ],
            'realtime' => [
                'title' => '',
            ],
            'top_ranks' => [
                'download_replay' => 'I-Download ang Replay',
                'not_ranked' => 'Mga ranggong beatmap lamang nagbibigay ng pp',
                'pp_weight' => 'nagkakahalagang :percentage',
                'view_details' => 'Tignan ang Detalye',
                'title' => 'Ranggo',

                'best' => [
                    'title' => 'Pinakamahusay na Pagganap',
                ],
                'first' => [
                    'title' => 'Nangungunang Ranggo',
                ],
                'pin' => [
                    'to_0' => '',
                    'to_0_done' => '',
                    'to_1' => '',
                    'to_1_done' => '',
                ],
                'pinned' => [
                    'title' => '',
                ],
            ],
            'votes' => [
                'given' => 'Ibinigay na mga Boto (sa huling 3 buwan)',
                'received' => 'Natanggap na Boto (sa huling 3 buwan)',
                'title' => 'Mga boto',
                'title_longer' => 'Mga bagong boto',
                'vote_count' => ':count_delimited na boto|:count_delimited na mga boto',
            ],
            'account_standing' => [
                'title' => 'Katayuan ng Account',
                'bad_standing' => "Ang account ni <strong>:username</strong> ay nasa hindi mabuting kalagayan :(",
                'remaining_silence' => 'Makakapagsalitang muli si <strong>:username</strong> :duration.',

                'recent_infringements' => [
                    'title' => 'Kamakailang Paglabag',
                    'date' => 'petsa',
                    'action' => 'aksyon',
                    'length' => 'tagal',
                    'length_permanent' => 'Permanente',
                    'description' => 'deskripsyon',
                    'actor' => 'ni :username',

                    'actions' => [
                        'restriction' => 'I-ban',
                        'silence' => 'Pagpapatahimik',
                        'note' => 'Tala',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Mga Interes',
            'location' => 'Kasalukuyang Lokasyon',
            'occupation' => 'Trabaho',
            'twitter' => '',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'Maaring nagbago ang kanilang username.',
            'reason_2' => 'Ang account na ito ay hindi maaring makita dahil sa seguridad o abuso na isyu.',
            'reason_3' => 'Nagkamali ka sa iyong na-itype!',
            'reason_header' => 'Mayroong mga dahilan para sa mali na ito:',
            'title' => 'Hindi mahanap ang user! ;_;',
        ],
        'page' => [
            'button' => 'I-edit ang iyong profile page',
            'description' => 'Ang <strong>me!</strong> ay isang bahagi sa iyong profile page na maaari mong i-customize.',
            'edit_big' => 'I-edit ang me!',
            'placeholder' => 'I-type ang iyong kontento dito',

            'restriction_info' => [
                '_' => 'Kailangan mo maging :link para magamit ang tampok na ito.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Nag-kontribute sa :link',
            'count' => ':count_delimited na forum post|:count_delimited na forum posts',
        ],
        'rank' => [
            'country' => 'Pambansang Ranggo para sa :mode',
            'country_simple' => 'Pambansang Ranggo',
            'global' => 'Pandaigdigang ranggo para sa :mode',
            'global_simple' => 'Pambansang Ranggo',
        ],
        'stats' => [
            'hit_accuracy' => 'Katumpakan sa Pagtama',
            'level' => 'Antas :level',
            'level_progress' => 'Progreso sa susunod na antas',
            'maximum_combo' => 'Pinakamataas na Combo',
            'medals' => 'Medalya',
            'play_count' => 'Bilang ng Beses na Naglaro',
            'play_time' => 'Kabuuang Oras ng Paglaro',
            'ranked_score' => 'Ranked na Iskor',
            'replays_watched_by_others' => 'Beses na Pinanood ng Iba ang Replay',
            'score_ranks' => 'Uri ng Iskor',
            'total_hits' => 'Kabuuang Tama',
            'total_score' => 'Kabuuang Puntos',
            // modding stats
            'graveyard_beatmapset_count' => 'Mga Abandunadong Beatmap',
            'loved_beatmapset_count' => 'Mga Loved na Beatmap',
            'pending_beatmapset_count' => 'Mga Nakabinbing mga Beatmap',
            'ranked_beatmapset_count' => 'Mga Na-rank na Beatmap',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Kasalukuyan kang pinatatahimik.',
        'message' => 'May ilang gawaing hindi maaari para sa iyo.',
    ],

    'status' => [
        'all' => 'Lahat',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Ginawa ng user',
    ],
    'verify' => [
        'title' => 'Beripikasyon ng Account',
    ],

    'view_mode' => [
        'brick' => 'Pa-bloke na view',
        'card' => 'Kard na view',
        'list' => 'Talaang view',
    ],
];
