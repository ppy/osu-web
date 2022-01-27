<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '',
    'require_login' => '',
    'require_verification' => '',
    'restricted' => "",
    'silenced' => "",
    'unauthorized' => '',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => '',
            'has_reply' => '',
        ],
        'nominate' => [
            'exhausted' => '',
            'incorrect_state' => '',
            'owner' => "",
            'set_metadata' => '',
        ],
        'resolve' => [
            'not_owner' => '',
        ],

        'store' => [
            'mapper_note_wrong_user' => '',
        ],

        'vote' => [
            'bot' => "",
            'limit_exceeded' => '',
            'owner' => "",
            'wrong_beatmapset_state' => '',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '',
            'resolved' => '',
            'system_generated' => '',
        ],

        'edit' => [
            'not_owner' => '',
            'resolved' => '',
            'system_generated' => '',
        ],

        'store' => [
            'beatmapset_locked' => '',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => '',
        ],
    ],

    'chat' => [
        'blocked' => '',
        'friends_only' => '',
        'moderated' => '',
        'no_access' => '',
        'receive_friends_only' => '',
        'restricted' => '',
        'silenced' => '',
    ],

    'comment' => [
        'update' => [
            'deleted' => "",
        ],
    ],

    'contest' => [
        'voting_over' => '',

        'entry' => [
            'limit_reached' => '',
            'over' => '',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => '',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => '',
                'locked' => '',
                'no_forum_access' => '',
                'not_owner' => '',
            ],

            'edit' => [
                'deleted' => '',
                'locked' => '',
                'no_forum_access' => '',
                'not_owner' => '',
                'topic_locked' => '',
            ],

            'store' => [
                'play_more' => '',
                'too_many_help_posts' => "", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '',
                'locked' => '',
                'no_forum_access' => '',
                'no_permission' => '',

                'user' => [
                    'require_login' => '',
                    'restricted' => "",
                    'silenced' => "",
                ],
            ],

            'store' => [
                'no_forum_access' => '',
                'no_permission' => '',
                'forum_closed' => '',
            ],

            'vote' => [
                'no_forum_access' => '',
                'over' => '',
                'play_more' => '',
                'voted' => '',

                'user' => [
                    'require_login' => '',
                    'restricted' => "",
                    'silenced' => "",
                ],
            ],

            'watch' => [
                'no_forum_access' => '',
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

    'score' => [
        'pin' => [
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
    ],
];
