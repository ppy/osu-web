<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => '',
            'has_reply' => '',
        ],
        'nominate' => [
            'exhausted' => '',
        ],
        'resolve' => [
            'not_owner' => '',
        ],

        'vote' => [
            'limit_exceeded' => '',
            'owner' => "Can not vote own discussion!",
            'wrong_beatmapset_state' => '',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => '',
            'not_owner' => '',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => '',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => '',
                    'moderated' => '',
                    'not_lazer' => '',
                ],

                'not_allowed' => '',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => '',
    ],

    'forum' => [
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
                    'require_login' => 'Please login to reply.',
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
                'voted' => '',

                'user' => [
                    'require_login' => 'Please login to vote.',
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
        ],

        'view' => [
            'admin_only' => '',
        ],
    ],

    'require_login' => 'Please login to proceed.',

    'unauthorized' => '',

    'silenced' => "",

    'restricted' => "",

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
