<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Invalid :attribute specified.',
    'not_negative' => ':attribute cannot be negative.',
    'required' => ':attribute is required.',
    'too_long' => ':attribute exceeded maximum length - can only be up to :limit characters.',
    'wrong_confirmation' => 'Confirmation does not match.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Timestamp is specified but beatmap difficulty is missing.',
        'beatmapset_no_hype' => "Beatmap can't be hyped.",
        'hype_requires_null_beatmap' => 'Hype must be done in the General (all difficulties) section.',
        'invalid_beatmap_id' => 'Invalid difficulty specified.',
        'invalid_beatmapset_id' => 'Invalid beatmap specified.',
        'locked' => 'Discussion is locked.',

        'attributes' => [
            'message_type' => 'Message type',
            'timestamp' => 'Timestamp',
        ],

        'hype' => [
            'discussion_locked' => "This beatmap is currently locked for discussion and can't be hyped",
            'guest' => 'Must be signed in to hype.',
            'hyped' => 'You have already hyped this beatmap.',
            'limit_exceeded' => 'You have used all your hype.',
            'not_hypeable' => 'This beatmap can not be hyped',
            'owner' => 'No hyping your own beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Specified timestamp is beyond the length of the beatmap.',
            'negative' => "Timestamp can't be negative.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Discussion is locked.',
        'first_post' => 'Can not delete starting post.',

        'attributes' => [
            'message' => 'The message',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Replying to deleted comment is not allowed.',
        'top_only' => 'Pinning comment reply is not allowed.',

        'attributes' => [
            'message' => 'The message',
        ],
    ],

    'follow' => [
        'invalid' => 'Invalid :attribute specified.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Can only vote a feature request.',
            'not_enough_feature_votes' => 'Not enough votes.',
        ],

        'poll_vote' => [
            'invalid' => 'Invalid option specified.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Deleting beatmap metadata post is not allowed.',
            'beatmapset_post_no_edit' => 'Editing beatmap metadata post is not allowed.',
            'first_post_no_delete' => 'Can\'t delete starting post',
            'missing_topic' => 'Post is missing topic',
            'only_quote' => 'Your reply contains only a quote.',

            'attributes' => [
                'post_text' => 'Post body',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Topic title',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplicated option is not allowed.',
            'grace_period_expired' => 'Can\'t edit a poll after more than :limit hours.',
            'hiding_results_forever' => 'Can\'t hide results of a poll that never ends.',
            'invalid_max_options' => 'Option per user may not exceed the number of available options.',
            'minimum_one_selection' => 'A minimum of one option per user is required.',
            'minimum_two_options' => 'Need at least two options.',
            'too_many_options' => 'Exceeded maximum number of allowed options.',

            'attributes' => [
                'title' => 'Poll title',
            ],
        ],

        'topic_vote' => [
            'required' => 'Select an option when voting.',
            'too_many' => 'Selected more options than allowed.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Exceeded maximum number of allowed OAuth applications.',
            'url' => 'Please enter a valid URL.',

            'attributes' => [
                'name' => 'Application Name',
                'redirect' => 'Application Callback URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Password may not contain username.',
        'email_already_used' => 'Email address already used.',
        'email_not_allowed' => 'Email address not allowed.',
        'invalid_country' => 'Country not in database.',
        'invalid_discord' => 'Discord username invalid.',
        'invalid_email' => "Doesn't seem to be a valid email address.",
        'invalid_twitter' => 'Twitter username invalid.',
        'too_short' => 'New password is too short.',
        'unknown_duplicate' => 'Username or email address already used.',
        'username_available_in' => 'This username will be available for use in :duration.',
        'username_available_soon' => 'This username will be available for use any minute now!',
        'username_invalid_characters' => 'The requested username contains invalid characters.',
        'username_in_use' => 'Username is already in use!',
        'username_locked' => 'Username is already in use!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Please use either underscores or spaces, not both!',
        'username_no_spaces' => "Username can't start or end with spaces!",
        'username_not_allowed' => 'This username choice is not allowed.',
        'username_too_short' => 'The requested username is too short.',
        'username_too_long' => 'The requested username is too long.',
        'weak' => 'Blacklisted password.',
        'wrong_current_password' => 'Current password is incorrect.',
        'wrong_email_confirmation' => 'Email confirmation does not match.',
        'wrong_password_confirmation' => 'Password confirmation does not match.',
        'too_long' => 'Exceeded maximum length - can only be up to :limit characters.',

        'attributes' => [
            'username' => 'Username',
            'user_email' => 'Email address',
            'password' => 'Password',
        ],

        'change_username' => [
            'restricted' => 'You cannot change your username while restricted.',
            'supporter_required' => [
                '_' => 'You must have :link to change your name!',
                'link_text' => 'supported osu!',
            ],
            'username_is_same' => 'This is already your username, silly!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Ranked beatmaps cannot be reported',
        'reason_not_valid' => ':reason is not valid for this report type.',
        'self' => "You can't report yourself!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Quantity',
                'cost' => 'Cost',
            ],
        ],
    ],
];
