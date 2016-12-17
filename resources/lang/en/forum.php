<?php
/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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
    'pinned_topics' => 'Pinned Topics',
    'post' => [
        'confirm_delete' => 'Really delete post?',
        'edited' => 'Last edited by :user on :when, edited :count times in total.',
        'posted_at' => 'posted :when',
        'actions' => [
            'delete' => 'Delete post',
            'edit' => 'Edit post',
        ],
    ],
    'search' => [
        'go_to_post' => 'Go to post',
        'post_number_input' => 'enter post number',
        'total_posts' => ':posts_count posts total',
    ],
    'subforums' => 'Subforums',
    'title' => 'osu!community',
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => 'Type post content here',
                'title' => 'Click here to set title',
            ],
            'preview' => 'Preview',
            'submit' => 'Post',
        ],
        'go_to_latest' => 'view latest post',
        'jump' => [
            'enter' => 'click to enter specific post number',
            'first' => 'go to first post',
            'last' => 'go to last post',
            'next' => 'skip next 10 posts',
            'previous' => 'go back 10 posts',
        ],
        'latest_post' => ':when by :user',
        'latest_reply_by' => 'latest reply by :user',
        'new_topic' => 'Post new topic',
        'post_edit' => [
            'cancel' => 'Cancel',
            'post' => 'Save',
            'zoom' => [
                'start' => 'Full Screen',
                'end' => 'Exit Full Screen',
            ],
        ],
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Type here to reply',
        'started_by' => 'by :user',
    ],
    'topic_watches' => [
        'index' => [
            'title' => 'Topic Subscriptions',
            'title_compact' => 'subscriptions',
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
            'reply' => 'Show reply box',
            'reply_with_quote' => 'Quote post for reply',
        ],
        'create' => [
            'create_poll' => 'Poll Creation',
            'create_poll_button' => [
                'add' => 'Create a poll',
                'remove' => 'Cancel creating a poll',
            ],
            'poll' => [
                'length' => 'Run poll for',
                'length_days_prefix' => '',
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
        'index' => [
            'views' => 'views',
            'replies' => 'replies',
        ],
        'lock' => [
            'is_locked' => 'This topic is locked and can not be replied to',
            'lock-0' => 'Unlock topic',
            'lock-1' => 'Lock topic',
            'state-0' => 'Topic has been unlocked',
            'state-1' => 'Topic has been locked',
        ],
        'moderate_move' => [
            'title' => 'Move to another forum',
        ],
        'moderate_pin' => [
            'pin-0' => 'Unpin topic',
            'pin-1' => 'Pin topic',
            'state-0' => 'Topic has been unpinned',
            'state-1' => 'Topic has been pinned',
        ],
        'show' => [
            'total_posts' => 'Total Posts',
            'feature_vote' => [
                'current' => 'Current Priority: +:count',
                'do' => 'Promote this request',
                'user' => [
                    'current' => 'You have :votes remaining.',
                    'count' => '{0} no vote|{1} :count vote|[2,Inf] :count votes',
                    'not_enough' => 'You don\'t have any more votes remaining',
                ],
            ],
            'poll' => [
                'vote' => 'Vote',
                'detail' => [
                    'total' => 'Total votes: :count',
                    'ended' => 'Polling ended :time',
                    'end_time' => 'Polling will end at :time',
                ],
            ],
        ],
        'watch' => [
            'state-0' => 'Unsubscribed from topic',
            'state-1' => 'Subscribed to topic',
            'watch-0' => 'Unsubscribe topic',
            'watch-1' => 'Subscribe topic',
        ],
    ],
];
