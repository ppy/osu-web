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
            'is_hype' => 'Can not undo hyping.',
            'has_reply' => 'Can not delete discussion with replies',
        ],
        'nominate' => [
            'exhausted' => 'You have reached your nomination limit for the day, please try again tomorrow.',
            'incorrect_state' => 'Error performing that action, try refreshing the page.',
            'owner' => "Can't nominate own beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Only thread starter and beatmap owner can resolve a discussion.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Only beatmap owner or nominator/QAT group member can post mapper notes.',
        ],

        'vote' => [
            'limit_exceeded' => 'Please wait a while before casting more votes',
            'owner' => "Can't vote on own discussion.",
            'wrong_beatmapset_state' => 'Can only vote on discussions of pending beatmaps.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatically generated post can not be edited.',
            'not_owner' => 'Only the poster can edit post.',
        ],
    ],

    'chat' => [
        'blocked' => 'Cannot message a user that is blocking you or that you have blocked.',
        'friends_only' => 'User is blocking messages from people not on their friends list.',
        'moderated' => 'That channel is currently moderated.',
        'no_access' => 'You do not have access to that channel.',
        'restricted' => 'You cannot send messages while silenced, restricted or banned.',
    ],

    'contest' => [
        'voting_over' => 'You cannot change your vote after the voting period for this contest has ended.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'No permission to moderate this forum.',
        ],

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

            'store' => [
                'play_more' => 'Try playing the game before posting on the forums, please! If you have a problem with playing, please post to the Help and Support forum.',
                'too_many_help_posts' => "You need to play the game more before you can make additional posts. If you're still having trouble playing the game, email support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Please edit your last post instead of posting again.',
                'locked' => 'Can not reply to a locked thread.',
                'no_forum_access' => 'Access to requested forum is required.',
                'no_permission' => 'No permission to reply.',

                'user' => [
                    'require_login' => 'Please sign in to reply.',
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
                    'require_login' => 'Please sign in to vote.',
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

    'require_login' => 'Please sign in to proceed.',

    'unauthorized' => 'Access denied.',

    'silenced' => "Can't do that while silenced.",

    'restricted' => "Can't do that while restricted.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'User page is locked.',
                'not_owner' => 'Can only edit own user page.',
                'require_supporter_tag' => 'osu!supporter tag is required.',
            ],
        ],
    ],
];
