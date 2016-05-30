<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'resolve' => [
            'general_discussion' => 'General discussion can not be resolved.',
            'not_owner' => 'Only thread starter and beatmap owner can resolve a discussion.',
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
                ],

                'not_allowed' => 'Can not send message while banned/restricted/silenced.',
            ],
        ],
    ],

    'forum' => [
        'post' => [
            'delete' => [
                // how to english
                // Returned when TopicReply check fails.
                'can_not_post' => 'Can not delete post which thread can not be replied to.',
                'can_only_delete_last_post' => 'Only last post can be deleted.',
                'not_owner' => 'Only poster can delete the post.',
            ],

            'edit' => [
                'can_not_post' => 'Can not edit post which thread can not be replied to.',
                'locked' => 'The post is locked from editing.',
                'not_owner' => 'Only poster can edit the post.',
            ],
        ],

        'topic' => [
            'reply' => [
                'can_not_post' => 'Access to requested forum is required.',
                'locked' => 'Can not reply to a locked thread.',
            ],

            'store' => [
                'can_not_view_forum' => 'Access to requested forum is required.',
                'can_not_post' => 'Not allowed to post.',
                'forum_closed' => 'Forum is closed and can not be posted to.',
                'user' => [
                    'silenced' => 'Can not post when silenced.',
                    'restricted' => 'Can not post when restricted.',
                ],
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

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'User page is locked.',
                'require_support_to_create' => 'Supporter tag is required.',

                'user' => [
                    'silenced' => 'Can not edit user page when silenced.',
                    'restricted' => 'Can not edit user page when restricted.',
                ],
            ],
        ],
    ],
];
