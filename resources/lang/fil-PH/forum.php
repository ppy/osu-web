<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'pinned_topics' => 'Mga naka-pin na paksa',
    'slogan' => "mapanganib maglaro ng mag-isa.",
    'subforums' => 'Mga subforum',
    'title' => 'osu! forums',

    'covers' => [
        'edit' => '',

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
        'latest_post' => '',

        'index' => [
            'title' => '',
        ],

        'topics' => [
            'empty' => 'Walang mga paksa!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Markahan ang forum bilang nabasa',
        'forums' => 'Markahan ang mga forum bilang nabasa',
        'busy' => '',
    ],

    'post' => [
        'confirm_destroy' => 'Talagang tanggalin ang post na ito?',
        'confirm_restore' => 'Talagang ibalik ang post na ito?',
        'edited' => 'Huling na-edit ni pamamagitan ng :user sa :when, in-edit nang :count na beses sa kabuuan.',
        'posted_at' => 'nai-post sa :when',

        'actions' => [
            'destroy' => 'Tanggalin ang post na ito',
            'restore' => 'Ibalik ang post na ito',
            'edit' => 'I-edit ang post na ito',
        ],

        'create' => [
            'title' => [
                'reply' => '',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited post|:count_delimited mga post',
            'topic_starter' => '',
        ],
    ],

    'search' => [
        'go_to_post' => 'Pumunta sa post',
        'post_number_input' => 'i-enter ang post number',
        'total_posts' => ':posts_count kabuuang mga post',
    ],

    'topic' => [
        'deleted' => 'tinanggal ng mga paksa',
        'go_to_latest' => 'tingnan ang mga pinakabagong post',
        'latest_post' => ':when ni :user',
        'latest_reply_by' => 'huling reply ni :user',
        'new_topic' => 'Bagong paksa',
        'new_topic_login' => 'Mag-sign in upang makapag-post ng bagong paksa',
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Mag type dito para mag-reply',
        'reply_title_prefix' => 'Re',
        'started_by' => 'ni :user',
        'started_by_verbose' => 'sinimulan ni :user',

        'create' => [
            'close' => '',
            'preview' => 'Prebiyu',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Magsulat',
            'submit' => 'Mag-post',

            'necropost' => [
                'default' => 'Ang paksang ito ay hindi naging aktibo sa mahabang panahon. Mag-post lamang kung kinakailangan.',

                'new_topic' => [
                    '_' => "Ang paksang ito ay hindi naging aktibo sa mahabang panahon. Kung walang rason para mag post dito, gumawa ng bago :create na lamang.",
                    'create' => 'lumilikha ng bagong paksa',
                ],
            ],

            'placeholder' => [
                'body' => 'I-type and bagong komento dito',
                'title' => 'Mag-click dito upang baguhin ang pamagat',
            ],
        ],

        'jump' => [
            'enter' => 'mag-click upang i-enter ang partikular na post number',
            'first' => 'pumunta sa unang post',
            'last' => 'pumunta sa huling post',
            'next' => 'laktawan ang susunod na 10 mga post',
            'previous' => 'bumalik nang 10 mga post',
        ],

        'post_edit' => [
            'cancel' => 'Ikansel',
            'post' => 'I-save',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'mga suskripsyon sa forum',

            'box' => [
                'total' => 'Topics subscribed',
                'unread' => 'Mga paksang may bagong reply',
            ],

            'info' => [
                'total' => 'Nakasuskribe ka sa :total na paksa.',
                'unread' => '',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '',
                'title' => 'Mag-unsubscribe',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Mga paksa',

        'actions' => [
            'login_reply' => 'Mag-sign in upang makapag-reply',
            'reply' => 'Sumagot',
            'reply_with_quote' => '',
            'search' => 'Search',
        ],

        'create' => [
            'create_poll' => '',

            'preview' => '',

            'create_poll_button' => [
                'add' => '',
                'remove' => '',
            ],

            'poll' => [
                'hide_results' => '',
                'hide_results_info' => '',
                'length' => '',
                'length_days_suffix' => '',
                'length_info' => '',
                'max_options' => '',
                'max_options_info' => '',
                'options' => '',
                'options_info' => '',
                'title' => '',
                'vote_change' => '',
                'vote_change_info' => '',
            ],
        ],

        'edit_title' => [
            'start' => '',
        ],

        'index' => [
            'feature_votes' => '',
            'replies' => '',
            'views' => '',
        ],

        'issue_tag_added' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_assigned' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_invalid' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_resolved' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'lock' => [
            'is_locked' => '',
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'moderate_move' => [
            'title' => '',
        ],

        'moderate_pin' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
            'to_2' => '',
            'to_2_done' => '',
        ],

        'moderate_toggle_deleted' => [
            'show' => '',
            'hide' => '',
        ],

        'show' => [
            'deleted-posts' => '',
            'total_posts' => '',

            'feature_vote' => [
                'current' => '',
                'do' => '',

                'info' => [
                    '_' => '',
                    'feature_request' => '',
                    'supporters' => '',
                ],

                'user' => [
                    'count' => '',
                    'current' => '',
                    'not_enough' => "",
                ],
            ],

            'poll' => [
                'edit' => '',
                'edit_warning' => '',
                'vote' => '',

                'button' => [
                    'change_vote' => '',
                    'edit' => '',
                    'view_results' => '',
                    'vote' => '',
                ],

                'detail' => [
                    'end_time' => '',
                    'ended' => '',
                    'results_hidden' => '',
                    'total' => '',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '',
            'to_watching' => '',
            'to_watching_mail' => '',
            'tooltip_mail_disable' => '',
            'tooltip_mail_enable' => '',
        ],
    ],
];
