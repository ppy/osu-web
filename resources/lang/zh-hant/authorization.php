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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Can not undo hyping.',
            'has_reply' => 'Can not delete discussion with replies',
        ],
        'nominate' => [
            'exhausted' => 'You have reached your nomination limit for the day, please try again tomorrow.',
        ],
        'resolve' => [
            'not_owner' => 'Only thread starter and beatmap owner can resolve a discussion.',
        ],

        'vote' => [
            'limit_exceeded' => 'Please wait a while before casting more votes',
            'owner' => 'Can not vote own discussion!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatically generated post can not be edited.',
            'not_owner' => 'Only the poster can edit post.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Access to requested channel is not permitted.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Access to target channel is required.',
                    'moderated' => 'Channel is currently moderated.',
                    'not_lazer' => 'You can only speak in #lazer at this time.',
                ],

                'not_allowed' => 'Can not send message while banned/restricted/silenced.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'You cannot change your vote after the voting period for this contest has ended.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Only last post can be deleted.',
                'locked' => 'Can not delete post of a locked topic.',
                'no_forum_access' => 'Access to requested forum is required.',
                'not_owner' => 'Only poster can delete the post.',
            ],

            'edit' => [
                'deleted' => 'Can not edit deleted post.',
                'locked' => 'The post is locked from editing.',
                'no_forum_access' => 'Access to requested forum is required.',
                'not_owner' => 'Only poster can edit the post.',
                'topic_locked' => 'Can not edit post of a locked topic.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'You just posted. Wait a bit or edit your last post.',
                'locked' => 'Can not reply to a locked thread.',
                'no_forum_access' => 'Access to requested forum is required.',
                'no_permission' => 'No permission to reply.',

                'user' => [
                    'require_login' => 'Please login to reply.',
                    'restricted' => "Can't reply while restricted.",
                    'silenced' => "Can't reply while silenced.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Access to requested forum is required.',
                'no_permission' => 'No permission to create new topic.',
                'forum_closed' => 'Forum is closed and can not be posted to.',
            ],

            'vote' => [
                'no_forum_access' => 'Access to requested forum is required.',
                'over' => 'Polling is over and can not be voted on anymore.',
                'voted' => 'Changing vote is not allowed.',

                'user' => [
                    'require_login' => 'Please login to vote.',
                    'restricted' => "Can't vote while restricted.",
                    'silenced' => "Can't vote while silenced.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Access to requested forum is required.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Invalid cover specified.',
                'not_owner' => 'Only owner can edit cover.',
            ],
        ],

        'view' => [
            'admin_only' => 'Only admin can view this forum.',
        ],
    ],

    'require_login' => 'Please login to proceed.',

    'unauthorized' => 'Access denied.',

    'silenced' => "Can't do that while silenced.",

    'restricted' => "Can't do that while restricted.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'User page is locked.',
                'not_owner' => 'Can only edit own user page.',
                'require_supporter_tag' => 'Supporter tag is required.',
            ],
        ],
    ],
];
