<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Mga naka-pin na paksa',
    'slogan' => "mapanganib maglaro ng mag-isa.",
    'subforums' => 'Mga subforum',
    'title' => 'osu! forums',

    'covers' => [
        'edit' => 'Palitan ang cover',

        'create' => [
            '_' => 'Magdagdag ng cover image',
            'button' => 'Mag-upload ng imahe',
            'info' => 'Ang sukat ng cover ay :dimensions dapat. Maaari mo ring i-drop ang imahe dito para i-upload.',
        ],

        'destroy' => [
            '_' => 'Tanggalin ang cover image',
            'confirm' => 'Sigurado ka na ba na gusto mong tanggalin ang cover image na ito?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Pinakabagong Post',

        'index' => [
            'title' => 'Indeks ng Forum',
        ],

        'topics' => [
            'empty' => 'Walang mga paksa!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Markahan ang forum bilang nabasa na',
        'forums' => 'Markahan ang mga forum bilang nabasa na',
        'busy' => 'Minamarkahang nabasa na...',
    ],

    'post' => [
        'confirm_destroy' => 'Talagang burahin ang post na ito?',
        'confirm_restore' => 'Talagang ibalik ang post na ito?',
        'edited' => 'Huling na-edit ni pamamagitan ni :user noong :when, in-edit nang :count_delimited na beses sa kabuuan.|Huling na-edit ni pamamagitan ni :user noong :when, in-edit nang :count_delimited na beses sa kabuuan.',
        'posted_at' => 'nai-post noong :when',
        'posted_by' => 'nai-post ni :username',

        'actions' => [
            'destroy' => 'Burahin ang post na ito',
            'edit' => 'I-edit ang post',
            'report' => 'I-ulat ang post',
            'restore' => 'Ibalik ang post',
        ],

        'create' => [
            'title' => [
                'reply' => 'Bagong sagot',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited na post|:count_delimited na mga post',
            'topic_starter' => 'Tagasimula ng Pag-uusap',
        ],
    ],

    'search' => [
        'go_to_post' => 'Pumunta sa post',
        'post_number_input' => 'i-enter ang post number',
        'total_posts' => ':posts_count na kabuuang mga post',
    ],

    'topic' => [
        'confirm_destroy' => 'Talagang burahin ang post na ito?',
        'confirm_restore' => 'Talagang ibalik ang post na ito?',
        'deleted' => 'buradong mga paksa',
        'go_to_latest' => 'tingnan ang mga pinakabagong post',
        'has_replied' => 'Sumagot ka sa pag-uusap na ito',
        'in_forum' => 'sa :forum',
        'latest_post' => ':when ni :user',
        'latest_reply_by' => 'huling sagot ni :user',
        'new_topic' => 'Bagong paksa',
        'new_topic_login' => 'Mag-sign in upang makapag-post ng bagong paksa',
        'post_reply' => 'I-post',
        'reply_box_placeholder' => 'Mag-type dito para sumagot',
        'reply_title_prefix' => 'Re',
        'started_by' => 'ni :user',
        'started_by_verbose' => 'sinimulan ni :user',

        'actions' => [
            'destroy' => 'Burahin ang pag-uusap',
            'restore' => 'Ibalik ang pag-uusap',
        ],

        'create' => [
            'close' => 'Isara',
            'preview' => 'Prebiyu',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Magsulat',
            'submit' => 'Mag-post',

            'necropost' => [
                'default' => 'Ang paksang ito ay hindi naging aktibo sa mahabang panahon. Mag-post lamang kung kinakailangan.',

                'new_topic' => [
                    '_' => "Ang paksang ito ay hindi naging aktibo sa mahabang panahon. Kung walang dahilan para mag post dito, :create na lamang.",
                    'create' => 'lumilikha ng bagong paksa',
                ],
            ],

            'placeholder' => [
                'body' => 'I-type ang nilalaman ng post dito',
                'title' => 'Pumindot dito upang baguhin ang pamagat',
            ],
        ],

        'jump' => [
            'enter' => 'pumindot upang i-enter ang partikular na numero ng post',
            'first' => 'pumunta sa pinaka-unang post',
            'last' => 'pumunta sa pinakahuling post',
            'next' => 'laktawan ang susunod na 10 mga post',
            'previous' => 'bumalik nang 10 mga post',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Ikansela',
            'post' => 'I-save',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'mga binabantayang paksa sa forum',

            'box' => [
                'total' => 'Binabantayang mga paksa',
                'unread' => 'Mga paksang may bagong reply',
            ],

            'info' => [
                'total' => ':total na paksa ang iyong binabanayan.',
                'unread' => 'Mayroon kang :unread na mensahe na hindi pa nababasa sa iyong mga binabantayang na paksa.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Huwag nang bantayan ang paksa?',
                'title' => 'Mag-unsubscribe',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Mga paksa',

        'actions' => [
            'login_reply' => 'Mag-sign in upang makasagot',
            'reply' => 'Sumagot',
            'reply_with_quote' => 'Sipiin ang post at sumagot',
            'search' => 'Maghanap',
        ],

        'create' => [
            'create_poll' => 'Paglikha ng Botohan',

            'preview' => 'Prebiyu ng post',

            'create_poll_button' => [
                'add' => 'Gumawa ng pagbobotohan',
                'remove' => 'Kanselahin ang paggawa ng pagbobotohan',
            ],

            'poll' => [
                'hide_results' => 'Itago ang resulta ng botohan.',
                'hide_results_info' => 'Ipapakita lamang ito pagkatapos ng botohan.',
                'length' => 'Patakbuhin ang botohan sa loob ng',
                'length_days_suffix' => 'na mga araw',
                'length_info' => 'Iwan na blangko para sa walang katapusang botohan',
                'max_options' => 'Mga pagpipilian sa bawat user',
                'max_options_info' => 'Ito ang bilang ng mga pagpipilian na maaring piliin ng bawat user kapag bumoboto.',
                'options' => 'Mga pagpipilian',
                'options_info' => 'Isulat ang mga pagpipilian sa kanya-kanyang linya. Maaari kang maglagay hanggang 10 na pagpipilian.',
                'title' => 'Tanong',
                'vote_change' => 'Payagan ang muling pagboto.',
                'vote_change_info' => 'Kapag pinayagan, maaaring magpalit ang mga manlalaro ng kanilang boto.',
            ],
        ],

        'edit_title' => [
            'start' => 'Baguhin ang pamagat',
        ],

        'index' => [
            'feature_votes' => 'prayoridad ayon sa bilang ng bituin',
            'replies' => 'mga sagot',
            'views' => 'beses na nakita',
        ],

        'issue_tag_added' => [
            'to_0' => 'Tanggalin ang panandang "idinagdag"',
            'to_0_done' => 'Tinanggal ang panandang "idinagdag"',
            'to_1' => 'Lagyan ng panandang "idinagdag"',
            'to_1_done' => 'Nilagyan ng panandang "idinagdag"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Tanggalin ang panandang "itinalaga"',
            'to_0_done' => 'Tinanggal ang panandang "itinalaga"',
            'to_1' => 'Lagyan ng panandang "itinalaga"',
            'to_1_done' => 'Nilagyan ng panandang "itinalaga"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Tanggalin ang panandang "kumpirmado"',
            'to_0_done' => 'Tinanggal ang panandang "kumpirmado"',
            'to_1' => 'Lagyan ng panandang "kumpirmado"',
            'to_1_done' => 'Nilagyan ng panandang "kumpirmado"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Tanggalin ang panandang "may kapareho"',
            'to_0_done' => 'Tinanggal ang panandang "may kapareho"',
            'to_1' => 'Lagyan ng panandang "may kapareho"',
            'to_1_done' => 'Nilagyan ng panandang "may kapareho"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Tanggalin ang panandang "hindi maaari"',
            'to_0_done' => 'Tinanggal ang panandang "hindi maaari"',
            'to_1' => 'Lagyan ng panandang "hindi maaari"',
            'to_1_done' => 'Nilagyan ng panandang "hindi maaari"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Tanggalin ang panandang "naresolba"',
            'to_0_done' => 'Tinanggal ang panandang "naresolba"',
            'to_1' => 'Lagyan ng panandang "naresolba"',
            'to_1_done' => 'Nilagyan ng panandang "naresolba"',
        ],

        'lock' => [
            'is_locked' => 'Sarado na ang paksang ito at hindi na maaari pang sagutan',
            'to_0' => 'I-unlock ang paksa',
            'to_0_confirm' => 'I-unlock ang paksa?',
            'to_0_done' => 'Na-unlock na ang paksa',
            'to_1' => 'I-lock ang paksa',
            'to_1_confirm' => 'I-lock ang paksa?',
            'to_1_done' => 'Ang paksa ay isinara na',
        ],

        'moderate_move' => [
            'title' => 'Ilipat sa ibang forum',
        ],

        'moderate_pin' => [
            'to_0' => 'I-unpin ang paksa',
            'to_0_confirm' => 'I-unpin ang paksa?',
            'to_0_done' => 'Na-unpin na ang paksa',
            'to_1' => 'I-pin ang paksa',
            'to_1_confirm' => 'I-pin ang paksa?',
            'to_1_done' => 'Na-pin na ang paksa',
            'to_2' => 'I-pin ang paksa at markahang anunsyo',
            'to_2_confirm' => 'I-pin ang paksa at markahang anunsyo?',
            'to_2_done' => 'Na-pin ang paksa at namarkahang anunsyo',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Ipakita ang buradong mga post',
            'hide' => 'Itago ang buradong mga post',
        ],

        'show' => [
            'deleted-posts' => 'Buradong mga Post',
            'total_posts' => 'Kabuuang mga Post',

            'feature_vote' => [
                'current' => 'Kasalukuyang Prayoridad: +:count',
                'do' => 'Itaguyod ang kahilingang ito',

                'info' => [
                    '_' => 'Isa itong :feature_request. Ang mga Hinihiling na feature ay maaaring pagbotohan ng mga :supporters.',
                    'feature_request' => 'hinihiling na feature',
                    'supporters' => 'mga supporter',
                ],

                'user' => [
                    'count' => '{0} walang boto|{1} :count_delimited na boto|[2,*] :count_delimited na mga boto',
                    'current' => ':votes na mga boto na lang ang natitira sa\'yo.',
                    'not_enough' => "Wala ka nang natitirang boto",
                ],
            ],

            'poll' => [
                'edit' => 'I-edit ang Pagboboto',
                'edit_warning' => 'Matatanggal ang kasalukuyang mga resulta kapag in-edit mo ang pinagbobotohang ito!',
                'vote' => 'Bumoto',

                'button' => [
                    'change_vote' => 'Palitan ang boto',
                    'edit' => 'Baguhin ang botohan',
                    'view_results' => 'Lumaktaw papunta sa mga resulta',
                    'vote' => 'Bumoto',
                ],

                'detail' => [
                    'end_time' => 'Magtatapos ang pagboboto sa :time',
                    'ended' => 'Natapos ang pagboboto noong :time',
                    'results_hidden' => 'Ipapakita ang mga resulta sa pagtatapos ng botohan.',
                    'total' => 'Suma total ng mga boto: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Hindi binabantayan',
            'to_watching' => 'Binabantayan',
            'to_watching_mail' => 'Bantayan na may notipikasyon',
            'tooltip_mail_disable' => 'Naka-on ang notipikasyon. Pindutin ito upang patayin',
            'tooltip_mail_enable' => 'Naka-off ang notipikasyon. Pindutin ito upang i-on',
        ],
    ],
];
