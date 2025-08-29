<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'account settings',
        'username' => 'username',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'reset',
            'rules' => 'Please ensure your avatar adheres to :link.<br/>This means it must be <strong>suitable for all ages</strong>. i.e. no nudity, offensive or suggestive content.',
            'rules_link' => 'the Visual content considerations',
        ],

        'email' => [
            'new' => 'new email',
            'new_confirmation' => 'email confirmation',
            'title' => 'Email',
            'locked' => [
                '_' => 'Please contact the :accounts if you need your email updated.',
                'accounts' => 'account support team',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Legacy API',
        ],

        'password' => [
            'current' => 'current password',
            'new' => 'new password',
            'new_confirmation' => 'password confirmation',
            'title' => 'Password',
        ],

        'profile' => [
            'country' => 'country',
            'title' => 'Profile',

            'country_change' => [
                '_' => "It looks like your account country doesn't match your country of residence. :update_link.",
                'update_link' => 'Update to :country',
            ],

            'user' => [
                'user_discord' => 'discord',
                'user_from' => 'current location',
                'user_interests' => 'interests',
                'user_occ' => 'occupation',
                'user_twitter' => 'twitter',
                'user_website' => 'website',
            ],
        ],

        'signature' => [
            'title' => 'Signature',
            'update' => 'update',
        ],
    ],

    'github_user' => [
        'info' => "If you're a contributor to osu!'s open-source repositories, linking your GitHub account here will associate your changelog entries with your osu! profile. GitHub accounts with no contribution history to osu! cannot be linked.",
        'link' => 'Link GitHub Account',
        'title' => 'GitHub',
        'unlink' => 'Unlink GitHub Account',

        'error' => [
            'already_linked' => 'This GitHub account is already linked to a different user.',
            'no_contribution' => 'Cannot link GitHub account without any contribution history in osu! repositories.',
            'unverified_email' => 'Please verify your primary email on GitHub, then try linking your account again.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'receive notifications for new problems on qualified beatmaps of the following modes',
        'beatmapset_disqualify' => 'receive notifications for when beatmaps of the following modes are disqualified',
        'comment_reply' => 'receive notifications for replies to your comments',
        'title' => 'Notifications',
        'topic_auto_subscribe' => 'automatically enable notifications on new forum topics that you create or replied to',

        'options' => [
            '_' => 'delivery options',
            'beatmap_owner_change' => 'guest difficulty',
            'beatmapset:modding' => 'beatmap modding',
            'channel_message' => 'private chat messages',
            'channel_team' => 'team chat messages',
            'comment_new' => 'new comments',
            'forum_topic_reply' => 'topic reply',
            'mail' => 'mail',
            'mapping' => 'beatmap mapper',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'authorized clients',
        'own_clients' => 'own clients',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'hide warnings for explicit content in beatmaps',
        'beatmapset_title_show_original' => 'show beatmap metadata in original language',
        'title' => 'Options',

        'beatmapset_download' => [
            '_' => 'default beatmap download type',
            'all' => 'with video if available',
            'direct' => 'open in osu!direct',
            'no_video' => 'without video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'keyboard',
        'mouse' => 'mouse',
        'tablet' => 'tablet',
        'title' => 'Playstyles',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'block private messages from people not on your friends list',
        'hide_online' => 'hide your online presence',
        'title' => 'Privacy',
    ],

    'security' => [
        'current_session' => 'current',
        'end_session' => 'End Session',
        'end_session_confirmation' => 'This will immediately end your session on that device. Are you sure?',
        'last_active' => 'Last active:',
        'title' => 'Security',
        'web_sessions' => 'web sessions',
    ],

    'update_email' => [
        'update' => 'update',
    ],

    'update_password' => [
        'update' => 'update',
    ],

    'user_totp' => [
        'title' => 'Authenticator App',

        'button' => [
            'remove' => 'Remove',
            'setup' => 'Setup',
        ],
        'status' => [
            'label' => 'status',
            'not_set' => 'Not configured',
            'set' => 'Configured',
        ],
    ],

    'verification_completed' => [
        'text' => 'You can close this tab/window now',
        'title' => 'Verification has been completed',
    ],

    'verification_invalid' => [
        'title' => 'Invalid or expired verification link',
    ],
];
