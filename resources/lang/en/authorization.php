<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'How about playing some osu! instead?',
    'require_login' => 'Please sign in to proceed.',
    'require_verification' => 'Please verify to proceed.',
    'restricted' => "Can't do that while restricted.",
    'silenced' => "Can't do that while silenced.",
    'unauthorized' => 'Access denied.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Can not undo hyping.',
            'has_reply' => 'Can not delete discussion with replies',
        ],
        'nominate' => [
            'exhausted' => 'You have reached your nomination limit for the day, please try again tomorrow.',
            'incorrect_state' => 'Error performing that action, try refreshing the page.',
            'owner' => "Can't nominate own beatmap.",
            'set_metadata' => 'You must set the genre and language before nominating.',
        ],
        'resolve' => [
            'not_owner' => 'Only thread starter and beatmap owner can resolve a discussion.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Only beatmap owner or nominator/NAT group member can post mapper notes.',
        ],

        'vote' => [
            'bot' => "Can't vote on discussion made by bot",
            'limit_exceeded' => 'Please wait a while before casting more votes',
            'owner' => "Can't vote on own discussion.",
            'wrong_beatmapset_state' => 'Can only vote on discussions of pending beatmaps.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'You can only delete your own posts.',
            'resolved' => 'You can not delete a post of a resolved discussion.',
            'system_generated' => 'Automatically generated post can not be deleted.',
        ],

        'edit' => [
            'not_owner' => 'Only the poster can edit post.',
            'resolved' => 'You can not edit a post of a resolved discussion.',
            'system_generated' => 'Automatically generated post can not be edited.',
        ],

        'store' => [
            'beatmapset_locked' => 'This beatmap is locked for discussion.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'You cannot change metadata of a nominated map. Contact a BN or NAT member if you think it is set incorrectly.',
        ],
    ],

    'chat' => [
        'blocked' => 'Cannot message a user that is blocking you or that you have blocked.',
        'friends_only' => 'User is blocking messages from people not on their friends list.',
        'moderated' => 'This channel is currently moderated.',
        'no_access' => 'You do not have access to that channel.',
        'receive_friends_only' => 'The user may not be able to reply because you are only accepting messages from people on your friends list.',
        'restricted' => 'You cannot send messages while silenced, restricted or banned.',
        'silenced' => 'You cannot send messages while silenced, restricted or banned.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Can't edit deleted post.",
        ],
    ],

    'contest' => [
        'voting_over' => 'You cannot change your vote after the voting period for this contest has ended.',

        'entry' => [
            'limit_reached' => 'You have reached the entry limit for this contest',
            'over' => 'Thank you for your entries! Submissions have closed for this contest and voting will open soon.',
        ],
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
                'play_more' => 'You need to play more before voting on forum.',
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
            'store' => [
                'forum_not_allowed' => 'This forum does not accept topic covers.',
            ],
        ],

        'view' => [
            'admin_only' => 'Only admin can view this forum.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Only score owner can pin score.',
            'too_many' => 'Pinned too many scores.',
        ],
    ],

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
