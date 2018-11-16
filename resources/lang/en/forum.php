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
    'pinned_topics' => 'Pinned Topics',
    'slogan' => "it's dangerous to play alone.",
    'subforums' => 'Subforums',
    'title' => 'osu! forums',

    'covers' => [
        'create' => [
            '_' => 'Set cover image',
            'button' => 'Upload image',
            'info' => 'Cover size should be at :dimensions. You can also drop your image here to upload.',
        ],

        'destroy' => [
            '_' => 'Remove cover image',
            'confirm' => 'Are you sure you want to remove the cover image?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] New reply for topic ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'No topics!',
        ],
    ],

    'poll' => [
        'edit_warning' => 'Editing a poll will remove the current results!',

        'actions' => [
            'edit' => 'Edit poll',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Really delete post?',
        'confirm_restore' => 'Really restore post?',
        'edited' => 'Last edited by :user :when, edited :count times in total.',
        'posted_at' => 'posted :when',

        'actions' => [
            'destroy' => 'Delete post',
            'restore' => 'Restore post',
            'edit' => 'Edit post',
        ],
    ],

    'search' => [
        'go_to_post' => 'Go to post',
        'post_number_input' => 'enter post number',
        'total_posts' => ':posts_count posts total',
    ],

    'topic' => [
        'deleted' => 'deleted topic',
        'go_to_latest' => 'view latest post',
        'latest_post' => ':when by :user',
        'latest_reply_by' => 'latest reply by :user',
        'new_topic' => 'New topic',
        'new_topic_login' => 'Sign in to post new topic',
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Type here to reply',
        'reply_title_prefix' => 'Re',
        'started_by' => 'by :user',
        'started_by_verbose' => 'started by :user',

        'create' => [
            'preview' => 'Preview',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Write',
            'submit' => 'Post',

            'necropost' => [
                'default' => 'This topic has been inactive for a while. Only post here if you have a specific reason to do so.',

                'new_topic' => [
                    '_' => "This topic has been inactive for a while. If you don't have a specific reason to post here, please :create instead.",
                    'create' => 'create a new topic',
                ],
            ],

            'placeholder' => [
                'body' => 'Type post content here',
                'title' => 'Click here to set title',
            ],
        ],

        'jump' => [
            'enter' => 'click to enter specific post number',
            'first' => 'go to first post',
            'last' => 'go to last post',
            'next' => 'skip next 10 posts',
            'previous' => 'go back 10 posts',
        ],

        'post_edit' => [
            'cancel' => 'Cancel',
            'post' => 'Save',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Forum Subscriptions',
            'title_compact' => 'forum subscriptions',
            'title_main' => 'Forum <strong>Subscriptions</strong>',

            'box' => [
                'total' => 'Topics subscribed',
                'unread' => 'Topics with new replies',
            ],

            'info' => [
                'total' => 'You subscribed to :total topics.',
                'unread' => 'You have :unread unread replies to subscribed topics.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Unsubscribe from topic?',
                'title' => 'Unsubscribe',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Topics',

        'actions' => [
            'login_reply' => 'Sign in to Reply',
            'reply' => 'Reply',
            'reply_with_quote' => 'Quote post for reply',
            'search' => 'Search',
        ],

        'create' => [
            'create_poll' => 'Poll Creation',

            'create_poll_button' => [
                'add' => 'Create a poll',
                'remove' => 'Cancel creating a poll',
            ],

            'poll' => [
                'length' => 'Run poll for',
                'length_days_suffix' => 'days',
                'length_info' => 'Leave blank for a never ending poll',
                'max_options' => 'Options per user',
                'max_options_info' => 'This is the number of options each user may select when voting.',
                'options' => 'Options',
                'options_info' => 'Place each options on a new line. You may enter up to 10 options.',
                'title' => 'Question',
                'vote_change' => 'Allow re-voting.',
                'vote_change_info' => 'If enabled, users are able to change their vote.',
            ],
        ],

        'edit_title' => [
            'start' => 'Edit title',
        ],

        'index' => [
            'views' => 'views',
            'replies' => 'replies',
        ],

        'issue_tag_added' => [
            'to_0' => 'Remove "added" tag',
            'to_0_done' => 'Removed "added" tag',
            'to_1' => 'Add "added" tag',
            'to_1_done' => 'Added "added" tag',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Remove "assigned" tag',
            'to_0_done' => 'Removed "assigned" tag',
            'to_1' => 'Add "assigned" tag',
            'to_1_done' => 'Added "assigned" tag',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Remove "confirmed" tag',
            'to_0_done' => 'Removed "confirmed" tag',
            'to_1' => 'Add "confirmed" tag',
            'to_1_done' => 'Added "confirmed" tag',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Remove "duplicate" tag',
            'to_0_done' => 'Removed "duplicate" tag',
            'to_1' => 'Add "duplicate" tag',
            'to_1_done' => 'Added "duplicate" tag',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Remove "invalid" tag',
            'to_0_done' => 'Removed "invalid" tag',
            'to_1' => 'Add "invalid" tag',
            'to_1_done' => 'Added "invalid" tag',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Remove "resolved" tag',
            'to_0_done' => 'Removed "resolved" tag',
            'to_1' => 'Add "resolved" tag',
            'to_1_done' => 'Added "resolved" tag',
        ],

        'lock' => [
            'is_locked' => 'This topic is locked and can not be replied to',
            'to_0' => 'Unlock topic',
            'to_0_done' => 'Topic has been unlocked',
            'to_1' => 'Lock topic',
            'to_1_done' => 'Topic has been locked',
        ],

        'moderate_move' => [
            'title' => 'Move to another forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Unpin topic',
            'to_0_done' => 'Topic has been unpinned',
            'to_1' => 'Pin topic',
            'to_1_done' => 'Topic has been pinned',
            'to_2' => 'Pin topic and mark as announcement',
            'to_2_done' => 'Topic has been pinned and marked as announcement',
        ],

        'show' => [
            'deleted-posts' => 'Deleted Posts',
            'total_posts' => 'Total Posts',

            'feature_vote' => [
                'current' => 'Current Priority: +:count',
                'do' => 'Promote this request',

                'user' => [
                    'count' => '{0} no vote|{1} :count vote|[2,*] :count votes',
                    'current' => 'You have :votes remaining.',
                    'not_enough' => "You don't have any more votes remaining",
                ],
            ],

            'poll' => [
                'vote' => 'Vote',

                'detail' => [
                    'end_time' => 'Polling will end at :time',
                    'ended' => 'Polling ended :time',
                    'total' => 'Total votes: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Not bookmarked',
            'to_watching' => 'Bookmark',
            'to_watching_mail' => 'Bookmark with notification',
            'tooltip_mail_disable' => 'Notification is enabled. Click to disable',
            'tooltip_mail_enable' => 'Notification is disabled. Click to enable',
        ],
    ],
];
