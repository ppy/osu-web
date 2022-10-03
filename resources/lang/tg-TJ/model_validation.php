<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => '',
    'not_negative' => '',
    'required' => '',
    'too_long' => '',
    'wrong_confirmation' => '',

    'beatmapset_discussion' => [
        'beatmap_missing' => '',
        'beatmapset_no_hype' => "",
        'hype_requires_null_beatmap' => '',
        'invalid_beatmap_id' => '',
        'invalid_beatmapset_id' => '',
        'locked' => '',

        'attributes' => [
            'message_type' => '',
            'timestamp' => '',
        ],

        'hype' => [
            'discussion_locked' => "",
            'guest' => '',
            'hyped' => '',
            'limit_exceeded' => '',
            'not_hypeable' => '',
            'owner' => '',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '',
            'negative' => "",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => '',
        'first_post' => '',

        'attributes' => [
            'message' => '',
        ],
    ],

    'comment' => [
        'deleted_parent' => '',
        'top_only' => '',

        'attributes' => [
            'message' => '',
        ],
    ],

    'follow' => [
        'invalid' => '',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '',
            'not_enough_feature_votes' => '',
        ],

        'poll_vote' => [
            'invalid' => '',
        ],

        'post' => [
            'beatmapset_post_no_delete' => '',
            'beatmapset_post_no_edit' => '',
            'first_post_no_delete' => '',
            'missing_topic' => '',
            'only_quote' => '',

            'attributes' => [
                'post_text' => '',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => '',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => '',
            'grace_period_expired' => '',
            'hiding_results_forever' => '',
            'invalid_max_options' => '',
            'minimum_one_selection' => '',
            'minimum_two_options' => '',
            'too_many_options' => '',

            'attributes' => [
                'title' => '',
            ],
        ],

        'topic_vote' => [
            'required' => '',
            'too_many' => '',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => '',

            'attributes' => [
                'name' => '',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => '',
        'email_already_used' => '',
        'email_not_allowed' => '',
        'invalid_country' => '',
        'invalid_discord' => '',
        'invalid_email' => "",
        'invalid_twitter' => '',
        'too_short' => '',
        'unknown_duplicate' => '',
        'username_available_in' => '',
        'username_available_soon' => '',
        'username_invalid_characters' => '',
        'username_in_use' => '',
        'username_locked' => '', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => '',
        'username_no_spaces' => "",
        'username_not_allowed' => '',
        'username_too_short' => '',
        'username_too_long' => '',
        'weak' => '',
        'wrong_current_password' => '',
        'wrong_email_confirmation' => '',
        'wrong_password_confirmation' => '',
        'too_long' => '',

        'attributes' => [
            'username' => '',
            'user_email' => '',
            'password' => '',
        ],

        'change_username' => [
            'restricted' => '',
            'supporter_required' => [
                '_' => '',
                'link_text' => '',
            ],
            'username_is_same' => '',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => '',
        'self' => "",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => '',
                'cost' => '',
            ],
        ],
    ],
];
