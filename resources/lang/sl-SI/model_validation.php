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
    'not_negative' => '',
    'required' => '',
    'too_long' => '',
    'wrong_confirmation' => '',

    'beatmap_discussion_post' => [
        'discussion_locked' => '',
        'first_post' => '',

        'attributes' => [
            'message' => '',
        ],
    ],

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
        'invalid_country' => '',
        'invalid_discord' => '',
        'invalid_email' => "",
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
